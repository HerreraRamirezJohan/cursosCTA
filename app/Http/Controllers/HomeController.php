<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use function PHPUnit\Framework\returnSelf;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    
    public function update(User $user, Request $request){
        // dd($request);
        $user->where('id', $user->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return back()->with('modificado', '¡El usuario fue modificado con exito!');
    }

    public function restartPassword(User $user, Request $request){

        // dd($request);
        // $validate = $this->validarContrasena($request->newPassword);
        // if ($validate)
        //     return back()->withInput()->with('ivalidpass', $validate);
        if($request->newPassword !== $request->confirmPassword)
            return back()->withInput()->with('coincide', 'Las contraseñas no coinciden');

        $consult = $user->select('id')
        ->where('password',  Hash::make($request->oldPassword))
        ->get();
        dd(Hash::make($request->oldPassword));


        // 'password' => Hash::make($data['password']),
    }
    private function validarContrasena($contrasena) {
        $answer = '';
        // Longitud mínima de 8 caracteres
        if (strlen($contrasena) < 8) {
            $answer .= 'Debe tener al menos 8 caracteres. -- ';
        }
    
        // Al menos 1 número
        if (!preg_match('/[0-9]/', $contrasena)) {
            $answer .= 'Debe tener al menos un número. -- ';
        }
    
        // Al menos 1 letra mayúscula
        if (!preg_match('/[A-Z]/', $contrasena)) {
            $answer .= 'Debe tener mayúscula. -- ';
        }
    
        // Al menos 1 símbolo
        if (!preg_match('/[\W_]/', $contrasena)) {
            $answer .= 'Debe tener algún carácter especial -- ';
        }
    
        // La contraseña cumple con todos los criterios
        return $answer;
    }

}
