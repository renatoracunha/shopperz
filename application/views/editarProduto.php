<!DOCTYPE html>
<html lang="en">

<head>
	<title>Gupy</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php echo site_url(); ?>/imagens/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>/css/main.css">
	<!--===============================================================================================-->

</head>

<body>
	<div id="header">
		<?php $this->load->view('menu.php') ?>
	</div>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo site_url(); ?>/imagens/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">

				<a href="javascript:window.history.back"><- Voltar</a>

				<span class="login100-form-title p-b-53">
					Editar Produto
				</span>


				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Nome
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Defina um nome">
					<input class="input100" type="text" id="nome" value="<?= $NOME ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Preço na loja
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Defina um preço">
					<input class="input100" type="text" id="preco_inicial" value="<?= $PRECO_ORIGINAL ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Preço no App
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Defina um preço">
					<input class="input100" type="text" id="preco" value="<?= $PRECO_ATUAL ?>">
					<span class="focus-input100"></span>
				</div>
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Descição
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Defina uma descrição">
					<input class="input100" type="text" id="descricao" value="<?= $DESCRICAO ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="p-t-13 p-b-9">
					<span class="txt1">
						Imagem
					</span>
				</div>
				<div class="p-t-13 p-b-9">
					<span class="txt1">
						Estoque
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="quantidade no estoque">
					<input class="input100" type="text" id="estoque" value="<?= $TOTAL_ESTOQUE ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Categoria do produto
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Categoria do produto">
					<select class="input100" id="categoria">
						<option selected value="99">Outras</option>
						<?php foreach ($categoria_produto as $categoria) :
							if ($CODIGO_CATEGORIA == $categoria['id']) {
								$selected = 'selected';
							} else {
								$selected = '';
							}
						?>

							<option <?= $selected ?> value="<?php echo $categoria['id'] ?>"><?php echo $categoria['descricao'] ?></option>
						<?php endforeach ?>

					</select>
					<span class="focus-input100"></span>
				</div>


				<div class="container-login100-form-btn m-t-17">
					<button type="button" class="login100-form-btn" onclick="editar()">
						Editar
					</button>
				</div>


			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="<?php echo site_url(); ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo site_url(); ?>/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo site_url(); ?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo site_url(); ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo site_url(); ?>/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo site_url(); ?>/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo site_url(); ?>/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo site_url(); ?>/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mask.min.js" />
	</script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskMoney.min.js" />
	</script>

	<script src="<?php echo site_url(); ?>/js/main.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#preco').maskMoney({
				prefix: "R$ ",
				decimal: ",",
				thousands: "."
			});
			$('#preco_inicial').maskMoney({
				prefix: "R$ ",
				decimal: ",",
				thousands: "."
			});
		});

		function editar() {
			let id = "<?= $CODIGO ?>";
			//  console.log(id);

			//return console.log($('#imagem'));
			let preco = $('#preco').val();
			let preco_inicial = $('#preco_inicial').val();
			let nome = $('#nome').val();
			let descricao = $('#descricao').val();
			let estoque = $('#estoque').val();
			let categoria = $('#categoria').val();
			if (preco == '') {
				$('#preco').addClass('is-invalid');
				$('#preco').focus();
				$('#preco').attr('placeholder', 'Informe um preço');
				$('#preco').css("background-color", "#FFD6D6");
				return;
			}

			if (descricao == '') {
				$('#descricao').addClass('is-invalid');
				$('#descricao').focus();
				$('#descricao').attr('placeholder', 'Informe uma descrição');
				$('#descricao').css("background-color", "#FFD6D6");
				return;
			}
			if (nome == '') {
				$('#nome').addClass('is-invalid');
				$('#nome').focus();
				$('#nome').attr('placeholder', 'Informe um nome');
				$('#nome').css("background-color", "#FFD6D6");
				return;
			}
			if (estoque == '') {
				$('#estoque').addClass('is-invalid');
				$('#estoque').focus();
				$('#estoque').attr('placeholder', 'Informe um estoque');
				$('#estoque').css("background-color", "#FFD6D6");
				return;
			}

			$.ajax({
				url: "<?php echo site_url(); ?>gupy/ajax_editar_produto",
				dataType: "json",
				type: "get",
				data: {
					preco: preco,
					descricao: descricao,
					nome: nome,
					estoque: estoque,
					categoria: categoria,
					preco_inicial: preco_inicial,
					id: id
				},
				cache: false,
				success: function(data) {
					console.log('ok')
					if (data) {
						alert('Produto editado com sucesso');
					}
				},
				error: function(e) {
					alert('erro');
				}
			})
		}
	</script>
</body>

</html>