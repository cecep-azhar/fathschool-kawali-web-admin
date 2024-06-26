<?php

namespace App\Http\Middleware;

use App\Traits\NotifyAble;
use Closure;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;

class UserStatusCheckMiddleware
{
    use NotifyAble;

    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && authUser() && ! authUser()->status) {

            $this->guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            session()->flash('warning', 'Your account has been banned. Please contact the support department for more details.');

            return redirect()->route('login');
        }

        return $next($request);
    }
}
