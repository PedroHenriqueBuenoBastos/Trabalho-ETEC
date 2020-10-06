<?php
session_start();

// Conex�o com Banco de Dados 
$bancodedados = mysqli_connect('152.249.142.8:3306', 'Pedro', 'Pedrohenrique#10', 'etec');
	// Mensagem de erro com banco de dados
	if (!$bancodedados) {
		printf("Can't connect to localhost. Error: %s\n", mysqli_connect_error());
	}


// Declara��o das variaveis
$usuario ="";
$email = "";
$erro = array();

// Chamando register() fun��o, Se register_btn � usado
if (isset($_POST�['register_btn'])) {
	register();
}

// Registro do usuario 
function registro(){
	 // chama as variaveis com global key disponiveis na fun��o
	 global $bancodedados, $erro, $usuario, $email;

	 // Recebe todos os valores de imput do formulario de registro, e chama a fun��o e()

	 $usuario = e($_POST['usuario']);
	 $email   = e($_POST['email']);
	 $nomecom = e($_POST['nomecom']);

	 $senha_1 = e($_POST['senha_1']);
	 $senha_2 = e($_POST['senha_2']);

	 // Valida��o de formul�rio: Prosseguir� se o formul�rio estiver correto
	 if (empty($usuario)) {
		  array_push($erro, "Usu�rio � necess�rio");
	 }
	 if (empty($email)) {
		  array_push($erro, "Email � necess�rio");
	 }
	 if (empty($nomecom)) {
		  array_push($erro, "Nome completo � necess�rio");
	 }
	 if (empty($senha_1)) {
		  array_push($erro, "Senha � necess�ria");
	 }
	 if ($senha_1 != $senha_2) {
		  array_push($erro, "As duas senhas n�o coincidem");
	 }
	 
	 // Registro de usuario se n�o h� erros no formul�rio
	 if (count($errors) ==0) {
		  $senha = md5($senha_1); //Criptografar a senha MD5 ap�s registro

		  if (isset($_POST['tipo_usuario'])) {
				$tipo_usuario = e($_POST['tipo_usuario']);
				$query = "INSERT INTO usuarios (usuario, email, nomecom, tipo_usuario, senha)
					VALUES('$usuario', '$email', '$nomecom''$tipo_usuario', '$senha')";
			mysqli_query($bancodedados, $query);
			$_SESSION['sucesso'] ="Novo usu�rio foi criado com sucesso!!";
			header('location: home.php');
		  }else{
				$query ="INSERT INTO usuarios (usuario, email, nomecom, tipo_usuario, senha)
						VALUES('$usuario', '$email', 'user', '$senha')";
				mysqli_query($bancodedados, $query);

				// Pegar id da cria��o de usu�rio
				$logado_no_id_usuario = mysqli_insert_id($bancodedados);

				$_SESSION['user'] = getUserById($logado_no_id_usuario); // coloca voc� logado na sess�o
				$_SESSION['sucesso'] = "Voc� agora est� logado!";
				header('location: entrar.php');
		  }
	 }	 
 }

  // Retorna array do usuario pelo id
  function getUserById($id){
		global $bancodedados;
		$query = "SELECT * FROM usuarios WHERE id=" . $id;
		$result = mysqli_query($bancodedados, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
  }

  // Escape String
  function e($val){
		global $bancodedados;
		return mysqli_real_escape_string($bancodedados, trim($val));
  }

  function display_error() {
		global $erro;

		if (count($erro) > 0){
			echo '<div class="errophp">';
			foreach ($erro as $error){
				echo $error .'<br>';
				}
			echo '</div>';
		}
  }

  function isLoggedIn()
  {
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
  }

   // Chama a fun��o login() se register_btn foi usado
   if (isset($_POST['login_btn'])) {
		  login();
   }

   // Login do ususario
   function login(){
		  global $bancodedados, $usuario, $erro;

		  // GET de formul�rio
		  $usuario = e($_POST['usuario']);
		  $senha = e($_POST['senha']);

		  // Erro de estiver vazio
		  if (empty($usuario)) {
				array_push($erro, "Usuario � necess�rio");
		  }
		  if (empty($senha)) {
				array_push($erro, "Senha � necess�ria");
		  }
		  // Atentar qual o privilegio do usuario
		  if (count($erro) == 0)  {
				$senha = md5($senha);

				$query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$senha' LIMIT 1";
				$results = mysqli_query($bancodedados, $query);

				if (mysqli_num_rows($results) == 1) { //Usuario encontrado 
					// Checar se � usuario ou administrador
					$logado_no_id_usuario = mysqli_fetch_assoc($results);
					if ($logado_no_id_usuario['tipo_usuario'] == 'administrador') {

						$_SESSION['user'] = $logado_no_id_usuario;
						$_SESSION['sucesso'] = "Voc� est� logado comno administrador";
						header('location: administracao.php');
					}else{
						$_SESSION['user'] = $logado_no_id_usuario;
						$_SESSION['sucesso'] = "Voc� est� logado !";
					
						header('location: logado.php');
					}	
				}else{
					array_push($erro, "Email ou senha incorreto");
				}
		  }
   }