<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
class GeneratePDF extends Controller
{
    public function index() 
    {
        return view('pdf-view');
    }
    function htmlToPDF(){
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pdf-view'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}