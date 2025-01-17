<?php
$usuario_id = $_SESSION['user_id'];
?>
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





	<style type="text/css">
		.title {
			color: white;
			text-align: center;
		}

		.container {
			text-align: center;
			align-items: center;
		}

		.card_img {
			margin-top: 3em;
			width: 100%;
			background-color: #808080;
		}

		.descricao_title {
			color: white;
			margin: 5%;
			font-size: 100%;
		}

		.descricao_text {
			color: white;
			margin-right: 10%;
			margin-left: 10%;
		}

		.btnFav {
			position: fixed;
			float: bottom;
			bottom: 15%;
			right: 3%;
			z-index: 100;
			border-radius: 50%;
			font-size: 20px;
			padding: 15px;
		}

		.btnComprar {
			position: fixed;
			float: bottom;
			bottom: 3%;
			z-index: 100;
			font-size: 100%;
			opacity: 0.6;

		}
	</style>
</head>

<body>
	<div id="header">
		<?php $this->load->view('menu.php') ?>
	</div>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo site_url(); ?>/imagens/bg-01.jpg');">
			<div id="produto"></div>
		</div>
		<!-- botão favoritar -->
		<div id="div_favButton"></div>
		<!-- botão comprar -->
		<div id="div_btnComprar">
			<button type="button" class="login100-form-btn btnComprar" id="btn_gerar_voucher" value="" onclick="adicionar_carrinho(this.value)" style="background-color: red">Adicionar ao carrinho!</button>
		</div>

	</div>
	<!--Fim container-->


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
	<script src="<?php echo site_url(); ?>/js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			loadData();
			//loadFavButton();
		});

		function loadDataInApp(value) {
			//console.log(value);

			var lines = '';

			lines += '<a href="javascript:window.history.go(-1)"><- Voltar</a>';
			lines += '<div class="card card_img" >';

			lines += '<img class="card-img-top" style="width: 100%" src="<?php echo base_url('imagens') ?>/' + value.IMAGEM.replace('C:\\fakepath\\', '') + '" alt="Imagem de capa do card"></div>';
			lines += '<div style="text-align:left">Produto: ' + value.NOME + '<br></div>';
			lines += '<div style="text-align:left">Preço: R$' + value.PRECO_ATUAL + '<br></div>';
			lines += '<div style="text-align:left">Descrição: ' + value.DESCRICAO + '<br></div>';
			lines += '<div style="text-align:left">Quantidade:<span style="margin-left:5vw"><input type="number" style="max-width:50px;background-color:#0098c2" value="1" id="itens_quantity"></span><br></div>';
			//lines+='<div style="text-align:left">Curtidas: '+value.TOTAL_CURTIDAS+'<br></div>';
			return lines;
		}

		function loadData() {
			$.ajax({
				url: "<?php echo site_url(); ?>gupy/ajax_get_produto",
				dataType: "json",
				type: "get",
				data: {
					produto_id: <?php echo $produto_id ?>
				},
				cache: false,
				success: function(data) {

					var lines = '';

					lines += loadDataInApp(data);

					if (lines) {
						$("#produto").html('');
						$("#produto").append(lines);
						$("#btn_gerar_voucher").val(data.PRECO_ATUAL);

					} else {
						alert('não há produtos cadastrados');
					}
					/*if (data.favorita) {
						
						$('#div_favButton').append('<button onclick="status_desfav('+data.favorita+')" class="btn btn-danger btnFav">f</button>');
					}else{
						$('#div_favButton').append('<button onclick="status_fav()" class="btn btn-primary btnFav">f</button>');
					}
					if (data.curtida) {
						
						$('#div_favButton').append('<button onclick="status_desfav('+data.favorita+')" class="btn btn-danger btnFav">f</button>');
					}else{
						$('#div_favButton').append('<button onclick="status_fav()" class="btn btn-primary btnFav">f</button>');
					}*/

				},
				error: function(e) {
					alert('erro');
				}
			})
		}

		function status_fav(status) {
			$.ajax({
				url: "<?php echo site_url(); ?>gupy/ajax_change_fav_status",
				dataType: "json",
				cache: false,
				type: "get",
				data: {
					usuario_id: <?php echo $usuario_id ?>,
					id_palavra: <?php echo $produto_id ?>
				},
				success: function(data) {
					$('#div_favButton').html('');
					$('#div_favButton').append('<button onclick="status_desfav(' + data + ')" class="btn btn-danger btnFav">F</button>');
				},
				error: function(e) {
					alert('erro');
				}
			});
		}

		/*function status_desfav(favorito_id){
			$.ajax({
				url: "<?php echo site_url(); ?>arqlibras/ajax_change_desfav_status",
				dataType:"json",
				cache:false,
				type:"get",
				data:{ favorito_id:favorito_id},
				success: function(data){
					$('#div_favButton').html('');
					$('#div_favButton').append('<button onclick="status_fav()" class="btn btn-primary btnFav">F</button>');
					
				},
				error:function(e){
					alert('erro');
				}
			});
		}*/

		/*function gerar_voucher(valor_produto){
			//console.log(data);
			$.ajax({
				url: "<?php echo site_url(); ?>gupy/ajax_gerar_voucher",
				dataType:"json",
				cache:false,
				type:"get",
				data:{ valor_produto:valor_produto,usuario_id:<?php echo $usuario_id ?>,produto_id:<?php echo $produto_id ?>,loja_id:<?php echo $loja_id ?>},
				success: function(data){
					
					if (data) {
						$('#modalVoucher').modal('show');
						$('#voucherModal').html('');
						$('#voucherModal').html(data);
					} else {
						$('#modalVoucher').modal('show');
						$('#voucherModal').html('');
						$('#voucherModal').html("Produto sem estoque. Não foi possivel emitir o voucher");
					}					
				},
				error:function(e){
					alert('erro');
				}
			});
		}*/
		function adicionar_carrinho(valor_produto) {
			
			valor_produto = valor_produto.replace(',','.');
			//console.log(valor_produto);
			let quantidade = $('#itens_quantity').val();
			$.ajax({
				url: "<?php echo site_url(); ?>gupy/ajax_adicionar_carrinho",
				dataType: "json",
				cache: false,
				type: "get",
				data: {
					valor_produto: valor_produto,
					quantidade: quantidade,
					usuario_id: <?php echo $usuario_id ?>,
					produto_id: <?php echo $produto_id ?>,
					loja_id: <?php echo $loja_id ?>
				},
				success: function(data) {

					if (data) {
						$('#modalVoucher').modal('show');
						//$('#voucherModal').html('');
						$('#total_carrinho').html(`${data.valor}`.replace('.',','));
						$('#quantidade_itens').html(data.quantidade);
					}
				},
				error: function(e) {
					alert('erro 12345');
				}
			});
		}
	</script>

	<!-- Modal -->
	<div class="modal fade" id="modalVoucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Item adicionado!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Status atual da compra:<br>
					<center><strong>Valor Atual: <span id="total_carrinho"></span></strong></center>
					<center><strong>Quantidade de itens: <span id="quantidade_itens"></span></strong></center>
				</div>
				<div class="modal-footer">
					<button type="button" style="width:49%" class="btn btn-primary" onclick="window.location='<?php echo site_url(); ?>gupy/listar_produtos/<?= $loja_id ?>'" data-dismiss="modal">Loja</button>
					<button type="button" style="width:49%" onclick="window.location='<?php echo site_url(); ?>gupy/checkout'" class="btn btn-success">Carrinho</button>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>

</html>