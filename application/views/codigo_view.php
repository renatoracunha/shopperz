
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<!-- Meta tags Obrigatórias -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css') ?>">
	<!-- JavaScript (Opcional) -->
	<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
	<script src="<?php echo base_url('js/jquery.js') ?>"></script>
	<script src="<?php echo base_url('js/popper.js') ?>"></script>
	<script src="<?php echo base_url('js/bootstrap.js') ?>"></script>
	<script src="https://kit.fontawesome.com/8d24bc018e.js"></script>

	<title>Gupy</title>
	<style type="text/css">
		.title{
			color: white;
			text-align: center;
		}
		.container{
			text-align: center;
			align-items: center;
		}
		.card_img{
			margin-top: 3em;
			width: 100%;
			background-color: #808080;
		}
		.descricao_title{
			color: white;
			margin: 5%;			
			font-size: 100%;
		}
		.descricao_text{
			color: white;
			margin-right: 10%;
			margin-left: 10%;			
		}
		.btnFav{
			position: fixed;
			float: bottom;
			bottom: 35px;
			right: 15px;
			z-index: 100;
			border-radius: 50%;
			font-size: 20px;
			padding: 15px;
		}
		.btnComprar{
			position: fixed;
			float: bottom;
			bottom: 35px;
			right: 60%;
			z-index: 100;
			border-radius: 15%;
			font-size: 15px;
			padding: 15px;
		}
		body{
			color: white;
		}
	</style>
</head>
<body style="background-color: #3761a3">
	<div id="header">
		<?php $this->load->view('menu.php') ?>
	</div>

	<div class="container">
		<div class="row">

			<a href="javascript:window.history.go(-1)"><- Voltar</a>
			
			<div class="col-md-12">
				<center> Compartilhe o link com seu código.<br></center>
				<textarea style="height: 150%;width: 100%;margin-bottom: 15%;background-image: url('../imagens/bg-01.jpg');" id="codigo" disabled> <?php echo base_url(); ?>gupy/cadastro/<?php echo $codigo ?></textarea>
			</div>

			<div class="col-md-12">
				<button onclick="copiar_codigo('#codigo')">Copiar Código</button>
			</div>
		</div>
		<div class="row" style="margin: 20% auto">
			<div class="col-md-12">
				<button type="button">Visualizar sua rede</button>
			</div>
		</div>
	</div><!--Fim container-->


	<script >
		function copiar_codigo(element) {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($(element).text()).select();
			document.execCommand("copy");
			$temp.remove();
		}
	</script>
</body>
</html>

