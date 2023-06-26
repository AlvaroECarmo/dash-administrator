<?php

namespace App\Http\Middleware;

use App\Models\Parlamento\Group;
use App\Models\Parlamento\GroupsHasViews;
use App\Models\Permitions\GroupsHasUsers;
use Closure;
use Illuminate\Http\Request;

class Acesso
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {


        if (\Auth::user()->isSuperAdmin()) {
            return $next($request);
        }

        $emails = auth()->user()->ldap->getEmail();

        if (!$emails) {
            redirect('home');
        }


        $activity = GroupsHasUsers::with('groups.groupsHasViews')->where('user_email', $emails)->get();


        if (!$activity)
            redirect('home');

        $line = false;
        foreach ($activity as $g) {
            foreach ($g->groups as $m) {

                foreach (GroupsHasViews::where('group_id', $m->id)->get() as $d) {

                    if ((str_replace('/', '', $d['path']) == $request->route()->uri) || ($d['path'] == $request->route()->uri)) {

                        $line = true;
                    }
                }
            }
        }

        if ($line) {

            return $next($request);
        }

        return abort(401);

    }
}
