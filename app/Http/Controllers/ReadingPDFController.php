<?php

namespace App\Http\Controllers;

use Smalot\PdfParser\Parser;

class ReadingPDFController extends Controller
{
    public function readingPDF()
    {
        
        $config = new \Smalot\PdfParser\Config();
        $config->setRetainImageContent(false);
        $config->setDecodeMemoryLimit(1000000);
        $parser = new Parser([], $config);
        $pdf = $parser->parseFile('Leitura.pdf');
       
        $report = [];

        $pages = $pdf->getPages()[0];
        $report['registro_ans'] = $pages->getDataTm()[24][1];
        $report['nome_operadora'] = $pages->getDataTm()[26][1];
        $report['codigo_operadora'] = $pages->getDataTm()[9][1];
        $report['nome_contratado'] = $pages->getDataTm()[11][1];
        $report['numero_lote'] = $pages->getDataTm()[14][1];
        $report['numero_protocolo'] = $pages->getDataTm()[16][1];
        $report['data_protocolo'] = $pages->getDataTm()[18][1];
        $report['codigo_glosa_protocolo'] = '';
        $report['valor_informado_protocolo'] = $pages->getDataTm()[55][1];
        $report['valor_processado_protocolo'] = $pages->getDataTm()[57][1];
        $report['valor_liberado_protocolo'] = $pages->getDataTm()[58][1];
        $report['valor_glosa_protocolo'] = $pages->getDataTm()[59][1];
        $report['valor_informado_geral'] = $pages->getDataTm()[66][1];
        $report['valor_processado_geral'] = $pages->getDataTm()[67][1];
        $report['valor_liberado_geral'] = $pages->getDataTm()[68][1];
        $report['valor_glosa_geral'] = $pages->getDataTm()[68][1];
        $pages = $pdf->getPages()[2];
        $report['numero_guia_prestador'] = $pages->getDataTm()[12][1];
        $report['numero_guia_atribuido_operadora'] = $pages->getDataTm()[14][1];
        $report['senha'] = '';
        $report['nome_beneficiario'] = $pages->getDataTm()[16][1];
        $report['numero_carteira'] = $pages->getDataTm()[18][1];
        $report['data_inicio_faturamento'] = $pages->getDataTm()[20][1];
        $report['hora_inicio_faturamento'] = $pages->getDataTm()[24][1];
        $report['data_fim_faturamento'] = $pages->getDataTm()[22][1];
        $report['codigo_glosa_guia'] = '';
        $report['data_realizacao'] = $pages->getDataTm()[29][1];
        $report['tabela'] = $pages->getDataTm()[30][1];
        $report['codigo_procedimento'] = $pages->getDataTm()[31][1];
        $report['descricao'] = $pages->getDataTm()[32][1];
        $report['grau_participacao'] = '';
        $report['valor_informado'] = $pages->getDataTm()[34][1];
        $report['qtde_executada'] = $pages->getDataTm()[35][1];
        $report['valor_processado'] = $pages->getDataTm()[36][1];
        $report['valor_liberado'] = $pages->getDataTm()[37][1];
        $report['valor_glosa'] = $pages->getDataTm()[38][1];
        $report['codigo_glosa'] = $pages->getDataTm()[65][1];
        $report['valor_informado_guia'] = $pages->getDataTm()[56][1];
        $report['valor_processado_guia'] = $pages->getDataTm()[63][1];
        $report['valor_liberado_guia'] = $pages->getDataTm()[57][1];
        $report['valor_glosa_guia'] = $pages->getDataTm()[58][1];

        $headers[] = array_keys($report);
        $body[] = array_values($report);

        $fp = fopen('leitura.csv', 'w');

        foreach ($headers as $fields) {
            fputcsv($fp, $fields);
        } 
        
        foreach ($body as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);

        echo "Relatorio gerado com sucesso!";
    }
}
