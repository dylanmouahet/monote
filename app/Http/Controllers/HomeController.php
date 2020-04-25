<?php

namespace App\Http\Controllers;

use App\models\Skill;
use App\models\Project;
use App\models\Learning;
use App\models\Expertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::user()->id)
                            ->orderBy('updated_at', 'desc')
                            ->get();
        $project = $projects->take(5);

        $learnings = Learning::where('user_id', Auth::user()->id)
                            ->orderBy('updated_at', 'desc')
                            ->get();
        $learning = $learnings->take(5);

        $expertises = Expertise::where('user_id', Auth::user()->id)
                            ->orderBy('updated_at', 'desc')
                            ->get();
        $expertise = $expertises->take(5);

        $skills = Skill::where('user_id', Auth::user()->id)
                            ->orderBy('updated_at', 'desc')
                            ->get();
        $skill = $skills->take(5);


        return view('page.home',
            [
                'title' => 'Dashboard',
                'projects' => $projects,
                'project' => $project,
                'learnings' => $learnings,
                'learning' => $learning,
                'expertises' => $expertises,
                'expertise' => $expertise,
                'skills' => $skills,
                'skill' => $skill,
            ]
        );
    }
}
