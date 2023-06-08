<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function dashboardCuisine()
    // {
    //     $productsData = Cuisine::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->get();

    //     // Step 2: Format the data
    //     $formattedData = [];
    //     foreach ($productsData as $data) {
    //         $formattedData[$data->month] = $data->count;
    //     }

    //     // Return the formatted data as a response (optional)
    //     return response()->json($formattedData);
    // }

    public function index()
    {
        $userCount = User::count();
        $cateCount = Category::count();
        $cuisineCount = Cuisine::count();
        $postCount = Post::count();

        // Lấy số lượng cuisine theo tháng
        $cuisines = DB::table('cuisine')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Lấy số lượng cuisine theo tháng
        $users = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return view('admin.dashboard', compact('userCount', 'cateCount', 'cuisineCount', 'postCount', 'cuisines', 'users'));
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
