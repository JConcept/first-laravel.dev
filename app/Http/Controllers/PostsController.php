<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }
    public function show($post)
    {
        return view('posts.show');
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store()
    {
        // dd(request()->all());
        // dd(request(['title', 'body']));
        // var_dump(request()->all());
        
        // First :
        // // Récupérer les données via request()
        // $post = new Post;
        // $post->title = request('title');
        // $post->body = request('body');
        
        // // Enregistrer dans la SGBD
        // $post->save();
        // END first
        
        // // SI solution 1 dans : app/post.php
        // // Récupérer les données via request() + sauvegarder dans la base de donnée via le modèle post.php
        // Post::create([
        //     'title' => request('title'),
        //     'body' => request('body')
        // ]);

        // SI solution 2 dans: app/post.php + sauvegarder dans la base de donnée via le modèle post.php
        // Récupérer les données via request()
        Post::create(request()->all());
        
        // Rediriger
        return redirect('/');
    }
}
