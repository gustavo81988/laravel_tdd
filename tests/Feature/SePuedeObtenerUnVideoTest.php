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
        factory(Video::class)->create([
            'id' => 1,
            'titulo' => 'Mi titulo',
            'descripcion' => 'Mi descripcion',
            'url_video' => 'http://youtube.com/test'
        ]);

        $respuesta = $this->get('/api/videos/1');
    
        $respuesta->assertJsonFragment([
            'id' => 1,
            'titulo' => 'Mi titulo',
            'descripcion' => 'Mi descripcion',
            'url_video' => 'http://youtube.com/test'
        ]);
    }
    }
    
