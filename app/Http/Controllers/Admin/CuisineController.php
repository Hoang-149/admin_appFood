<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cuisine = Cuisine::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'asc')
            ->paginate(10);

        // $user = User::find()

        return view('admin.cuisine.index', compact('cuisine'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Category::orderBy('id', 'DESC')->get();
        return view('admin.cuisine.create')->with(compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:cuisine|max:255',
                'image' => 'required|image|mimes:jpg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
                'ingredients' => 'required',
                'steps' => 'required',
                'duration' => 'max:255',
                'status' => 'required',
                'difficulty' => 'required',
                'category' => 'required',
                'websiteURL' => 'max:255',
                'youtubeURL' => 'max:255',
            ],
            [
                'name.required' => 'Tên người dùng phải có nhé',
                'image.required' => 'Hình ảnh phải có nhé',
                'ingredients.required' => 'Nguyên liệu phải có nhé',
                'steps.required' => 'Các bước thực hiện phải có nhé',
            ]
        );

        $crCuisine = new Cuisine();
        $crCuisine->name = $data['name'];

        $get_image = $request->image;
        $path = 'public/uploads/cuisine/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $crCuisine->image = $new_image;

        $crCuisine->user_id = Auth::user()->id;
        $crCuisine->category_id = $data['category'];
        $crCuisine->duration = $data['duration'];
        $crCuisine->difficulty = $data['difficulty'];
        $crCuisine->ingredients = $data['ingredients'];
        $crCuisine->steps = $data['steps'];
        $crCuisine->websiteURL = $data['websiteURL'];
        $crCuisine->youtubeURL = $data['youtubeURL'];
        $crCuisine->status = $data['status'];
        $crCuisine->save();

        return redirect()->back()->with('status', 'Thêm món ăn thành công');
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
        $cate = Category::orderBy('id', 'DESC')->get();
        $cuisine = Cuisine::find($id);
        return view('admin.cuisine.edit')->with(compact('cuisine', 'cate'));
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
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'image' => 'image|mimes:jpg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
                'ingredients' => 'required',
                'steps' => 'required',
                'duration' => 'integer',
                'status' => 'required',
                'difficulty' => 'required',
                'category' => 'required',
                'websiteURL' => 'max:255',
                'youtubeURL' => 'max:255',
            ],
            [
                'name.required' => 'Tên người dùng phải có nhé',
                'image.required' => 'Hình ảnh phải có nhé',
                'ingredients.required' => 'Nguyên liệu phải có nhé',
                'steps.required' => 'Các bước thực hiện phải có nhé',
            ]
        );

        $crCuisine =  Cuisine::find($id);
        $crCuisine->name = $data['name'];

        $get_image = $request->image;
        if ($get_image) {
            $path = 'public/uploads/cuisine/' . $crCuisine->image;

            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/cuisine/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $crCuisine->image = $new_image;
        }
        $crCuisine->user_id = Auth::user()->id;
        $crCuisine->category_id = $data['category'];
        $crCuisine->duration = $data['duration'];
        $crCuisine->difficulty = $data['difficulty'];
        $crCuisine->ingredients = $data['ingredients'];
        $crCuisine->steps = $data['steps'];
        $crCuisine->websiteURL = $data['websiteURL'];
        $crCuisine->youtubeURL = $data['youtubeURL'];
        $crCuisine->status = $data['status'];
        $crCuisine->save();

        return redirect()->back()->with('status', 'Cập nhật món ăn thành công');
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
        $path = 'public/uploads/cuisine/' . $cuisine->image;
        if (file_exists($path)) {
            unset($path);
        }
        Cuisine::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa món thành công!');
    }
}
