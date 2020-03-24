<?php
	/*testes para saber  se estamos recebendo os dados do form via get/post	
		print_r($_GET);
		echo '<br />';
		echo $_GET['email'];
		echo '<br />';
		echo $_GET['senha'];
		
		print_r($_POST);
		echo '<br />';
		echo $_POST['email'];
		echo '<br />';
		echo $_POST['senha']; 		*/
		
	session_start();//inicia o controle de acesso com a chamada do $_SESSION

	//variaveis de autenticacao
		$usuario_autenticado = false; 
		$usuario_id = null; 
		$usuario_perfil_id = null;
		$perfis = array(1 => 'Administrativo', 2 => 'Usuário');

	//usuarios do sistema
		$usuarios_app = array(
			array('id' => 1, 'email' => 'adm@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
			array('id' => 2, 'email' => 'user@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
			array('id' => 3, 'email' => 'jose@teste.com.br', 'senha' => '1234', 'perfil_id' => 2),
			array('id' => 4, 'email' => 'maria@teste.com.br', 'senha' => '1234', 'perfil_id' => 2),
		);
		/*teste para usuarios do sistema
		echo '<pre>';
			print_r($usuarios_app);
		echo '</pre>';		*/

	//foreach captura valores da chave no array $usuarios_app[]
		foreach($usuarios_app as $user) {
			//print_r($user);
			//se login e senha forem iguais aos do formulario
			if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
				$usuario_autenticado = true; //usuario_autenticado recebe true
				$usuario_id = $user['id'];	//usuario recebe id
				$usuario_perfil_id = $user['perfil_id']; //usuario recebe perfil
			}
		}

	//condicional que libera acesso as paginas protegidas pelo $_SESSION	
		if($usuario_autenticado) { //se o usuario_autenticado receber true
			echo 'Usuário autenticado';	//informe usuario autenticado
			$_SESSION['autenticado'] = 'SIM';	//sessão recebe sim
			$_SESSION['id'] = $usuario_id;	//sessão recebe id
			$_SESSION['perfil_id'] = $usuario_perfil_id; //sessão recebe perfil
			header('Location: home.php');	//direciona para home
		} else { //se o usuario_autenticado receber false
			$_SESSION['autenticado'] = 'NAO';  //sessão recebe nao
			header('Location: index.php?login=erro'); //direciona para index com erro
		}
	
?>