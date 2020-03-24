<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse() {
		$this->view->erroCadastro = false;
		$this->view->usuario = array(
				'nome' => '',
				'email' => '',
				'senha' => '',
			);
		$this->render('inscreverse');
	}

	public function registrar() {
		/*recebendo form de inscreverse.phtml
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';*/

		//estanciando usuario com os dados form
		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));//md5 hash de senha 
		//Descriptografar senha: https://md5.gromweb.com/ 

		/*
		echo '<pre>';
		print_r($usuario);
		echo '</pre>';
		*/

		//sucesso
		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0){
			/*
			echo '<pre>';
			print_r($usuario->getUsuarioPorEmail());
			echo '</pre>';
			*/

			$usuario->salvar();//salvando o objeto instanciado

			$this->render('cadastro');
			
		//erro	
		} else {
			//echo 'Preencha todos os campos do formulario!!!';
			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);
			$this->view->erroCadastro = true;
			$this->render('inscreverse');
		}
	
	}	

}


?>