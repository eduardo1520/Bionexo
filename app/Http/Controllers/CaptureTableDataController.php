<?php

namespace App\Http\Controllers;

use App\Repositories\StudentRepository;
use DOMDocument;
use DOMXPath;

const URL = 'https://testpages.herokuapp.com/styled/tag/table.html';
const FORM_TABLE = 'https://testpages.herokuapp.com/styled/basic-html-form-test.html';
class CaptureTableDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentRepository $repository)
    {
        $tables = $repository->findAll();
        return response()->json($tables);
    }

    public function getTableData(StudentRepository $repository)
    {
        $students = $repository->findAll();

        foreach ($students as $student) {
            $repository->delete($student->id);
        }

        $dom = new DOMDocument();

        $dom->loadHTMLFile(URL);
        $dom->preserveWhiteSpace = false;
        $tables = $dom->getElementsByTagName('table');
        $rows = $tables->item(0)->getElementsByTagName('tr');
        $cols = $rows->item(0)->getElementsByTagName('th');
        $row_headers = NULL;

        $row_headers = NULL;

        foreach ($cols as $node) {
            $row_headers[] = $node->nodeValue;
        }

        $table = array();
        $rows = $tables->item(0)->getElementsByTagName('tr');

        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');
            $row = array();
            $i=0;
            foreach ($cols as $node) {
                if($row_headers === NULL) {
                    $row[] = $node->nodeValue;
                }
                else {
                    $row[strtolower($row_headers[$i])] = $node->nodeValue;
                }
                $i++;
            }

            $table[] = $row;
        }

        $table = array_filter($table);

        $repository->save($table);

        $students = $repository->findAll();

        return response()->json($students);
    }

    public function addDataTable()
    {
        $dom = new DOMDocument();

        $dom->loadHTMLFile(FORM_TABLE);
        $dom->preserveWhiteSpace = false;

        $xpath = new DOMXPath($dom);
        $username = $xpath->query('//input[@name="username"]');
        $username->item(0)->setAttribute('value', 'teste');

        $password = $xpath->query('//input[@name="password"]');
        $password->item(0)->setAttribute('value', 'teste');

        $textarea = $xpath->query('.//textarea[@name="comments"]');
        $textarea[0]->nodeValue = 'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.';

        $filename = $xpath->query('//input[@type="file"]');
        $filename->item(0)->setAttribute('value', 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fcdn.w600.comps.canstockphoto.com.br%2Fgratis-stamp-imagem_csp15358675.jpg&tbnid=k2S_Bcw_Ggz7UM&vet=12ahUKEwilpaC62MuAAxWGvJUCHV8nDgMQMygaegUIARCIAg..i&imgrefurl=https%3A%2F%2Fwww.canstockphoto.com.br%2Ffoto-imagens%2Fgratis.html&docid=hA3FdzMYmNrruM&w=600&h=483&q=imagem%20gratis&ved=2ahUKEwilpaC62MuAAxWGvJUCHV8nDgMQMygaegUIARCIAg');

        $dom->normalize();

        echo $dom->saveHTML();
    }


}
