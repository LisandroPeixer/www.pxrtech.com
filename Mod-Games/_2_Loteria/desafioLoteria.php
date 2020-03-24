<html>
	<head>
		<title>Resultado do sorteio</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="estilo.css">

		<?php
			
			$loteria = array();	
			while (count($loteria) <= 5) {
				$num = rand(1, 12);
					if(!in_array($num, $loteria)){
						$loteria[] = $num;
				}
			}

			/*echo '<pre>';
			print_r($loteria);
			echo '</pre>';

			echo '<pre>';
			print_r($_POST);
			echo '</pre>';*/
			
			if(in_array($_POST[0], $loteria)){
				$acerto0 = 1;
			} else {
				$acerto0 = 0;
			}
			if(in_array($_POST[1], $loteria)){
				$acerto1 = 1;
			} else {
				$acerto1 = 0;
			}
			if(in_array($_POST[2], $loteria)){
				$acerto2 = 1;
			} else {
				$acerto2 = 0;
			}
			if(in_array($_POST[3], $loteria)){
				$acerto3 = 1;
			} else {
				$acerto3 = 0;
			}
			if(in_array($_POST[4], $loteria)){
				$acerto4 = 1;
			} else {
				$acerto4 = 0;
			}
			if(in_array($_POST[5], $loteria)){
				$acerto5 = 1;
			} else {
				$acerto5 = 0;
			}

			$totalAcertos = $acerto0 + $acerto1 + $acerto2 + $acerto3 + $acerto4 + $acerto5;
			//echo $totalAcertos;

			switch ($totalAcertos) {
			 	case 6: 
			 		$premio = 'Parabens!!! Voce acaba de ficar Milionário!!!';
			 		break;
			 	case 5:
			 		$premio = 'Parabens!!! Voce acertou a Quina e ficará rico!!!';
			 		break;
			 	case 4:
			 		$premio = 'Parabens!!!  Voce acertou a Quadra e ganhará um bom dinheiro!!!';
			 		break;
			 	case 3:
			 		$premio = 'Parabens!!! Voce acertou tres numeros e ganhará um premio!!!';
			 		break;
			 	case 2:
			 		$premio = 'Que pena!!! Voce acertou 2 numeros, continue tentando...';
			 		break;
			 	case 1:
			 		$premio = 'Que pena!!! Voce acertou somente 1 numeros, continue tentando...';
			 		break;	
			 	default:
			 		$premio = 'Que pena!!! Voce não acertou nenhum numero, não desista!!!';
			 		break;
			}
		?>

	</head>
	
	<body>
		<header>
			<h1>LOTERIA DA SORTE</h1>
			<hr>
		</header>
		
		<nav>
			<h1> E os numeros sorteados foram: </h1>		

			<h1>
			<?= $loteria[0]?> | <?= $loteria[1] ?> | <?= $loteria[2] ?> | <?= $loteria[3]?> | <?= $loteria[4]?> | <?= $loteria[5]?>
			</h1> 
			<hr>

			<h1> <?= $premio; ?> </h1>
			<hr>

			<h1> Sua aposta: </h1>

			<h1>
				<?= $_POST[0]?> | <?= $_POST[1] ?> | <?= $_POST[2] ?> | <?= $_POST[3]?> | <?= $_POST[4]?> | <?= $_POST[5]?> 
			</h1>

			<button>
				<a href="index.html"> Faça uma nova aposta</a>
			</button>
		</nav>	

	</body>

</html>