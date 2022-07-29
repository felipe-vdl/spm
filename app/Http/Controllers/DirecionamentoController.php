<?php

namespace App\Http\Controllers;

use App\Models\Direcionamento;
use Illuminate\Http\Request;
use DB;

class DirecionamentoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $direcionamentos = Direcionamento::all();

      return view('direcionamento/index', compact('direcionamentos'));
  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $direcionamento = Direcionamento::findOrFail($id);
    $config = json_decode($direcionamento->config);

    return view('direcionamento/edit', compact('direcionamento', 'config'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $direcionamento = Direcionamento::find($id);
    $data = $request->all();

    $dom = (object) [
      'dia' => "Domingo",
      'index' => 0,
      'isOn' => intval($data["dom"]["isOn"]),
      'inicio' => (is_null($data["dom"]["inicio"]) ? "" : $data["dom"]["inicio"]),
      'fim' => (is_null($data["dom"]["fim"]) ? "" : $data["dom"]["fim"])
    ];

    $seg = (object) [
      'dia' => "Segunda",
      'index' => 1,
      'isOn' => intval($data["seg"]["isOn"]),
      'inicio' => (is_null($data["seg"]["inicio"]) ? "" : $data["seg"]["inicio"]),
      'fim' => (is_null($data["seg"]["fim"]) ? "" : $data["seg"]["fim"])
    ];

    $ter = (object) [
      'dia' => "Terça",
      'index' => 2,
      'isOn' => intval($data["ter"]["isOn"]),
      'inicio' => (is_null($data["ter"]["inicio"]) ? "" : $data["ter"]["inicio"]),
      'fim' => (is_null($data["ter"]["fim"]) ? "" : $data["ter"]["fim"])
    ];

    $qua = (object) [
      'dia' => "Quarta",
      'index' => 3,
      'isOn' => intval($data["qua"]["isOn"]),
      'inicio' => (is_null($data["qua"]["inicio"]) ? "" : $data["qua"]["inicio"]),
      'fim' => (is_null($data["qua"]["fim"]) ? "" : $data["qua"]["fim"])
    ];

    $qui = (object) [
      'dia' => "Quinta",
      'index' => 4,
      'isOn' => intval($data["qui"]["isOn"]),
      'inicio' => (is_null($data["qui"]["inicio"]) ? "" : $data["qui"]["inicio"]),
      'fim' => (is_null($data["qui"]["fim"]) ? "" : $data["qui"]["fim"])
    ];

    $sex = (object) [
      'dia' => "Sexta",
      'index' => 5,
      'isOn' => intval($data["sex"]["isOn"]),
      'inicio' => (is_null($data["sex"]["inicio"]) ? "" : $data["sex"]["inicio"]),
      'fim' => (is_null($data["sex"]["fim"]) ? "" : $data["sex"]["fim"])
    ];

    $sab = (object) [
      'dia' => "Sábado",
      'index' => 6,
      'isOn' => intval($data["sab"]["isOn"]),
      'inicio' => (is_null($data["sab"]["inicio"]) ? "" : $data["sab"]["inicio"]),
      'fim' => (is_null($data["sab"]["fim"]) ? "" : $data["sab"]["fim"])
    ];

    $config = json_encode(array(
      $dom, $seg, $ter, $qua, $qui, $sex, $sab
    ));

    $direcionamento->config = $config;
    $direcionamento->save();
    
    return redirect('/direcionamentos')->with('success', 'Configuração aplicada com sucesso.');
  }
}
