<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = Banner::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('admin.banner.index', compact('banners'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexBanner()
    {
        $banner = Banner::where('status', '0')->get();
        return response()->json([
            'status' => 200,
            'banner' => $banner,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
                'name' => 'required|unique:banner|max:255',
                'hinhanh' => 'required|image|mimes:jpg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên phải có nhé',
                'hinhanh.required' => 'Hình ảnh phải có nhé',
            ]
        );

        $crBanner = new Banner();
        $crBanner->name = $data['name'];

        $get_image = $request->hinhanh;
        $path = 'public/uploads/banner/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $crBanner->image = $new_image;

        $crBanner->status = $data['status'];

        $crBanner->save();

        return redirect()->back()->with('status', 'Thêm Banner thành công');
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
        $banner = Banner::find($id);
        return view('admin.banner.edit')->with(compact('banner'));
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

        $crBanner = Banner::find($id);
        $crBanner->name = $data['name'];

        $get_image = $request->hinhanh;

        if ($get_image) {

            $path = 'public/uploads/banner/' . $crBanner->image;

            if (file_exists($path) && $crBanner->image != null) {
                unlink($path);
            }

            $path = 'public/uploads/banner/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $crBanner->image = $new_image;
        }

        $crBanner->status = $data['status'];
        $crBanner->save();

        return redirect()->back()->with('status', 'Cập nhật banner thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $path = 'public/uploads/cate/' . $banner->image;
        if (file_exists($path)) {
            unset($path);
        }
        Banner::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa banner thành công!');
    }
}
