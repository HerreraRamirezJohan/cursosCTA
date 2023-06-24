<!DOCTYPE html>
<html>
<head>
    <title>Import Excel</title>
</head>
<body>
    <form action="{{ route('process.api') }}" method="post">
        @csrf
        <label for="variable">Variable:</label>
        <input type="text" name="variable">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>