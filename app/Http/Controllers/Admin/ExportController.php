<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportPDF()
    {
        $options = new Options();
        $options->set('defaultFont', public_path('fonts/Roboto-ThinItalic.ttf'));
        $posts = User::where('status', 0)->get(); // Lấy dữ liệu từ model User (đảm bảo bạn đã import Model User vào controller)
        $dompdf = new Dompdf($options);
        $html = view('admin.export-pdf', compact('posts'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', ['Attachment' => false]);
    }
}
