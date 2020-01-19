<?php

use App\User;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscribedController extends Controller
{
    public function store(User $user)
    {
        return $user->username;
    }
}
