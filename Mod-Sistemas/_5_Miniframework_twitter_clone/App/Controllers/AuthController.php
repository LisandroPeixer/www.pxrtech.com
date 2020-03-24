<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	public function autenticar() {
		/*
		echo 'chegamos até aqui!!!';

		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		*/

		$usuario = Container::getModel('usuario');

		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));//md5 hash de senha
		//Descriptografar senha: https://md5.gromweb.com/ 

		/*
		echo "<pre>";
		print_r($usuario);
		echo "</pre>";
		*/
		$retorno = $usuario->autenticar();
		/*
		echo "<pre>";
		//print_r($retorno);
		print_r($usuario);
		echo "</pre>";
		*/
		if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){
			//echo 'Autenticado!!!';

			session_start();

			$_SESSION['id'] = $usuario->__get('id');
			$_SESSION['nome'] = $usuario->__get('nome');

			header('location: /timeline');

		} else {
			//echo 'Falha de autenticação!!!';
			header('location: /?login=erro');
		}
	}

	public function sair(){
		session_start();
		session_destroy();
		header('location: /');
	}
}

?>