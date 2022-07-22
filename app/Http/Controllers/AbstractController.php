<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class AbstractController extends Controller
{
    /**
     * Current signed user
     * @var $user
     */
    protected $user;
    protected $guard;

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->user = $request->user();
            $this->guard = Auth::guard();
            return $next($request);
        });
    }

    /**
     * @param $value
     * @return int|string
     */
    public function checkStatus($value)
    {
        return ($value == "on") ? 1 : '0';
    }

}
