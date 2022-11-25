<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class VideosController extends Controller
{
    public function get(Video $video){
        return $video;
    }
}
