<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    public function index() {

        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project){
        
        // $project = Project::findOrFail(request('project')); Remplacé par (Project $project)

        return view('projects.show', compact('project'));
    }

    public function store(){

        //validate  
        auth()->user()->projects()->create(request()->validate([
            'title' =>'required', 
            'description' =>'required'
            ]));

        //persist data
        // Project::create($attributes); ici commenté car on le creer déjà au dessus

        //redirected
        return redirect('/projects');
    }

}