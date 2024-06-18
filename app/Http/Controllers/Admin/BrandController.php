<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Photo;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.brand.index',[
            'brands'=>Brand::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
        // Validate request data
        $validateData = $request->validate($rules);
    
        // Image management using helper function
        if ($request->hasFile('image')) {
            $imageName = Photo::uploadImage($request->file('image'), '/images/brand/');
            $validateData['image'] = $imageName;
        }
    
        // Store data
        Brand::create($validateData);
    
        // Redirect
        return back()->withSuccess('New Brand has been created!');
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
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit',[
            'brand'=>$brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $rules = [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        ];
        // Validate request data
        $validateData = $request->validate($rules);
    
        // Image management using helper function
        if ($request->hasFile('image')) {
            // Delete previous image
            Photo::deleteImage('/images/brand/' . $brand->image);

            // Upload new image
            $imageName = Photo::uploadImage($request->file('image'), '/images/brand/');
            $validateData['image'] = $imageName;
        }
    
        // Store data
        $brand->update($validateData);
    
        // Redirect
        return redirect()->route('brands.index')->withSuccess('The item has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if($brand->image){
            // Delete image
            Photo::deleteImage('/images/brand/' . $brand->image);
        }
        $brand->delete();
        return back()->with('success', 'The item has been successfully deleted.');
    }
}
