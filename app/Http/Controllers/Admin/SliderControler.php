<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Photo;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.slider.index',[
            'sliders'=>Slider::all()
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:500',
        ];
        //check validate 
        $validateData = $request->validate($rules);

        // Image management using helper function
        if ($request->hasFile('image')) {
            $imageName = Photo::uploadImage($request->file('image'), '/images/sliders/');
            $validateData['image'] = $imageName;
        }
        //store data
        Slider::create($validateData);
        return back()->withSuccess('New slider Create Successfully!');
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
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',[
            'slider'=>$slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $rules = [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
        
        // Check validation
        $validatedData = $request->validate($rules);
        
        // Image management using helper function
        if ($request->hasFile('image')) {
            // Delete previous image
            Photo::deleteImage('/images/sliders/' . $slider->image);

            // Upload new image
            $imageName = Photo::uploadImage($request->file('image'), '/images/sliders/');
            $validatedData['image'] = $imageName;
        }
    
        // Store data
        $slider->update($validatedData);
    
        // Redirect
        return redirect()->route('sliders.index')->withSuccess('The item has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if($slider->image){
            // Delete image
            Photo::deleteImage('/images/sliders/' . $slider->image);
        }
        $slider->delete();
        return back()->with('success', 'The item has been successfully deleted.');
    }
}
