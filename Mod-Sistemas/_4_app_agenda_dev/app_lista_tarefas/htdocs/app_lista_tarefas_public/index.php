<?php

	$acao = 'recuperarTarefasPendentes';
	require 'tarefa_controller.php';

	/*
	echo '<pre>';
	print_r($tarefas);
	echo '</pre>';
	*/

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Agenda</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			function editar(id, txt_data, txt_abertura, txt_intervalo, txt_fechamento, txt_nome, txt_email) { //novo

			//criar um form de edição
				let form = document.createElement('form')
				form.action = 'index.php?pag=index&acao=atualizar'
				form.method = 'post'
				//form.className = 'row'

			criar um input para entrada do texto
				let inputData = document.createElement('input')//novo
				inputData.type = 'text'
				inputData.name = 'data'
				inputData.className = 'form-control'
				inputData.value = txt_data

				let inputAbertura = document.createElement('input')//novo
				inputAbertura.type = 'text'
				inputAbertura.name = 'abertura'
				inputAbertura.className = 'form-control'
				inputAbertura.value = txt_abertura

				let inputIntervalo = document.createElement('input')//novo
				inputIntervalo.type = 'text'
				inputIntervalo.name = 'intervalo'
				inputIntervalo.className = 'form-control'
				inputIntervalo.value = txt_intervalo

				let inputFechamento = document.createElement('input')//novo
				inputFechamento.type = 'text'
				inputFechamento.name = 'fechamento'
				inputFechamento.className = 'form-control'
				inputFechamento.value = txt_fechamento

				let inputNome = document.createElement('input')//novo
				inputNome.type = 'text'
				inputNome.name = 'nome'
				inputNome.className = 'form-control'
				inputNome.value = txt_nome

				let inputEmail = document.createElement('input')//novo
				inputEmail.type = 'text'
				inputEmail.name = 'email'
				inputEmail.className = 'form-control'
				inputEmail.value = txt_email

			//criar um input hidden para guardar o id da tarefa
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id

			//criar um button para envio do form
				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'btn btn-info'
				button.innerHTML = 'Atualizar'

			//incluir inputTarefa no form
				form.appendChild(inputData)//novo
				form.appendChild(inputAbertura)//novo
				form.appendChild(inputIntervalo)//novo
				form.appendChild(inputFechamento)//novo
				form.appendChild(inputNome)//novo
				form.appendChild(inputEmail)//novo

			//incluir inputId no form
				form.appendChild(inputId)

				//incluir button no form
				form.appendChild(button)

				//teste
				//console.log(form)

				//selecionar a div tarefa
				let tarefa = document.getElementById('tarefa_'+id)

				//limpar o texto da tarefa para inclusão do form
				tarefa.innerHTML = ''

				//incluir form na página
				tarefa.insertBefore(form, tarefa[0])

			}

			function remover(id) {
				location.href = 'index.php?pag=index&acao=remover&id='+id;
			}

			function marcarRealizada(id) {
				location.href = 'index.php?pag=index&acao=marcarRealizada&id='+id;
			}
		</script>

	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					Agenda
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="index.php">Pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Novo evento</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todos eventos</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Pendentes</h4>
								<hr />

								<? foreach($tarefas as $indice => $tarefa) { ?>
									<div class="row mb-3 d-flex align-items-center tarefa"><!--impressão de tarefa pendentes-->
										<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>" >
											<?= $tarefa->data ?> |
											<?= $tarefa->abertura ?> |
											<?= $tarefa->intervalo ?> |
											<?= $tarefa->fechamento ?> |
											<?= $tarefa->nome ?> |
											<?= $tarefa->email ?> 
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i>

											<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->data ?>','<?= $tarefa->abertura ?>','<?= $tarefa->intervalo ?>','<?= $tarefa->fechamento ?>','<?= $tarefa->nome ?>','<?= $tarefa->email ?>')"></i><!--mostra valores para edicao-->
											<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id ?>)"></i>
										</div>
									</div>

								<? } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>