<?php

namespace App\Http\Controllers;

use App\models\Expertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertisesController extends Controller
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
        $expertises = Expertise::where('user_id', Auth::user()->id)->get();

        $software = $expertises->where('type', 'Software');
        $language = $expertises->where('type', 'Language');
        $framework = $expertises->where('type', 'Framework');
        $other = $expertises->where('type', 'Other');

        return view('page.expertise_index',
                [
                    'title' => 'Competence',
                    'expertises' => $expertises,
                    'software' => $software,
                    'language' => $language,
                    'framework' => $framework,
                    'other' => $other,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Expertise::create(
            [
                'user_id' => Auth::user()->id,
                'name'=> $request->name,
                'description'=> $request->description,
                'type'=> $request->type,
                'category'=> $request->category,
                'level'=> $request->level,
            ]
        );

        msg_flash('Compétence ajoutée avec succès', "success");
        return redirect()->route('expertise.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expertise = Expertise::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();

        $expertise->update(
            [
                'name'=> $request->name,
                'description'=> $request->description,
                'type'=> $request->type,
                'category'=> $request->category,
                'level'=> $request->level,
            ]
        );

        msg_flash('Compétence modifiée avec succès', "success");
        return redirect()->route('expertise.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expertise = Expertise::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        $expertise->delete();

        msg_flash('La compétence  a été supprimée', "success");
        return redirect()->route('expertise.index');
    }
}
