<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{

    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        $dataInicio = date("Y-m-d H:i:s", strtotime(substr($data, 0, 10)." 00:00:01"));
        $dataFim = date("Y-m-d H:i:s", strtotime(substr($data, 10, 10)." 23:59:59"));

        $relatorio = DB::table('requerimento_pericias')
                            ->where('data_agenda','>=',$dataInicio)
                            ->where('data_agenda','<=',$dataFim)
                                ->orderBy('created_at','asc')
                                        ->orderBy('status','asc')
                                            ->get();
        
        return view('exports.invoices',compact('relatorio'));
    }
}