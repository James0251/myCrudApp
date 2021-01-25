<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
    {
        $posts = DB::table('posts')->paginate(4);
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }

    // Функция поиска
    public function search(Request $request) {
        $search = $request->get('search');
    // Ищем по названию поста, по описанию или по имени автора
        $posts = DB::table('posts')->where('name', 'like', '%'.$search.'%')
            ->orWhere('detail', 'like', '%'.$search.'%')
            ->orWhere('author', 'like', '%'.$search.'%')
            ->paginate(3);
        return view('posts.index', compact('posts'));
    }


    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'author' => 'required'
        ]);
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


    public function show($id)
    {
        $posts = DB::select('select * from posts where id=?', [$id]);
        return view('posts.show', compact('posts'));
    }


    public function edit($id)
    {
        $posts = DB::select('select * from posts where id=?', [$id]);
        return view('posts.edit', compact('posts'));
    }


    public function update(Request $request, $id)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'author' => 'required'
        ]);
        $name = $request->get('name');
        $detail = $request->get('detail');
        $author = $request->get('author');
        $posts = DB::update('update posts set `name`=?, detail=?, author=? where id=?', [$name, $detail, $author, $id]);
        if ($posts) {
            $red = redirect('posts')->with('success', 'Данные были обновлены');
        }else {
            $red = redirect('posts/'.$id.'/edit')->with('danger', 'Произошла ошибка. Вы не внесли никаких изменений!');
        }
        return $red;
    }


    public function destroy($id)
    {
        $posts = DB::delete('delete from posts where id=?', [$id]);
        $red = redirect('posts');
        return $red;
    }

    public function deleteAll(Request $request) {
        $ids = $request->get('ids');
        $dbs = DB::delete('delete from posts where id in ('.implode(",", $ids).')');
        return redirect('posts');
    }
}
