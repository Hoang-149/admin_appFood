<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => 200,
                'user' => $user,
                'message' => 'Đăng Kí Thành Công!',
            ]);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $user = User::where('email', $request->email)->first();
            }

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => "Thông Tin Không Hợp Lệ!"
                ]);
            } else {

                return response()->json([
                    'status' => 200,
                    // 'email' => $user->email,
                    'user' => $user,
                    'message' => 'Đăng Nhập Thành Công!',
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 200,
            "message" => "Đăng Xuất Thành Công!"
        ]);
    }
    public function show($id)
    {
        $usercuisine = User::where('id', $id)->get();
        return response()->json([
            'status' => 200,
            'usercuisine' => $usercuisine,
        ]);
    }

    public function update(Request $request, $id)
    {
        $findUser = User::find($id);

        if ($findUser) {
            $findUser->name = $request->input('name');
            $findUser->email = $request->input('email');
            $findUser->phone = $request->input('phone');

            if ($request->hasFile('img')) {

                $path = $findUser->image;

                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('img');
                $extension = $file->getClientOriginalExtension();
                $filename = time() + 1 . '.' . $extension;
                $file->move('public/uploads/users/', $filename);
                $findUser->image = $filename;
            }

            $findUser->update();
            return response()->json([
                'status' => 200,
                'user' => $findUser,
                'message' => 'Cập Nhật Người dùng thành công',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Cập Nhật Người dùng không thành công',
            ]);
        }
    }
}
