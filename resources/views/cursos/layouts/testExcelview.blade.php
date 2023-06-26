<!DOCTYPE html>
<html>
<head>
    <title>Import Excel</title>
</head>
<body>
    <form method="POST" action="{{ route('process.api') }}" enctype="multipart/form-data">
        @csrf
        <label for="fileExcel ">Archivo Excel</label>
        <input type="file" name="fileExcel" id="fileExcel">
        <label for="ciclo">Ciclo del Archivo</label>
        <input type="text" name="ciclo" id="ciclo">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>