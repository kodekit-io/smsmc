<?php

namespace App\Http\Middleware;

use App\Service\Account;
use Closure;
use Illuminate\Support\Facades\View;

class SocmedAccount
{
    /**
     * @var Account
     */
    private $account;

    /**
     * SocmedAccount constructor.
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $accounts = $this->account->getSocialAccounts()[0];
        // share to all views
        View::share('g_accounts', $accounts);
        return $next($request);
    }
}
