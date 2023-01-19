<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\StudentDetails;

class NoRecordsRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $totalNumStd = StudentDetails::where("user_key", "=", session()->get("user_id"))
                                    ->where("deleted_at", "=", null)
                                    ->select("student_id")
                                    ->distinct()->count();
        if(!$totalNumStd){
            session()->flash("alertMsg", "No records added yet to calculate attainment 😅");
            return redirect()->back();
        }
        return $next($request);
    }
}
