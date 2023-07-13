<?php

namespace App\Http\Controllers;

use App\Models\HorariosNew;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Collection;


use App\Http\Controllers\CursosFunctions\CursosValidacion;
use App\Models\Cursos;

class ImportExcel extends Controller
{
    public function index()
    {
        $coleccion = null;
        return view('cursos.import', compact('coleccion'));

    }

    public function store(Request $request)
    {
        $messages = [
            'ciclo.required' => 'El campo ciclo es obligatorio.',
            'fileExcel.required' => 'Debe seleccionar un archivo.',
            'fileExcel.mimes' => 'El archivo debe ser de tipo XLSX o XLS.',
        ];

        $request->validate([
            'ciclo' => 'required',
            'fileExcel' => 'required|mimes:xlsx,xls',
        ], $messages);
    
        $name = 'cursos_' . $request->input('ciclo') . '.xlsx';
        $archivo = $request->file('fileExcel');
        // Mueve el archivo a una ubicación temporal
        \Storage::disk('importExcel')->put($name, \File::get($archivo));

        // Ruta completa del archivo
        $rutaCompletaArchivo = URL('storage/excelSaved/' . $name );
        // dd($rutaCompletaArchivo);
        $errors = CursosValidacion::validateCicloExcel($request, "store");
        if (!empty($errors))
            return back()->withInput()->with(['errorsHorario' => $errors]);
        // $horarioNew = new HorariosNew();
        // Con exists, devuelve un true si hay al menos un registro en la tabla
        // if (HorariosNew::exists()) {
        // $horarioNew->update(['id_curso' => null, 'status', 0]);
        // Tiempo: 36 seg
        // Artisan::call('db:seed', ['--class' => 'HorariosSeeder']);
        // Tiempo 1:17 min
        // } 
        // else {
            // Tiempo: 1:27 min
            // return view('cursos.imports.import');
            // return redirect()->back()->with('success', 'Los datos fueron importados correctamente.');
        // }
        // Ejecuta el script de Python
        $process = new Process(['python', base_path('app/scripts/testpython.py'), $rutaCompletaArchivo, $request->input('ciclo')]);
        $process->setTimeout(240);
        $process->run();

        if (!$process->isSuccessful()) {
            // session()->flash('alert', 'Ha ocurrido un error en el proceso. Verifica que el archivo sea el correcto e intenta de nuevo.');
            // return redirect()->route('indexImport');
            throw new ProcessFailedException($process);
        }
        // return redirect()->back()->with('success', 'Los datos fueron importados correctamente.');
        $response = $process->getOutput();
        
        //return(explode(",",$response));
        // $response[0] = explode(",",$response[0]);
        $importacionExcel = json_decode($response, true);
        // return $importacionExcel;
        $coleccion = new Collection($importacionExcel);
        // dd($coleccion);
        $msgSuccess = 'Los datos fueron importados correctamente.';
        return redirect()->back()->with(['coleccion' => $coleccion, 'msgSuccess' => $msgSuccess]);
    }
}