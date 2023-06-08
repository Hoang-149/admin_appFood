<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {


        $usersWithCuisineCount = User::leftJoin('cuisine', 'users.id', '=', 'cuisine.user_id')
            ->select('users.id', 'users.name', DB::raw('COUNT(cuisine.id) as cuisine_count'))
            ->groupBy('users.id', 'users.name')
            ->get();


        $users = User::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.users.index', compact('users', 'usersWithCuisineCount'))->with('i', (request()->input('page', 1) - 1) * 5);

        // $users = User::all();
        // return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
                'name' => 'required|max:255',
                'image' => 'required|image|mimes:jpg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
                'email' => 'required|email|max:255|unique:users,email',
                'status' => 'required',
                'role' => 'required',
            ],
            [
                'name.required' => 'Tên người dùng phải có nhé',
                'image.required' => 'Hình ảnh phải có nhé',
                'email.required' => 'Email phải có nhé',
            ]
        );

        $createUser = new User();
        $createUser->name = $data['name'];

        $get_image = $request->image;
        $path = 'public/uploads/users/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $createUser->image = $new_image;

        $createUser->email = $data['email'];
        $createUser->password = Hash::make('password123');
        $createUser->status = $data['status'];
        $createUser->role = $data['role'];
        $createUser->save();

        return redirect()->back()->with('status', 'Thêm người dùng thành công');
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
        $user = User::find($id);
        return view('admin.users.edit')->with(compact('user'));
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
                // 'image' => 'required',
                'email' => 'required|email|max:255',
                'status' => 'required',
                'role' => 'required',
            ],
            [
                'name.required' => 'Tên người dùng phải có nhé',
                // 'image.required' => 'Hình ảnh phải có nhé',
                'email.required' => 'Email phải có nhé',
            ]
        );

        $createUser = User::find($id);
        $createUser->name = $data['name'];

        $get_image = $request->image;

        if ($get_image) {

            $path = 'public/uploads/users/' . $createUser->image;

            if (file_exists($path) && $createUser->image != null) {
                unlink($path);
            }

            $path = 'public/uploads/users/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $createUser->image = $new_image;
        }

        $createUser->email = $data['email'];
        $createUser->password = Hash::make('password123');
        $createUser->status = $data['status'];
        $createUser->role = $data['role'];
        $createUser->save();

        return redirect()->back()->with('status', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        User::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa người dùng thành công!');
    }
}
