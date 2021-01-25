<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
    {
        $posts = DB::select('select * from posts');
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $name = $request->get('name');
        $detail = $request->get('detail');
        $author = $request->get('author');
        $posts = DB::insert('insert into posts(`name`, detail, author) value (?, ?, ?)', [$name, $detail, $author]);
        if ($posts) {
            $red = redirect('posts')->with('success', 'Данные были добавлены');
        }else {
            $red = redirect('posts/create')->with('danger', 'Произошла ошибка, проверьте данные');
        }
        return $red;
    }


    public function show(Post $post)
    {
        //
    }


    public function edit(Post $post)
    {
        //
    }


    public function update(Request $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        //
    }
}
