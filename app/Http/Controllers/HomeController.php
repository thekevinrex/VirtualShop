<?php

namespace App\Http\Controllers;

use App\Events\TestBroadcastMessage;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index () {
        return view('home.content');
    }
}
