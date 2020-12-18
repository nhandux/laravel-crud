<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paged = !empty($request->paged) ? $request->paged : 2;

        $books = Book::when(!empty($request->keywords), function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->keywords . '%');
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate($paged);

        return $books;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book([
            'name' => $request->input('name'),
            'author' => $request->input('author')
        ]);
        $book->save();

        return response()->json('The book successfully added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());

        return response()->json('The book successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    { 
        $book->delete();

        return response()->json('The book successfully deleted');
    }
}
