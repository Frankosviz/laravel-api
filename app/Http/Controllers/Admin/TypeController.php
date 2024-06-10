<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Type $type)
    {
        $type = new Type();
        return view('admin.types.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Type::generateSlug($form_data['name']);

        $new_type = Type::create($form_data);
        return redirect()->route('admin.dashboard', $new_type->slug)->with('success', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $types = Type::where('slug', $slug)->first();
        return view('admin.types.show', compact('types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $form_data= $request->all();
        if ($type->title !== $form_data['name']) {
            $form_data['slug'] = Type::generateSlug($form_data['name']);     
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.dashboard')->with('deleted', 'Type deleted successfully');
    }
}
