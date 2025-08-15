<?php

namespace Tests\Feature;

use App\Models\Survey;
use App\Http\Controllers\SurveyController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SurveyFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_list_surveys(): void
    {
        Survey::factory()->count(3)->create();
        
        $response = $this->get(route('surveys.index'));
        
        $response->assertStatus(200)
                ->assertViewIs('surveys.index')
                ->assertSee('Surveys');
    }

    public function test_create_survey(): void
    {
        $surveyData = ['name' => 'My Test Survey'];
        
        $response = $this->post(route('surveys.store'), $surveyData);
        
        $response->assertRedirect()
                ->assertSessionHas('ok', 'Survey created');
        
        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function test_show_survey(): void
    {
        $survey = Survey::factory()->create();
        
        $response = $this->get(route('surveys.show', $survey));
        
        $response->assertStatus(200)
                ->assertViewIs('surveys.show');
    }
}