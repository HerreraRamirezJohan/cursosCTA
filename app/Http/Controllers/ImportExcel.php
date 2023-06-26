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
        $variable = $request->input('ciclo');
        $archivo = $request->file('fileExcel');
        // Mueve el archivo a una ubicación temporal
        $rutaArchivo = $archivo->store('temp');
    
        // Ruta completa del archivo
        $rutaCompletaArchivo = storage_path('app/' . $rutaArchivo);
    
        // Ejecuta el script de Python
        $process = new Process(['python', base_path('app/scripts/testpython.py'), $rutaCompletaArchivo, $variable]);
        $process->run();
    
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    
        $response = $process->getOutput();
        return $response;
    }
}
