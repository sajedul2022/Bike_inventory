<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{


    public function generate_pdf()
    {
        $data = 'webjourney.dev';
        $pdf = Pdf::loadView('billing_invoice', compact('data'));
        return $pdf->stream('billing-invoice');
    }

    public function download_pdf()
    {
        $data = 'webjourney.dev';
        $pdf = Pdf::loadView('billing_invoice', compact('data'));
        return $pdf->download('billing-invoice.pdf');
    }

    // Purchase Invoice

    public function purchase_pdf()
    {
        $suppliers = Supplier::get();
        $products = Product::get();
        $purchases = purchase::latest()->first();
        // return dd( $purchases);

        $pdf = Pdf::loadView('purchase_invoice', compact('purchases', 'suppliers', 'products'));
        return $pdf->stream('billing-invoice');
    }
}
