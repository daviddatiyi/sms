<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
    
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(){
        return view('posts.create');
    }
    
    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg|max:1999',
        ]);

        $imagePath = (request('image')->store('uploads', 'public'));
        Auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image'=>$imagePath,
        ]);
        return redirect('/p/create');
            
    }
}
