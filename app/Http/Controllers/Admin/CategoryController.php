<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('admin.cate.index', compact('category'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cate.create');
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
                'name' => 'required|unique:category|max:255',
                'hinhanh' => 'required|image|mimes:jpg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên phải có nhé',
                'hinhanh.required' => 'Hình ảnh phải có nhé',
            ]
        );

        $crCate = new Category();
        $crCate->name = $data['name'];

        $get_image = $request->hinhanh;
        $path = 'public/uploads/cate/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $crCate->image = $new_image;

        $crCate->status = $data['status'];

        $crCate->save();

        return redirect()->back()->with('status', 'Thêm danh mục thành công');
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
        $cate = Category::find($id);
        return view('admin.cate.edit')->with(compact('cate'));
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
                'hinhanh' => 'image|mimes:jpg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên phải có nhé',
                'hinhanh.required' => 'Hình ảnh phải có nhé',
            ]
        );

        $crCate = Category::find($id);
        $crCate->name = $data['name'];

        $get_image = $request->hinhanh;

        if ($get_image) {

            $path = 'public/uploads/cate/' . $crCate->image;

            if (file_exists($path) && $crCate->image != null) {
                unlink($path);
            }

            $path = 'public/uploads/cate/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $crCate->image = $new_image;
        }

        $crCate->status = $data['status'];
        $crCate->save();

        return redirect()->back()->with('status', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $path = 'public/uploads/cate/' . $category->image;
        if (file_exists($path)) {
            unset($path);
        }
        Category::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa danh mục thành công!');
    }
}
