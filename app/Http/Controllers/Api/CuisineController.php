<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\Favourite;
use App\Notifications\ProductApprovedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function approve($id)
    {
        $cuisine = Cuisine::findOrFail($id);

        return response()->json([
            'status' => 200,
            'status' => $cuisine->status,
        ]);
    }

    public function index()
    {
        $cuisine = Cuisine::withCount('favourite')->where('status', '1')->limit(4)->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 200,
            'cuisine' => $cuisine,
        ]);
    }

    public function indexAll()
    {
        $cuisine = Cuisine::withCount('favourite')->where('status', '1')->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 200,
            'cuisine' => $cuisine,
        ]);
    }

    public function cuisineOfCate($id)
    {
        $cuisineOfCate = Cuisine::where('category_id', $id)->where('status', '1')->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 200,
            'cuisineOfCate' => $cuisineOfCate,
        ]);
    }
    public function categoryAll()
    {
        $category = Category::where('status', '0')->get();
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
        $cuisine_favourite = DB::table('cuisine')->join('favourites', 'cuisine.id', '=', 'favourites.id_cuisine')->where('favourites.id_user', '=', $id)->get();
        return response()->json([
            'status' => 200,
            'cuisine_favourite' => $cuisine_favourite,
        ]);
    }
    public function showUser($id)
    {
        $cuisine = Cuisine::where('user_id', $id)->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 200,
            'cuisine' => $cuisine,
        ]);
    }

    public function search($key)
    {
        $cuisine = Cuisine::where('name', 'LIKE', "%$key%")->orWhere('ingredients', 'LIKE', "%$key%")->orWhere('steps', 'LIKE', "%$key%")->orWhere('difficulty', 'LIKE', "%$key%")->orWhere('duration', 'LIKE', "%$key%")
            ->get();
        // $cuisine = DB::table('cuisine')
        //     ->where('name', 'like', '%' . $key . '%')
        //     ->orWhere('ingredients', 'like', '%' . $key . '%')
        //     ->orWhere('steps', 'like', '%' . $key . '%')
        //     ->orWhere('difficulty', 'like', '%' . $key . '%')
        //     ->orWhere('duration', 'like', '%' . $key . '%')
        //     ->orderBy('id', 'desc')
        //     ->get()
        //     ->collate('utf8_general_ci');
        return response()->json([
            'status' => 200,
            'cuisine' => $cuisine,
        ]);
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
        $crCuisine = Cuisine::find($id);

        // if ($crCuisine->status == 0) {
        $crCuisine->name = $request->input('name');

        if ($request->hasFile('image')) {

            $path = $crCuisine->image;

            if (File::exists($path)) {
                File::delete($path);
            }

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

        $crCuisine->update();

        return response()->json([
            'status' => 200,
            'message' => 'Cập Nhật Công Thức Thành Công',
        ]);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'Không Thể Cập Nhật Công Thức Món Ăn Này',
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuisine = Cuisine::find($id);

        // if ($cuisine->status == 0) {

        $path = 'public/uploads/cuisine/' . $cuisine->image;
        if (file_exists($path)) {
            unset($path);
        }
        Cuisine::find($id)->delete();

        return response()->json([
            'status' => 200,
            'cuisine' => 'Xóa Công Thức Món Ăn Thành Công',
        ]);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'cuisine' => 'Không Thể Xóa Công Thức Món Ăn Này',
        //     ]);
        // }
    }
}
