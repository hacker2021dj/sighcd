<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div>
        <b>INICIO DE SESIÓN</b>
    </div>
    <form action="{{route('login')}}" method="post">
        @csrf
        <label>Usuario: </label><br>
        <input type="text" name="usuario" value="{{old('usuario', 'admin')}}" placeholder="ingrese su usuario" required><br>
        <label>Contraseña: </label><br>
        <input type="password" name="password" value="admin" placeholder="ingrese su contraseña" required><br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
