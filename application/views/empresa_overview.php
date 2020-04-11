<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gupy</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo site_url(); ?>/imagens/icons/favicon.ico"/>
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
			<div class="wrap-login100 p-l-110 p-r-110 p-t-20 p-b-33">
				
				<a href="javascript:window.history.go(-1)"><- Voltar</a>

				<span class="login100-form-title p-b-53">
					
					<div class="container-login100-form-btn m-t-17">
						<button type="button" class="login100-form-btn"  onclick="cadastrar()">
							Cadastrar Produto
						</button>
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Gerenciar produtos
						</span>
					</div>
					<div class="wrap-input100 validate-input">
						<select onchange="loadData()" class="input100" id="status">
							<option value="1">Ativos</option>
							<option value="2">Inativos</option>
						</select>
						<span class="focus-input100"></span>
					</div>
				</span>
				<div class="col-lg-12">
					<table style="color:black" id="tabela" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Produto</th>
								<th>Preço</th>
								<th>Opções</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table> 
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
	<script src="<?php echo site_url(); ?>/js/main.js"></script>

	<script>
		$(document).ready(function(){
			loadData();
		});

		function editar(id_item){
			window.location.href = './editarProduto/'+id_item; 
		}

		function cadastrar(){
			window.location.href = '<?php echo site_url();?>gupy/cadastrarProduto'; 
		}

		function loadDataInTable(value){
			var lines = '';
			lines+='<tr>';

			lines+='<td>'+value.nome+'</td>';
			lines+='<td>'+value.preco+'</td>';
			lines+='<td>';
			lines+='<button style="margin-right:4px;" onclick="editar('+value.id+')" class="btn btn-primary opt-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
			if (value.STATUS==1) {
				lines+='<button onclick="desabilitar('+value.id+')" class="btn btn-danger opt-btn"><i class="fa fa-times" aria-hidden="true"></i></button>';
			}else{
				lines+='<button onclick="habilitar('+value.id+')" class="btn btn-success opt-btn"><i class="fa fa-plus" aria-hidden="true"></i></button>';
			}


			lines+='</td>';

			lines+='</tr>'; 

			return lines;
		}

		function loadData(status = $('#status').val()){
			let url = 'ajax_get_produtos_ativos_editar';
			if (status != 1) {
				url = 'ajax_get_produtos_inativos_editar';
			}
			$.ajax({
				url: "<?php echo site_url();?>gupy/"+url+"",
				dataType:"json",
				type:"get",
				cache:false,
				success:function(data){
					
					var lines = '';
					$.each(data,function(index,value){
						lines+= loadDataInTable(value);
					});

					if (lines) {
						$("#tabela tbody").html('');
						$("#tabela tbody").append(lines);
					}else{
						$("#tabela tbody").html('');
						$("#tabela tbody").append('<td colsplan="3">Não há produtos com esse status</td>');
					}
				},error:function(e){
					alert('erro');
				}
			})
		}

		function desabilitar(id_item){
			$.ajax({
				url: "<?php echo site_url();?>gupy/ajax_desabilitar_itens",
				dataType:"json",
				type:"get",
				data:{id_item:id_item},
				cache:false,
				success:function(data){
					loadData();
				},error:function(e){
					alert('erro');
				}
			})
		}

		function habilitar(id_item){
			$.ajax({
				url: "<?php echo site_url();?>gupy/ajax_habilitar_itens",
				dataType:"json",
				type:"get",
				data:{id_item:id_item},
				cache:false,
				success:function(data){
					loadData(0);
				},error:function(e){
					alert('erro');
				}
			})
		}
	</script>
</body>
</html>