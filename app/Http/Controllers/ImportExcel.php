<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ImportExcel extends Controller
{
    public function index(){
        // $result = exec('python /scripts/testpython.py');
        $result = 'Hola mundo';
        return view('cursos.layouts.testExcelview');
    }

    public function store(Request $request)
    {
        $variable = $request->input('variable');

        $process = new Process(['python', base_path('public/scripts/testpython.py'), $variable]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $response = $process->getOutput();
        return $response;
    }
}
