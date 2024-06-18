<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $mpdf = new \Mpdf\Mpdf();


        $cart = session('cart');
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        // $pdf = PDF::loadView('pdf.pembayaran', compact('cart', 'total'));

        // return $pdf->download('pembayaran.pdf');

        $mpdf->WriteHTML(view("pdf.pembayaran", compact('cart', 'total')));
        $mpdf->Output();
    }
}
