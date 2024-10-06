<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function register()
    {
        return "register index";
    }

    function login()
    {
        return "Login index";
    }

    function forgotPassword()
    {
        return "forgot pasword";
    }

    function resetPassword()
    {
        return "reset password";
    }

    function verifyCode()
    {
        return "verify code";
    }
}
