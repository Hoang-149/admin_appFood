<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $favourites = Favourite::where('id_user', $id)->get();
        return response()->json([
            'status' => 200,
            'favourites' => $favourites,
        ]);
    }

    public function storeFavourite(Request $request)
    {
        // if (auth('sanctum')->check()) {
        //     $id_user = auth('sanctum')->user()->id;
        $comment = new Favourite();
        $comment->name_favourite =  $request->input('name');
        $comment->id_user =  $request->input('id_user');
        $comment->id_cuisine = $request->input('id_cuisine');

        $comment->save();
        return response()->json([
            'status' => 200,
            'message' => 'Đánh Giá Thành Công',
        ]);
        // } else {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'Vui Lòng Đăng Nhập Để Bình Luận',
        //     ]);
        // }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favourites = Favourite::where('name_favourite', $id)->get();

        return response()->json([
            'status' => 200,
            'favourites' => $favourites,
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
        Favourite::find($id)->delete();
        return response()->json([
            'status' => 404,
            'message' => 'Bỏ Yêu Thích Thành Công',
        ]);
    }
}
