<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class UserController extends Controller

{
	
	public function index()
	{
		
		$usuarios  = User::all();
		return view('user.index', compact('usuarios'));
	}
	
	public function AlteraSenha()
	{
		$usuario = Auth::user();
	
		return view('auth.altera_senha',compact('usuario'));    

		
	}

	public function SalvarSenha(Request $request)
	{
		// Validar
		$this->validate($request, [
			'password_atual'        => 'required',
			'password'              => 'required|min:6|confirmed',
			'password_confirmation' => 'required|min:6'
		]);

		// Obter o usuário
		$usuario = User::find(Auth::user()->id);

		if (Hash::check($request->password_atual, $usuario->password))
		{

			$usuario->update(['password' => bcrypt($request->password)]);            

			Auth::login($usuario);
			return back()->with('sucesso','Senha alterada com sucesso.');
		}else{
			return back()->withErrors('Senha atual não confere.');
		}

	}

	public function create()
	{
		return view('user.create');
	}

	public function store(Request $request)
	{
			$user = new User;
		  
			$user->name 		= $request->name;
      		$user->email 		= $request->email;
			$user->nivel 		= $request->nivel;
			$senha          	= 'pmm12345';
			// $senha_gerada  = str_random(6);
			$user->password =  bcrypt($senha);
			
			$user->save();
			
			// Mail::to($request->email)->send(new EnviaSenha($user, $senha_gerada));


        return redirect()->to('user');
	}

	public function edit($id)
	{
		$usuario = User::find($id);

		return view('user.edit',compact('usuario'));
	}

	public function update(Request $request, $id)
	{
		$usuario = User::find($id);

		$usuario->name 	= $request->name;
      $usuario->email 	= $request->email;
      $usuario->nivel 	= $request->nivel;

		$usuario->fill($request->all());
		$usuario->save();

		return redirect(url('/user'));

	}
}