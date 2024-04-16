<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookContrller extends Controller
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index(){
        $books = Book::with('category')->get();
        return view('book.index',compact('books'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('book.create',compact('categories'));
    }

    public function store(BookRequest $request)
    {
        $bookData = $this->book->create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'price' => $request->price,
        ]);

        return redirect()->route('book.index')->with('success','Book Record Created Successfully !!');
    }

    public function edit($id)
    {
        $books = Book::where('id',$id)->first();
        $categories = Category::get();
        return view('book.edit',compact('books','categories'));
    }

    public function update(BookRequest $request, $id)
    {
        $bookData = $this->book->where('id',$id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'price' => $request->price,
        ]);

        return redirect()->route('book.index')->with('success','Book Record Updated Successfully !!');
    }

    public function delete($id)
    {
        $bookData = $this->book->where('id',$id)->delete();

        return redirect()->route('book.index')->with('success','Book Record Deleted Successfully !!');
    }
}
