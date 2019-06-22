<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
   
        
    public function test_guest_cannot_create_projects(){
            
        // $this->withoutExceptionHandling();

        $attributes = factory('App\Project')->raw(['owner_id' => null]);

        $this->post('/projects', $attributes)->assertRedirect('login');
    }
    
    public function test_guest_cannot_view_projects(){
            
        // $this->withoutExceptionHandling(); 

        $this->get('/projects')->assertRedirect('login');
    }
    
    public function test_guest_cannot_view_a_single_project(){
            
        // $this->withoutExceptionHandling(); 
        $project = factory('App\Project')->create();

        $this->get($project->path())->assertRedirect('login');
    }
    
     public function test_a_user_can_create_a_project(){

        $this->withoutExceptionHandling();
        
        $this->actingAs(factory('App\User')->create());

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];
        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);
        
        $this->get('/projects')->assertSee($attributes['title']);

    }
 
        
    public function test_a_user_can_view_their_project(){

        $this->be(factory('App\User')->create());
        
        $this->withoutExceptionHandling();

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
        
        $this->get($project->path())
        ->assertSee($project->title)
        ->assertSee($project->description); 
    }

    public function test_an_authenticated_user_cannot_view_the_projects_of_others(){
        
        $this->be(factory('App\User')->create());
        
        // $this->withoutExceptionHandling();

        //Comparé au test plus haut (& voir le factory project), son owner id ne correspond pas à l'id de l'user, donc ce projet ne lui appartient pas, on renvoi une 403
        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title(){
        
        $this->actingAs(factory('App\User')->create());
        
        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description(){
        
        $this->actingAs(factory('App\User')->create());
        
        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}