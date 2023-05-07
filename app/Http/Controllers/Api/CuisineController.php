<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cuisine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuisine = Cuisine::all();
        return response()->json([
            'status' => 200,
            'cuisine' => $cuisine,
        ]);
    }
    public function category()
    {
        $category = Category::all();
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:cuisine|max:255',
            'image' => 'required|image|mimes:jpg,png,gif,svg|max:2048',
            'ingredients' => 'required',
            'steps' => 'required',
            'duration' => 'max:255',
            'user_id' => 'required',
            'category_id' => 'required',
            'websiteURL' => 'max:255',
            'youtubeURL' => 'max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {

            $crCuisine = new Cuisine();
            $crCuisine->name = $request->input('name');

            if ($request->hasFile('image')) {

                $get_image = $request->file('image');
                $path = 'public/uploads/cuisine/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);

                $crCuisine->image = $new_image;
            }


            $crCuisine->user_id = $request->input('user_id');
            $crCuisine->category_id = $request->input('category_id');
            $crCuisine->duration = $request->input('duration');
            $crCuisine->difficulty = $request->input('difficulty');
            $crCuisine->ingredients = $request->input('ingredients');
            $crCuisine->steps = $request->input('steps');
            $crCuisine->websiteURL = $request->input('websiteURL');
            $crCuisine->youtubeURL = $request->input('youtubeURL');
            $crCuisine->status = $request->input('status') == true ? '1' : '0';

            $crCuisine->save();
            return response()->json([
                'status' => 200,
                'message' => 'Thêm Món Thành Công!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
