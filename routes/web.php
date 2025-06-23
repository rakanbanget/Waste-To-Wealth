<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\IdeaGeneratorController;

Route::get('/', function () {
    return view('chat');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/api/generate-idea', [IdeaGeneratorController::class, 'generateIdea']);
