<?php

namespace App\Http\Middleware;

use App\Models\Agreement;
use App\Models\UserAgreement;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EnsureUserSignedAgreement
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
        if (Auth::check()) {

            $current_agreement = Agreement::where([
                ['year_start', '<=', Carbon::now()->format('Y-m-d')],
                ['year_end', '>=', Carbon::now()->format('Y-m-d')],
            ])->first();

            if ($current_agreement == null) {
                abort(403);
            }

            $user_sign = UserAgreement::where([
                ['user_id', '=', Auth::id()],
                ['agreement_id', '=', $current_agreement->id],
            ])->first();

            if ($user_sign == null) {
                return redirect()->to(route('user.agreement'));
            }

            return $next($request);
        }
        abort(403);
        // return redirect()->to(route('user.login_form'));
    }
}
