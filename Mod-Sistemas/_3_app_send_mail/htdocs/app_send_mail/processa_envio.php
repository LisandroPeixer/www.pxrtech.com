<?php
	//print_r($_POST);//teste para recebimento de mensagem
	
	//chamada das bibliotecas 
	require "../../app_send_mail/bibliotecas/PHPMailer/Exception.php";
	require "../../app_send_mail/bibliotecas/PHPMailer/OAuth.php";
	require "../../app_send_mail/bibliotecas/PHPMailer/PHPMailer.php";
	require "../../app_send_mail/bibliotecas/PHPMailer/POP3.php";
	require "../../app_send_mail/bibliotecas/PHPMailer/SMTP.php";

	require "../../app_send_mail/processa_envio.php"; //chamada de arquivo com os codigos de acesso
	