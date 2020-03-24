<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	public function timeline() {

		//session_start();
		$this->validaAutenticacao();	
		//if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){
			/*	
			echo 'chegamos até aqui!!!';

			echo "<pre>";
			print_r($_SESSION);
			echo "</pre>";
			*/

			//recuperar tweets
			$tweet = Container::getModel('Tweet');
			$tweet->__set('id_usuario', $_SESSION['id']);
			$tweets = $tweet->getAll();
			/*
			echo "<pre>";
			print_r($tweets);
			echo "</pre>";
			*/
			$this->view->tweets = $tweets;

			$usuario = Container::getModel('Usuario');
			$usuario->__set('id', $_SESSION['id']);
			$this->view->infoUsuario = $usuario->getInfoUsuario();
			$this->view->totalTweets = $usuario->getTotalTweets();
			$this->view->totalSeguindo = $usuario->getTotalSeguindo();
			$this->view->totalSeguidores = $usuario->getTotalSeguidores();

			$this->render('timeline');
		/*} else {
			header('location: /?login=erro');
		}*/
	}

	public function tweet(){

		//session_start();
		$this->validaAutenticacao();	
		//if($_SESSION['id'] != '' && $_SESSION['nome'] != ''){
			/*
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			*/
			$tweet = Container::getModel('tweet');
			$tweet->__set('tweet', $_POST['tweet']);
			$tweet->__set('id_usuario', $_SESSION['id']);

			$tweet->salvar();

			header('location: /timeline');
				
		/*} else {
			header('location: /?login=erro');
		}*/
	}

	public function validaAutenticacao(){

		session_start();

		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
			header('location: /?login=erro');
		}	
	}

	public function quemSeguir(){
		$this->validaAutenticacao();	
		//echo 'Estamos Aqui!';	
		//print_r($_GET);	
		$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

		//echo '<br><br><br><br>pesquisar por: '.$pesquisarPor;

		$usuarios = array();

		if($pesquisarPor != ''){

			$usuario = Container::getModel('Usuario');
			$usuario->__set('nome', $pesquisarPor);
			$usuario->__set('id', $_SESSION['id']);
			$usuarios = $usuario->getAll();
			/*
			echo "<pre>";
			//print_r($usuarios);//PESQUISA DE USUARIOS
			print_r($_SESSION);//USUARIO LOGADO
			echo "</pre>";
			*/
		}

		$this->view->usuarios = $usuarios;
		
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);
		$this->view->infoUsuario = $usuario->getInfoUsuario();
		$this->view->totalTweets = $usuario->getTotalTweets();
		$this->view->totalSeguindo = $usuario->getTotalSeguindo();
		$this->view->totalSeguidores = $usuario->getTotalSeguidores();

		$this->render('quemSeguir');

	}

	public function acao(){
		$this->validaAutenticacao();	
		//print_r($_GET); //teste de quemSeguir.phtml
		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
		$id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		if($acao == "seguir"){
			$usuario->seguirUsuario($id_usuario_seguindo);
		}else if($acao == "deixar_de_seguir"){
			$usuario->deixarSeguirUsuario($id_usuario_seguindo);
		}
		header('location: /quem_seguir');
	}

	public function remover(){
		$this->validaAutenticacao();	
		//echo 'Estamos Aqui!';
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		print_r($_GET);
		$tweet = Container::getModel('tweet');
		$tweet->__set('id', $_GET['id']);

		$tweet->removerTweet($id);

		header('location: /timeline');

	}
}

?>