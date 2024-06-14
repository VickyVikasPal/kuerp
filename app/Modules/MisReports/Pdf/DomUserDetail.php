<?php
namespace App\Modules\Products\Pdf;

use Dompdf;

class DomProductDetail
{
    public function index()
    {
        $dompdf = new Dompdf();
        $html = '<html><body><h1>Hello, world!</h1></body></html>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('document.pdf', ['Attachment' => false, 'compress' => 0, 'print' => true]);
    }

    public function getPdf()
    {
        $dompdf = new Dompdf();
        $html = '<html><body><h1>Hello, world!</h1></body></html>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('document.pdf', ['Attachment' => false, 'compress' => 0, 'print' => true]);
    }
}
