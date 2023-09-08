<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  function index()
  {
    # bookテーブルに入っているデータを全て取ってくる
    $books = Auth::user()->books;
    # 使うビューファイルを指定
    # compactにはビューファイルに送るデータを選択
    return view("books.index", compact("books"));
  }
  function show(Book $book)
  {
    if ($book->user_id != Auth::user()->id) {
      return redirect()->route('books.index');
    }
    return view("books.show", compact("book"));
  }
  public function create()
  {
    return view("books.create");
  }
  public function store(Request $request)
  {
    $book = new Book();
    $book->fill($request->all());
    $book->user_id = Auth::user()->id;
    $book->save();

    return redirect()->route('books.show', $book);
  }
  public function edit(Book $book)
  {
    if ($book->user_id != Auth::user()->id) {
      return redirect()->route('books.index');
    }
    return view("books.edit", compact("book"));
  }
  public function update(Request $request, Book $book)
  {
    if ($book->user_id != Auth::user()->id) {
      return redirect()->route('books.index');
    }
    $book->fill($request->all());
    $book->save();
    return redirect()->route('books.show', $book);
  }
  public function destroy(Book $book)
  {
    if ($book->user_id != Auth::user()->id) {
      return redirect()->route('books.index');
    }
    $book->delete();
    return redirect()->route('books.index');
  }
}
