<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use App\Models\Technology;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        $technologies = Technology::all();

        return view('admin.projects.index', compact('projects', 'technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        $form_data['user_id'] = Auth::id();

        if ($request->hasFile('image_path')){
            // $img_path = $request->file('image_path')->storeAs(
            //     'project_image',
            //     'f-d-image.png'
            // )
            $img_path = Storage::put('project_image', $request->image_path);
            // $form_data['image'] = $path;
            $form_data['image_path'] = $img_path;
        }
        //dd($img_path);

        
        
        $new_project = Project::create($form_data);
        if ($request->has('technologies')) {
            $new_project->technologies()->attach($request->technologies);
        }
        return redirect()->route('admin.dashboard', $new_project->slug)->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Possibile soluzione passando lo $slug alla funzione show
        $project = Project::where('slug', $slug)->first();
        // dd($project);
        
        return view('admin.projects.show', compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data= $request->all();
        $form_data['user_id'] = Auth::id();
        if ($project->title !== $form_data['title']) {
            $form_data['slug'] = Project::generateSlug($form_data['title']);     
        }

        if ($request->hasFile('image_path')){
            if ($project->image_path) {
                Storage::delete($project->image_path);
            }
            $name = $request->file('image_path')->getClientOriginalName();
            $path = Storage::putFileAs('project_image', $request->image_path, $name);
            $form_data['image_path'] = $path;
        }

        $form_data = $request->validated();
        $project->update($form_data);

        // Con questa funzione andiamo a verificare l'ultima query eseguita, 
        // ricordarsi di aggiungere use Illuminate\Support\Facades\DB; sopra.
        
        // DB::enableQueryLog();
        // $project->update($form_data);
        // $query = DB::getQueryLog();
        // dd($query);

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image_path) {
            Storage::delete($project->image_path);
        }
        $project->delete();
        return redirect()->route('admin.dashboard')->with('deleted', 'Project deleted successfully');
    }

    // public function validation($data) {
    //     // costruiamo il nostro validator
    //     $validator = Validator::make($data, [
    //         'title' => 'required|max:255',
    //         'description' => 'nullable|min:5|max:255',
    //         'technologies_used' => 'nullable|max:255',
    //         'start_date' => 'nullable|date',
    //         'end_date' => 'nullable|date|after:start_date',
    //         'url' => 'nullable|url',
    //         'repository_url' => 'nullable|url',
    //         'image_path' => 'nullable|url',
    //         'status' => 'required|max:255',
    //     ], [
    //         'title.required' => 'This title is required bro!',
    //         'title.max' => 'Mate.. The title can not be longer than 255 characters',
    //         'description.min' => 'Can you write more than 4 characters?',
    //         'description.max' => 'Are you kidding me? The description can not be longer than 255 characters',
    //         'technologies_used.max' => 'The technologies used can not be longer than 255 characters',
    //         'end_date.after' => 'This project is too old, mate. It can not be finished before its start date.',
    //         'status.required' => 'This status is required bro!'
    //     ],
    //     )->validate();

    //     return $validator;
    // }
}
