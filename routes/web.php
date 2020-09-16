<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Events\FirstPersonEvent;
use App\Events\SecondPersonEvent;

Route::get('/first_person', function(){
    return view('person1');
});

Route::get('/second_person', function(){
    return view('person2');
});

Route::post('/first_person_text', function(){
    $text = request()->text;

    event(new FirstPersonEvent($text));
});

Route::post('/second_person_text', function(){
    $text = request()->text;

    event(new SecondPersonEvent($text));
});


