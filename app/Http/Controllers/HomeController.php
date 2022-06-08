<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RequerimentoPericia;
use App\Models\User;


class HomeController extends Controller
{
 	
	public function index()
	{
		$total			  	= RequerimentoPericia::all()->count();
		
		$analise		  	= RequerimentoPericia::where('status', '==', 0)->orWhere('status', 5)->get()->count();

		$confirmacao		= RequerimentoPericia::all()->where('status', '==', 3)->count();
		$totalreq			  = $analise + $confirmacao;

		$recusados			= RequerimentoPericia::all()->where('status', '==', 1)->count();
		$finalizados		= RequerimentoPericia::all()->where('status', '==', 4)->count();
		$totalarq			  = $recusados + $finalizados;

		return view('requerimento_pericia/home', compact('total', 'totalreq', 'analise', 'confirmacao', 'recusados', 'finalizados', 'totalarq'));
	}

	public function embreve($rotina)
	{
		return view ('embreve');
	}

}
