<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    // inviamo la risposta tramite file json al nostro front-end
    {
        $projects = Project::all();
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($id)
    {
        // Andiamo a passare tutti i dati del database relazionati al nostro frontend tramite il ->with()
        $project = Project::where('id', $id)->with('type', 'technologies')->first();
        return response()->json([
            'success' => true,
            'results' => $project
        ]);
    }
}
