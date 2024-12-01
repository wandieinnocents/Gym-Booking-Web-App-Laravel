<?php

use App\Models\User;
use Database\Seeders\ClassTypeSeeder; // Import your seeder
use App\Models\ClassType;


test('instructor can access instructor dashboard', function () {
        $instructor = User::factory()->create([
            'role' => 'instructor'
        ]);


        $response = $this->actingAs($instructor)->get('/dashboard');
        $response->assertRedirectToRoute('instructor.dashboard');

});

test('instructor can schedule a class', function(){

    //create instructor
    $instructor = User::factory()->create([
        'role' => 'instructor'
    ]);

    //seed class types
    $this->seed(ClassTypeSeeder::class);


    $response = $this->actingAs($instructor)->post('/instructor/schedule',[
        'class_type_id' => ClassType::first()->id,
        'date' => "2024-12-3",
        'time' => "09:00:00",
    ]);

    //expects a redirect after post
    $response->assertStatus(302);

    //expects redirect to be this
    $response->assertRedirectToRoute('schedule.index');


});
