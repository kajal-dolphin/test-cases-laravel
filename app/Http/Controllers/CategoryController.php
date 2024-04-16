<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = Category::get();
        return view('category.index',compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        $categoryData = $this->category->create([
            'name' => $request->name
        ]);

        return redirect()->route('category.index')->with('success','Category Record Created Successfully !!!');
    }

    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        return view('category.edit',compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $categoryData = $this->category->where('id',$id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('category.index')->with('success','Category Record Updated Successfully !!!');
    }

    public function delete($id)
    {
        $categoryData =  $this->category->where('id',$id)->delete();

        return redirect()->route('category.index')->with('success','Category Record Deleted successfully !!');
    }
}
