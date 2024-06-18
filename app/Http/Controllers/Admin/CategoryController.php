<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Photo;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
        * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',[
            'categories'=>$categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rules = [
            'name' => 'required|unique:categories',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
        //check validate 
        $validateData = $request->validate($rules);

        // Image management using helper function
        if ($request->hasFile('image')) {
            $imageName = Photo::uploadImage($request->file('image'), '/images/Category/');
            $validateData['image'] = $imageName;
        }
        //store data
        Category::create($validateData);
        return back()->withSuccess('New Category Create Successfully!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',[
            'category'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|unique:categories,name,' . $category->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
        
        // Check validation
        $validatedData = $request->validate($rules);
        
        // Image management using helper function
        if ($request->hasFile('image')) {
            // Delete previous image
            Photo::deleteImage('/images/Category/' . $category->image);

            // Upload new image
            $imageName = Photo::uploadImage($request->file('image'), '/images/Category/');
            $validatedData['image'] = $imageName;
        }
    
        // Store data
        $category->update($validatedData);
    
        // Redirect
        return redirect()->route('categories.index')->withSuccess('The item has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->image){
            // Delete image
            Photo::deleteImage('/images/category/' . $category->image);
        }
        $category->delete();
        return back()->with('success', 'The item has been successfully deleted.');
    }

}
