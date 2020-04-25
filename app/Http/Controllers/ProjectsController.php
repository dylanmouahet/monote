<?php

namespace App\Http\Controllers;

use App\models\Step;
use App\models\Project;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\ProjectForm;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('detailsPageSecure');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::user()->id)->get();

        $active = $projects->where('status', 'In process');
        $pending = $projects->where('status', 'Pending');
        $finished = $projects->where('status', 'Finished');

        return view('page.project_index',
                [
                    'title' => 'Projet',
                    'projects' => $projects,
                    'active' => $active,
                    'pending' => $pending,
                    'finished' => $finished,
                ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Création de projet";
        return view('page.project_create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectForm $request)
    {
        //dd(Auth::user()->id);

        Project::create(
            [
                'user_id' => Auth::user()->id,
                'name'=> $request->name,
                'description'=> $request->description,
                'type'=> $request->type,
                'category'=> $request->category,
                'step'=> $request->step,
                'client'=> $request->client,
                'date_start'=> $request->date_start,
                'date_end'=> $request->date_end,
                'deadline'=> $request->deadline,
                'status'=> $request->status,
                'version'=> $request->version,
            ]
        );

        msg_flash('Project crée avec succès', "success");
        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::where('user_id', Auth::user()->id)
                            ->where('id', $id)
                            ->first();

        $step_end = Step::where('user_id', Auth::user()->id)
                        ->where('project_id', $id)
                        ->get();

        if ($project->step === $step_end->count())
        {

            if ($project->status == 'Pending' OR $project->status == 'In process')
            {
                $project->update(['status'=>'Finished']);
            }
        }

        //dd($project->deadline);

        $date = $project->deadline != null ? $project->deadline : '';
        $days_remaining = days_remaining($date);
        $progress = set_progression($step_end->count(), $project->step);


       return view('page.project_show',
                    [
                        'title' => 'Détail projet',
                        'project' => $project,
                        'step_end' => $step_end,
                        'days_remaining' => $days_remaining,
                        'progress' => $progress,
                    ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where('id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->firstOrFail();

        //dd($project);

        return view('page.project_edit',
                    [
                        'title' => 'Editer projet',
                        'project' => $project,
                    ]
    );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectForm $request, $id)
    {
        $project = Project::where('id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->firstOrFail();

        $project->update(
                    [
                        'name'=> $request->name,
                        'description'=> $request->description,
                        'type'=> $request->type,
                        'category'=> $request->category,
                        'step'=> $request->step,
                        'client'=> $request->client,
                        'date_start'=> $request->date_start,
                        'date_end'=> $request->date_end,
                        'deadline'=> $request->deadline,
                        'status'=> $request->status,
                        'version'=> $request->version,
                    ]
        );

        msg_flash('Project modifié avec succès', "success");
        return redirect()->route('project.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::where('id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->firstOrFail();

        $project->delete();

        msg_flash('Project supprimé', "danger");
        return redirect()->route('project.index');
    }


    /**
     * Store a newly created step in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addStep(Request $request)
    {
        //dd('test');
        $project = Project::where('id', $request->project_id)
                            ->where('user_id', Auth::user()->id)
                            ->firstOrFail();

        $step_end = Step::where('user_id', Auth::user()->id)
                            ->where('project_id', $request->project_id)
                            ->get();

        if ($project->step == $step_end->count())
        {
            if ($project->status == 'Pending' || $project->status == 'In Process')
            {
                $project->update(['status'=>'Finished']);
            }

            msg_flash("Nombre d'étape atteint", "danger");
            return redirect()->route('project.show', $request->project_id);
        }


        $this->validate($request, ['name' => 'required|min:3']);
        Step::create(
            [
                'user_id' => Auth::user()->id,
                'project_id'=> $request->project_id,
                'name'=> $request->name,
                'description'=> $request->description,
            ]
        );
        msg_flash('Etape ajoutée avec succès', "success");
        return redirect()->route('project.show', $request->project_id);
    }


    /**
     * Update the specified step in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStep(Request $request, $id)
    {
        //dd('test');

        $step = Step::where('id', $id)->firstOrFail();
        $step->update(['name'=>$request->name, 'description'=>$request->description]);

        msg_flash('Etape modifiée avec succès', "success");
        return redirect()->route('project.show', $request->project_id);
    }



    /**
     * Remove the specified step from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteStep(Request $request, $id)
    {
        //dd($request->project_id);
        $step = Step::where('id', $id)->firstOrFail();
        $step->delete();
        msg_flash('Etape supprimée', "danger");
        return redirect()->route('project.show', $request->project_id);
    }
}
