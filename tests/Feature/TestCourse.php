<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TestCourse extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_all_courses()
    {
        $response = $this->get('courses');

        $response->assertStatus(200);
    }
    public function test_post_lecture()
    {
        $response = $this->post('lecture', ["name" => "Aula 14", 
                                            "description" => "Descrição aula 14", 
                                            "link" => "R8CBoVc_OMI",
                                            "course_id" => "1"]);


        $response->assertStatus(404);
    }

    public function test_put_lecture()
    {
        $response = $this->put('lecture/1}', ["id" => '8',
                                            "name" => "Aula 14", 
                                            "description" => "Descrição aula 14", 
                                            "link" => "R8CBoVc_OMI",
                                            "course_id" => "1"]);


        $response->assertStatus(200);
    }

    public function test_delete_lecture()
    {
        $response  = $this->delete('lecture/2');

        $response->assertStatus(202);
    }

}
