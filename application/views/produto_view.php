<?php// $usuario_id = $_SESSION['user_id']; ?>

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

	<script type="text/javascript">
		$(document).ready(function(){
			loadData();
			//loadFavButton();
		});

		function loadDataInApp(value){

			var lines = '';
			lines+='<div class="card card_img" >';

			lines+='<img class="card-img-top" style="width: 100%" src="<?php echo base_url('imagens') ?>/'+value.IMAGEM+'" alt="Imagem de capa do card"></div>'; 
			lines+='<div style="text-align:left">Produto: '+value.NOME+'<br></div>';
			lines+='<div style="text-align:left">Preço: R$'+value.PRECO_ATUAL+'<br></div>';
			lines+='<div style="text-align:left">Descrição: '+value.DESCRICAO+'<br></div>';
			lines+='<div style="text-align:left">Curtidas: '+value.TOTAL_CURTIDAS+'<br></div>';
			return lines;
		}

		function loadData(){
			$.ajax({
				url: "<?php echo site_url();?>shopperz/ajax_get_produto",
				dataType:"json",
				type:"get",
				data:{produto_id:<?php echo $produto_id ?>	},
				cache:false,
				success:function(data){
					var lines = '';
					$.each(data,function(index,value){
						lines+= loadDataInApp(value);
					});

					if (lines) {
						$("#produtos").html('');
						$("#produto").append(lines);
					}else{
						alert('não há produtos cadastrados');
					}
					if (data.favorita) {
						
						$('#div_favButton').append('<button onclick="status_desfav('+data.favorita+')" class="btn btn-danger btnFav">f</button>');
					}else{
						$('#div_favButton').append('<button onclick="status_fav()" class="btn btn-primary btnFav">f</button>');
					}
					if (data.curtida) {
						
						$('#div_favButton').append('<button onclick="status_desfav('+data.favorita+')" class="btn btn-danger btnFav">f</button>');
					}else{
						$('#div_favButton').append('<button onclick="status_fav()" class="btn btn-primary btnFav">f</button>');
					}
					//data.yt_id;
				},error:function(e){
					alert('erro');
				}
			})
		}

		function status_fav(status){
			$.ajax({
				url: "<?php echo site_url();?>shopperz/ajax_change_fav_status",
				dataType:"json",
				cache:false,
				type:"get",
				data:{ usuario_id:1,id_palavra:<?php echo $produto_id ?>},
				success: function(data){
					$('#div_favButton').html('');
					$('#div_favButton').append('<button onclick="status_desfav('+data+')" class="btn btn-danger btnFav">F</button>');
				},
				error:function(e){
					alert('erro');
				}
			});
		}

		function status_desfav(favorito_id){
			$.ajax({
				url: "<?php echo site_url();?>arqlibras/ajax_change_desfav_status",
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
		}
	</script>
	<title>Shopperz!</title>
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
			<div id="produto"></div>
		</div>
		<!-- botão favoritar -->
		<div id="div_favButton"></div>
		<!-- botão comprar -->
		<div id="div_btnComprar">
			<button type="button" class="btn btn-success btnComprar">Add ao carrinho</button>
		</div>
		
	</div><!--Fim container-->



</body>
</html>

