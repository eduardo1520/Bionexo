<?php

namespace App\Http\Controllers;

use Smalot\PdfParser\Parser;
use Spatie\PdfToText\Pdf;

class ReadingPDFController extends Controller
{
    public function readingPDF()
    {
        $parser = new Parser();
        $pdf = $parser->parseFile('Leitura.pdf');

        $text = nl2br($pdf->getText());

        echo nl2br($text);
    }
}
