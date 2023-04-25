<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;

class CursosController extends Controller
{

    public function index()
    {
        $cursos = Cursos::all();

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
