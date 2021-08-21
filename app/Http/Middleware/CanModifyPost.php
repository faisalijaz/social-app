<?php

namespace App\Http\Middleware;

use App\Helpers\AppHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanModifyPost
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if ($request->id) {
            if (AppHelper::isPostOwner($request->id, Auth::id())
                && AppHelper::canModifyPost($request->id, Auth::id())) {
                return $next($request);
            }
        }

        return redirect()->route('posts')->with('error', "Access denied for this page!");
    }
}
