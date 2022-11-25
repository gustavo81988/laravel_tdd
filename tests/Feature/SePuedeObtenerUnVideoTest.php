<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Video;

class SePuedeObtenerUnVideoTest extends TestCase
{
    use RefreshDatabase;

    public function testSePuedeObtenerUnVideoPorSuId(){
        $video = factory(Video::class)->create();

        $respuesta = $this->get(
            sprintf(
                '/api/videos/1',
                $video->id
            )
        )->assertJsonFragment($video->toArray());
    
    }
}
    
