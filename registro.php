<?php include('funcoes.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL - Create user</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
			background: #003366;
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - create user</h2>
	</div>
	
	<form method="POST" action="registro.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Usuario</label>
			<input type="text" name="usuario" value="<?php echo $usuario; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>user ou administrador?</label>
			<input type="text" name="tipo_usuario" value="">
		</div>
		<div class="input-group">
			<label>Senha</label>
			<input type="password" name="senha_1">
		</div>
		<div class="input-group">
			<label>Confirme a senha</label>
			<input type="password" name="senha_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn"> + Create user</button>
		</div>
	</form>
</body>
</html>