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
            'success' => true,
            'results' => $projects
        ]);
    }
    // Possiamo passare anche lo slug invece dell'id
    public function show($id)
    {
        // Andiamo a passare tutti i dati del database relazionati al nostro frontend tramite il ->with()... Eager Loading e Lazy Loading (da studiare)
        $project = Project::where('id', $id)->with('type', 'technologies')->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'results' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ]);
        }
    }
}
