<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class AboutPageController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('about', compact('profile'));
    }
}

