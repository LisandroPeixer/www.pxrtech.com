<?php
	//este bloco recebe o formulario de registros dos chamados e grava no arquivo.hd
	session_start();

	/*Trabalhando na montagem do texto
	quando aparecer no texto salvo,
	caracter ' | ' 
	troque por '-' 		*/
	$titulo = str_replace(' | ', '-', $_POST['titulo']);
	$categoria = str_replace(' | ', '-', $_POST['categoria']);
	$descricao = str_replace(' | ', '-', $_POST['descricao']);

	//implode('#', $_POST); (para implementar)

	$texto = $_SESSION['id'] . ' | ' . $titulo . ' | ' . $categoria . ' | ' . $descricao . PHP_EOL;


	//abrindo o arquivo 
	$arquivo = fopen('../../app_help_desk/arquivo.hd', 'a');
	//escrevendo o texto
	fwrite($arquivo, $texto);
	//fechando o arquivo
	fclose($arquivo);

	//mais detalhes em: https://www.php.net/manual/en/function.fopen.php

	//echo $texto;
	header('Location: abrir_chamado.php');
?>