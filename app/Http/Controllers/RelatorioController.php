<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\RelatorioExport;
use App\Http\Controllers\InvoicesExportController;
use PDF;
use Excel;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('relatorio.index');
    }

    public function gerarpdf($data)
    {
        
        $i = 1;
        $dataIntervalo = str_replace('-', '/', $data);
        $dataI = substr($dataIntervalo, 0, 10);
        $dataF = substr($dataIntervalo, 10, 10);
        if ($dataI == $dataF) {
            $dataInt = $dataI;
        } else {
            $dataInt = $dataI." — ".$dataF;
        }
        
        $dataInicio = date("Y-m-d H:i:s", strtotime(substr($data, 0, 10)." 00:00:01"));
        $dataFim = date("Y-m-d H:i:s", strtotime(substr($data, 10, 10)." 23:59:59"));
        /* dd($dataInicio, $dataFim, $dataInt); */



        $relatorio = DB::table('requerimento_pericias')
                                ->where('data_agenda','>=',$dataInicio)
                                ->where('data_agenda','<=',$dataFim)
                                // ->whereIn('status',[3,4])
                                ->where('status','=',4)
                                
                                    ->orderBy('data_agenda','asc')
                                            ->orderBy('created_at','asc')
                                                ->get();

        // dd($relatorio);

        $pdf = PDF::loadView('relatorio.pdf', compact('relatorio','i','dataInt'));

		return $pdf->stream('Lista de Requerimentos');
    }

    public function exportDocsFile($data)
    {
        $dataIntervalo = str_replace('-', '', $data);
        $dataI = substr($dataIntervalo, 0, 8);
        $dataF = substr($dataIntervalo, 8, 8);
        $dataInt = $dataI."-".$dataF;

        $filename = 'requerimentos-'.$dataInt.'.xlsx';

        return Excel::download(new InvoicesExportController($data), $filename);
    }
}
