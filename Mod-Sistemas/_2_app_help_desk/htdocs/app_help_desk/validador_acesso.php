<?php //recebe a logica de validação para acesso ao conteudo protegido

  session_start();//inicia o controle de acesso com a chamada do $_SESSION

  if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
    header('Location: index.php?login=erro2');
  }

?>