<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Photo;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subcategory.index',[
            'categories'=>Category::all(),
            'subcategories'=>SubCategory::all()
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
            'category_id'=>'required',
            'name'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
         // Check validation
         $validateData = $request->validate($rules);
         // Image management using helper function
        if ($request->hasFile('image')) {
            $imageName = Photo::uploadImage($request->file('image'), '/images/SubCategory/');
            $validateData['image'] = $imageName;
        }
       //store data
       SubCategory::create($validateData);
       return back()->withSuccess('New SubCategory Create Successfully!');
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
    public function edit(SubCategory $subcategory)
    {
        return view('admin.subcategory.edit',[
            'subcategory'=>$subcategory,
            'categories'=>Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $rules = [
            'category_id'=>'required',
            'name'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
         // Check validation
         $validateData = $request->validate($rules);
         if ($request->hasFile('image')) {
            // Delete previous image
            Photo::deleteImage('/images/SubCategory/' . $subcategory->image);

            // Upload new image
            $imageName = Photo::uploadImage($request->file('image'), '/images/SubCategory/');
            $validateData['image'] = $imageName;
        }
       //update data
       $subcategory->update($validateData);
       return redirect()->route('subcategories.index')->withSuccess('The item has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subcategory)
    {
        if($subcategory->image){
            // Delete image
            Photo::deleteImage('/images/SubCategory/' . $subcategory->image);
        }
        $subcategory->delete();
        return back()->with('success', 'The item has been successfully deleted.');
    }
}
