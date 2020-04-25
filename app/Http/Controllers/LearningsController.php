<?php

namespace App\Http\Controllers;

use App\models\Chapter;
use App\models\Learning;
use Illuminate\Http\Request;
use App\Http\Requests\LearningForm;
use Illuminate\Support\Facades\Auth;

class LearningsController extends Controller
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
        $learnings = Learning::where('user_id', Auth::user()->id)
                            ->orderBy('created_at')
                            ->get();

        $active = $learnings->where('status', 'In process');
        $actLast = Learning::where('status', 'In process')->first();
        $activeLast = $actLast ?: '';

        $pending = $learnings->where('status', 'Pending');
        $pendingLast = $pending->first(); //dd($pendingLast);
        $finished = $learnings->where('status', 'Finished');
        $finishedLast = $finished->first();

        return view('page.learning_index',
                [
                    'title' => 'Formation',
                    'learnings' => $learnings,
                    'active' => $active,
                    'activeLast' => $activeLast,
                    'pending' => $pending,
                    'pendingLast' => $pendingLast,
                    'finished' => $finished,
                    'finishedLast' => $finishedLast,
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
        $title = "Ajout de formation";
        return view('page.learning_create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LearningForm $request)
    {
        Learning::create(
            [
                'user_id' => Auth::user()->id,
                'name'=> $request->name,
                'description'=> $request->description,
                'type'=> $request->type,
                'category'=> $request->category,
                'chapter'=> $request->chapter,
                'teacher'=> $request->teacher,
                'source'=> $request->source,
                'url'=> $request->url,
                'status'=> $request->status,
            ]
        );
        msg_flash('Formation crée avec succès', "success");
        return redirect()->route('learning.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $learning = Learning::where('user_id', Auth::user()->id)
                            ->where('id', $id)
                            ->firstOrFail();

        $chapter_end = Chapter::where('user_id', Auth::user()->id)
                        ->where('learning_id', $id)
                        ->get();

        if ($learning->chapter === $chapter_end->count())
        {

            if ($learning->status == 'Pending' OR $learning->status == 'In process')
            {
                $learning->update(['status'=>'Finished']);
            }
        }

        //dd($learning->deadline);

        $progress = set_progression($chapter_end->count(), $learning->chapter);


       return view('page.learning_show',
                    [
                        'title' => 'Détail formation',
                        'learning' => $learning,
                        'chapter_end' => $chapter_end,
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
        $learning = Learning::where('id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->firstOrFail();

        //dd($learning);

        return view('page.learning_edit',
                    [
                        'title' => 'Editer formation',
                        'learning' => $learning,
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
    public function update(LearningForm $request, $id)
    {
        $learning = Learning::where('id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->firstOrFail();

        $learning->update(
            [
                'name'=> $request->name,
                'description'=> $request->description,
                'type'=> $request->type,
                'category'=> $request->category,
                'chapter'=> $request->chapter,
                'teacher'=> $request->teacher,
                'source'=> $request->source,
                'url'=> $request->url,
                'status'=> $request->status,
            ]
        );
        msg_flash('Formation modifiée avec succès', "success");
        return redirect()->route('learning.show', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $learning = Learning::where('id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->firstOrFail();

        $learning->delete();

        msg_flash('Formation supprimée', "danger");
        return redirect()->route('learning.index');
    }


    /**
     * Store a newly created chapter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addChapter(Request $request)
    {
        //dd('test');
        $this->validate($request, ['name' => 'required|min:3']);

        $learning = Learning::where('id', $request->learning_id)
                            ->where('user_id', Auth::user()->id)
                            ->firstOrFail();

        $chapter = Chapter::where('user_id', Auth::user()->id)
                            ->where('learning_id', $request->learning_id)
                            ->get();

        if ($learning->chapter == $chapter->count())
        {
            if ($learning->status == 'Pending' || $learning->status == 'In Process')
            {
                $learning->update(['status'=>'Finished']);
            }

            msg_flash("Nombre de chapitre atteint", "danger");
            return redirect()->route('learning.show', $request->learning_id);
        }

        Chapter::create(
            [
                'user_id' => Auth::user()->id,
                'learning_id'=> $request->learning_id,
                'name'=> $request->name,
                'description'=> $request->description,
            ]
        );

        msg_flash('Chapitre ajouté avec succès', "success");
        return redirect()->route('learning.show', $request->learning_id);
    }

     /**
     * Update the specified chapter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateChapter(Request $request, $id)
    {
        //dd('test');

        $chapter = Chapter::where('id', $id)->firstOrFail();
        $chapter->update(['name'=>$request->name, 'description'=>$request->description]);

        msg_flash('Chapitre modifié avec succès', "success");
        return redirect()->route('learning.show', $request->learning_id);
    }

    /**
     * Remove the specified chapter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteChapter(Request $request, $id)
    {
        //dd($request->project_id);
        $chapter = Chapter::where('id', $id)->firstOrFail();
        $chapter->delete();
        msg_flash('Chapitre supprimé', "danger");
        return redirect()->route('learning.show', $request->learning_id);
    }
}
