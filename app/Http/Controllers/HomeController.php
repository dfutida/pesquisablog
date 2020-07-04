<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    public function index() {
        return view("home.index");
    }

    public function login(Request $request) {
        $this->validate($request, [
            'usuario' => 'required',
            'senha' => 'required',
        ]);

        $credentials = ['usuario'=>$request->usuario, 'password'=>$request->senha];

        if(Auth::attempt($credentials)) {
            return redirect()->intended('painel');
        } else {
            return redirect()->back()->with('msg', 'acesso negado para essas credenciais');
        }
    }

    public function painel() {
        return view('auth.painel');
    }

    public function lista() {
        return view('auth.lista');
    }
    
    public function delete($id) {
        $delete = DB::table('artigos')->where('id', $id)->delete();
        return view('auth.lista');
    }
}
