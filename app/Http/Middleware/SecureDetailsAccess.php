<?php

namespace App\Http\Middleware;

use Closure;
use App\models\Skill;
use App\models\Project;
use App\models\Learning;
use App\models\Expertise;
use Illuminate\Support\Facades\Auth;

class SecureDetailsAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!is_null(request('project')))
        {
            $row = Project::where('user_id', Auth::user()->id)->where('id', request('project'))->get();

            if ($row->count() == 0)
            {
                return redirect()->route('project.index');
            }
        }

        if (!is_null(request('learning')))
        {
            $row = Learning::where('user_id', Auth::user()->id)->where('id', request('learning'))->get();

            if ($row->count() == 0)
            {
                return redirect()->route('learning.index');
            }
        }

        if (!is_null(request('expertise')))
        {
            $row = Expertise::where('user_id', Auth::user()->id)->where('id', request('expertise'))->get();

            if ($row->count() == 0)
            {
                return redirect()->route('expertise.index');
            }
        }

        if (!is_null(request('skill')))
        {
            $row = Skill::where('user_id', Auth::user()->id)->where('id', request('skill'))->get();

            if ($row->count() == 0)
            {
                return redirect()->route('skill.index');
            }
        }

        return $next($request);
    }
}
