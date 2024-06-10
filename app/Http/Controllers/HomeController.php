<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Project;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('home', compact('projects'));
    }
}
