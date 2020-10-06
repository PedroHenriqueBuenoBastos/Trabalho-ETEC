<?php include('funcoes.php') ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form method="post" action="entrar.php" class="login100-form validate-form">
				<?php echo display_error(); ?>
					<span class="login100-form-title p-b-55">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Digite um email válido">
						<input class="input100" type="text" name="usuario" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Senha é necessária">
						<input class="input100" type="password" name="senha" placeholder="Senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="contact100-form-checkbox m-l-4">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Lembrar
						</label>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<button type="submit"  class="login100-form-btn"name="login_btn" >
							Entrar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>