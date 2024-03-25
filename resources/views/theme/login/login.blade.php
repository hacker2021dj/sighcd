<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>
    <link rel="stylesheet" href="{{asset("css/login.css")}}">

</head>
<body>
    <div class="wrapper">
		<span class="bg-animate"></span>
		<span class="bg-animate2"></span>
		<div class="form-box login">
			<h2 class="animation" style="--i:0; --j:21;">Login</h2>
			<form method="post" action="{{route('login')}}" onload="document.frmAcceso.logina.focus()">
                @csrf
				<div class="input-box animation" style="--i:1; --j:22;">
					<input type="text" name="usuario" value="{{old('usuario', 'admin')}}" placeholder="ingrese su usuario" required>
					<label>Usuario</label>
					<i class="bx bxs-user"></i>
				</div>
				<div class="input-box animation" style="--i:2; --j:23;">
					<input type="password" name="password" value="admin" placeholder="ingrese su contraseña" required>
					<label>Contraseña</label>
					<i class="bx bxs-lock-alt"></i>
				</div>
				<button id="btnIngresar" type="submit" class="btn animation" style="--i:3; --j:24;">Entrar</button>
				<div class="logreg-link animation" style="--i:4; --j:25;">
					<p>
						Olvidaste tu clave? <a href="#" class="register-link">Clic aqui</a>
					</p>
				</div>
			</form>
		</div>
		<div class="info-text login">
			<h2 class="animation" style="--i:0; --j:19;">SIGEHCD</h2>
			<p class="animation" style="--i:1; --j:20;">Sistema Integral de Gestión de Historia Clinicas Digitales</p>
		</div>

		<div class="form-box register">
			<h2 class="animation" style="--i:17; --j:0;">Recuperar Contraseña</h2>
			<form action="">
				<div class="input-box animation" style="--i:18; --j:1;">
					<input type="text" required />
					<label>Correo Electrónico</label>
					<i class="bx bxs-user"></i>
				</div>
				<div hidden class="input-box animation" style="--i:19; --j:2;">
					<input type="password" required />
					<label>Contraseña</label>
					<i class="bx bxs-lock-alt"></i>
				</div>
				<button type="submit" class="btn animation" style="--i:20; --j:3;">Cambiar</button>
				<div class="logreg-link animation" style="--i:21; --j:4;">
					<p>
						Ya tienes cuenta? <a href="#" class="login-link">Clic aqui</a>
					</p>
				</div>
			</form>
		</div>

		<div class="info-text register">
			<h2 class="animation" style="--i:17; --j:0;">SIGEHCD</h2>
			<p class="animation" style="--i:18; --j:1;">Sistema Integral de Gestión de Historia Clinicas Digitales</p>
		</div>
	</div>
    <script src="{{asset("js/login/evento.js")}}"></script>
</body>
</html>
