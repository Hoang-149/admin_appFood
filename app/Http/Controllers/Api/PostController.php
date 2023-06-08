<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::where('status', '1')->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 200,
            'post' => $post,
        ]);
    }

    public function postOfUser($id)
    {
        $postOfUser = Post::where('id_user', $id)->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 200,
            'post' => $postOfUser,
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
        $crPost = new Post();

        $crPost->name = $request->input('name');
        $crPost->title = $request->input('title');
        $crPost->id_user = $request->input('id_user');
        $crPost->id_cuisine = $request->input('id_cuisine');
        $crPost->status = $request->input('status') == true ? '1' : '0';


        $crPost->save();
        return response()->json([
            'status' => 200,
            'message' => 'Chia Sẻ Thành Công',
        ]);
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
        $crCuisine = Post::find($id);

        // if ($crCuisine->status == 0) {
        $crCuisine->title = $request->input('title');

        $crCuisine->update();

        return response()->json([
            'status' => 200,
            'message' => 'Cập Nhật Bài Chia Sẻ Thành Công',
        ]);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'Không Thể Cập Nhật Bài Chia Sẻ Này',
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
        $post = Post::find($id);

        // if ($post->status == 0) {

        Post::find($id)->delete();

        return response()->json([
            'status' => 200,
            'post' => 'Xóa Bài Chia Sẻ Thành Công',
        ]);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'post' => 'Không Thể Xóa Bài Chia Sẻ Này',
        //     ]);
        // }
    }
}
