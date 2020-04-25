<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('page.profil_index',
                [
                    'title' => 'Profil',
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
    public function store(UserForm $request)
    {


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
    public function edit()
    {
        return view('page.profil_edit',
                [
                    'title' => 'Modifier profil',
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
    public function update(UserForm $request)
    {
        $picture_name = Auth::user()->username.Auth::user()->id.date('Hms');
        $picture_path = 'public/users/'.Auth::user()->username.'/avatar';
        $path = Auth::user()->picture;

        if (!empty($request->picture)) {
            $picture_extension = '.'.$request->picture->getClientOriginalExtension();
            $path = $request->file('picture')->storeAs(
                $picture_path, $picture_name.$picture_extension
            );
        }


        $user = User::where('id', Auth::user()->id)->firstOrFail();
        //dd($path);

        $user->update(
                    [
                        'first_name'=> $request->first_name,
                        'last_name'=> $request->last_name,
                        'email'=> $request->email,
                        'job'=> $request->job,
                        'company'=> $request->company,
                        'github'=> $request->github,
                        'fb'=> $request->fb,
                        'twitter'=> $request->twitter,
                        'linkedin'=> $request->linkedin,
                        'about'=> $request->about,
                        'picture'=> $path,
                    ]
        );

        msg_flash('Profil modifié avec succès', "success");
        return redirect()->route('profil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
