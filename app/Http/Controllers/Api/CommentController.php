<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\ReplyComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $comments = Comment::where('id_cuisine', $id)->orderBy('id', 'asc')->get();
        return response()->json([
            'status' => 200,
            'comments' => $comments,
        ]);
    }

    public function store(Request $request)
    {
        // if (auth('sanctum')->check()) {
        //     $id_user = auth('sanctum')->user()->id;
        $comment = new Comment();
        $comment->id_user =  $request->input('id_user');
        $comment->id_cuisine = $request->input('id_cuisine');
        $comment->content = $request->input('content');

        $comment->save();
        return response()->json([
            'status' => 200,
            'message' => 'Bình luận Thành Công',
        ]);
        // } else {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'Vui Lòng Đăng Nhập Để Bình Luận',
        //     ]);
        // }
    }

    public function replayComment(Request $request)
    {
        // if (auth('sanctum')->check()) {
        //     $id_user = auth('sanctum')->user()->id;
        $comment = new ReplyComment();
        $comment->id_user =  $request->input('id_user');
        $comment->id_comment = $request->input('id_comment');
        $comment->content = $request->input('content');

        $comment->save();
        return response()->json([
            'status' => 200,
            'message' => 'Bình luận Thành Công',
        ]);
        // } else {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'Vui Lòng Đăng Nhập Để Bình Luận',
        //     ]);
        // }
    }


    public function update(Request $request, $id)
    {
        $findComment = Comment::find($id);

        if ($findComment) {
            $findComment->content = $request->input('content');

            $findComment->update();

            return response()->json([
                'status' => 200,
                'message' => 'Cập Nhật Bình luận thành công',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Cập Nhật Bình luận không thành công',
            ]);
        }
    }

    public function updateReply(Request $request, $id)
    {
        $findComment = Comment::find($id);

        if ($findComment) {
            $findComment->content = $request->input('content');

            $findComment->update();

            return response()->json([
                'status' => 200,
                'message' => 'Cập Nhật Bình luận thành công',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Cập Nhật Bình luận không thành công',
            ]);
        }
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();
        return response()->json([
            'status' => 404,
            'message' => 'Xóa Bình Luận Thành Công',
        ]);
    }

    // Post
    public function indexPost($id)
    {
        $comments = Comment::where('id_post', $id)->orderBy('id', 'asc')->get();
        return response()->json([
            'status' => 200,
            'comments' => $comments,
        ]);
    }

    public function storePost(Request $request)
    {
        // if (auth('sanctum')->check()) {
        //     $id_user = auth('sanctum')->user()->id;
        $comment = new Comment();
        $comment->id_user =  $request->input('id_user');
        $comment->id_post = $request->input('id_post');
        $comment->content = $request->input('content');

        $comment->save();
        return response()->json([
            'status' => 200,
            'message' => 'Bình luận Thành Công',
        ]);
        // } else {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'Vui Lòng Đăng Nhập Để Bình Luận',
        //     ]);
        // }
    }

    public function destroyReply($id)
    {
        ReplyComment::find($id)->delete();
        return response()->json([
            'status' => 404,
            'message' => 'Xóa Bình Luận Thành Công',
        ]);
    }
}
