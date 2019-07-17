<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    // Il est possible de rajouter le middleware dans ce controlleur à la place de le mettre dans le web. 
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index() {

        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project){
        
        // $project = Project::findOrFail(request('project')); Remplacé par (Project $project)
 
        if(auth()->user()->isNot($project->owner)){
            abort(403);
        }

        return view('projects.show', compact('project'));
    }
    public function create(){
        return view('projects.create');
    }

    public function store(){


        $attributes = request()->validate([
            'title' =>'required', 
            'description' =>'required'
            ]);

        //validate  
        $project = auth()->user()->projects()->create($attributes);

        //persist data
        // Project::create($attributes); ici commenté car on le creer déjà au dessus

        //redirected
        return redirect($project->path());
    }

}