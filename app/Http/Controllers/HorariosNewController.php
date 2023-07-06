<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;

class HorariosNewController extends Controller
{
    
    public function store(Request $request){

        
    }
    public function importSeeder()
    {
        // Tiempo: 52 seg.
        Artisan::call('db:seed', ['--class' => 'HorariosSeeder']);
        // return view('cursos.imports.import');

        return redirect()->back()->with('success', 'Los datos fueron importados correctamente.');
    }

}
