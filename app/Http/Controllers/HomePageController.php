<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Slider;
use App\Models\Category;

class HomePageController extends Controller
{
    use HttpResponses;

    /**API controller*/
    public function homepage(Request $request){
        
        $slider = Slider::where('status', true)->get();
        $category = Category::where('status', true)->get();
        
        return $this->success([
            'Slider' => $slider,

            'Category'=> $category,
            
        ]);
    }


    /**web controller*/

    public function showslider(Request $request){
        $slider = $request->all();
        $slider = Slider::where('status', true)->latest()->get();

        return view('homepage.slider.table')->with(compact('slider'));
    }

    /** --------------- slider data table
     * =============================================*/
    public function createslider()
    {
        return view('homepage.slider.form');
    }



    /** --------------- Store slider
     * =============================================*/
    public function storeslider(Request $request)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png,webp'
        ]);

        $data = $request->all();

        if($request->hasFile('image'))
        {
            $FileName = $request->image->hashName(); // Generate a unique, random name...

            // save into folder
            $request->image->move(public_path('slider'), $FileName);

            // save into database
            $path = 'slider/' . $FileName;

            $data['image'] = $path;
        }

        $slider = Slider::create($data);

        return to_route('slider')->with('success', 'Record created successfully');
    }


    
    /** --------------- slider data edit
     * =============================================*/
    public function editslider(Request $request)
    {
        $key = $request->key;
        $slider = Slider::find($key);

        return view('homepage.slider.form')->with(compact('slider'));
    }




    /** --------------- Update slider
     * =============================================*/
    public function updateslider(Request $request)
    {
        $key = $request->key;

        $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png,webp'
        ]);

        
        $data = $request->all();

        if($request->hasFile('image'))
        {
            $FileName = $request->image->hashName(); // Generate a unique, random name...

            // save into folder
            $request->image->move(public_path('slider'), $FileName);

            // save into database
            $path = 'slider/' . $FileName;

            $data['image'] = $path;
        }

        $slider = Slider::find($key)->update($data);

        return to_route('slider')->with('success', 'Record updated successfully');
    }



    /** --------------- Update slider
     * =============================================*/
    public function destroyslider(Request $request)
    {
        $key = $request->key;

        $slider = Slider::destroy($key);

        return to_route('slider')->with('success', 'Record deleted successfully');
    }

    /**End Slider*/

    /**Catecgory Start*/


    /** --------------- categorys data table
     * =============================================*/
    public function showcategory()
    {
        $categorys = Category::where('status', true)->latest()->get();

        return view('homepage.category.table')->with(compact('categorys'));
    }


    /** --------------- categorys data table
     * =============================================*/
    public function createcategory()
    {
        return view('homepage.category.form');
    }



    /** --------------- Store categorys
     * =============================================*/
    public function storecategory(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:categories,name',
            'icon'  => 'nullable|mimes:jpg,jpeg,png,webp',
            'short_description'=>'required',
        ]);

        $data = $request->all();

        if($request->hasFile('icon'))
        {
            $FileName = $request->icon->hashName(); // Generate a unique, random name...

            // save into folder
            $request->icon->move(public_path('category'), $FileName);

            // save into database
            $path = 'category/' . $FileName;

            $data['icon'] = $path;
        }
        
        $category = Category::create($data);

        return to_route('category')->with('success', 'Record created successfully');
    }


    
    /** --------------- edit categorys data
     * =============================================*/
    public function editcategory(Request $request)
    {
        $key = $request->key;
        $category = Category::find($key);

        return view('homepage.category.form')->with(compact('category'));
    }




    /** --------------- Update categorys
     * =============================================*/
    public function updatecategory(Request $request)
    {
        $key = $request->key;

        $request->validate([
            'name'  => 'required|unique:catagories,name,',
            'icon'  => 'nullable|mimes:jpg,jpeg,png,webp',
            'short_description'=>'required',
        ]);

        
        $data = $request->all();

        
        $category = Category::find($key)->update($data);

        return to_route('category')->with('success', 'Record updated successfully');
    }



    /** --------------- delete category
     * =============================================*/
    public function destroycategory(Request $request)
    {
        $key = $request->key;

        $category = Category::destroy($key);

        return to_route('category')->with('success', 'Record deleted successfully');
    }


}
