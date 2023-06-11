<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuisine;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function exportPDF()
    {
        $options = new Options();
        $options->set('defaultFont', public_path('fonts/Roboto-ThinItalic.ttf'));

        $usersWithCuisineCount = User::leftJoin('cuisine', 'users.id', '=', 'cuisine.user_id')
            ->select('users.id', 'users.name', DB::raw('COUNT(cuisine.id) as cuisine_count'))
            ->groupBy('users.id', 'users.name')
            ->get();

        $posts = User::all(); // Lấy dữ liệu từ model User (đảm bảo bạn đã import Model User vào controller)
        $dompdf = new Dompdf($options);
        $html = view('admin.export-pdf', compact('posts', 'usersWithCuisineCount'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', ['Attachment' => false]);
    }

    public function exportCuisinePDF()
    {
        $options = new Options();
        $options->set('defaultFont', public_path('fonts/Roboto-ThinItalic.ttf'));

        // $usersWithCuisineCount = User::leftJoin('cuisine', 'users.id', '=', 'cuisine.user_id')
        //     ->select('users.id', 'users.name', DB::raw('COUNT(cuisine.id) as cuisine_count'))
        //     ->groupBy('users.id', 'users.name')
        //     ->get();

        $cuisines = Cuisine::all(); // Lấy dữ liệu từ model User (đảm bảo bạn đã import Model User vào controller)
        $dompdf = new Dompdf($options);
        $html = view('admin.export-cuisine-pdf', compact('cuisines'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', ['Attachment' => false]);
    }
}
