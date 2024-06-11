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
        // Possiamo passare i dati al front end anche paginati
        // $projects = Project::paginate(3) | invece di | $projects = Project::all();
        $projects = Project::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Ok',
            'results' => $projects
        ], 200);
    }
    // Possiamo passare anche lo slug invece dell'id
    public function show($slug)
    {
        // Andiamo a passare tutti i dati del database relazionati al nostro frontend tramite il ->with()... Eager Loading e Lazy Loading (da studiare)
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        if ($project) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ok',
                'results' => $project
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }
    }
}
