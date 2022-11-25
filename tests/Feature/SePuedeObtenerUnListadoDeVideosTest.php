<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Video;
use Carbon\Carbon;

class SePuedeObtenerUnListadoDeVideosTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSePuedeObtenerUnListadoDeVideos()
    {
        factory(Video::class,2)->create();

        $this->getJson('/api/videos')
            ->assertOk()
            ->assertJsonCount(2)
        ;
    }

    public function testElPayloadContieneLosVideosEnElSistema()
    {
        $videos = factory(Video::class,2)->create();

        $this->getJson('/api/videos')
            ->assertJson($videos->toArray())
        ;
    }

    public function testLosVideosEstanOrdenadosDeMasNuevosAMasViejos()
    {
        $videoHoy = factory(Video::class)->create([
            'created_at' => Carbon::now()
        ]);

        $videoAyer = factory(Video::class)->create([
            'created_at' => Carbon::yesterday()
        ]);

        $videoHaceUnMes = factory(Video::class)->create([
            'created_at' => Carbon::now()->subDays(30)
        ]);

        $response = $this->getJson('/api/videos')
            ->assertJsonPath('0.id',$videoHoy->id)
            ->assertJsonPath('1.id',$videoAyer->id)
            ->assertJsonPath('2.id',$videoHaceUnMes->id)
        ;

        // [$videoPrimero,$videoSegundo,$videoTercero] = $response->json();

        // $this->assertEquals($videoHoy->id,$videoPrimero['id']);
        // $this->assertEquals($videoAyer->id,$videoSegundo['id']);
        // $this->assertEquals($videoHaceUnMes->id,$videoTercero['id']);
    }
}
