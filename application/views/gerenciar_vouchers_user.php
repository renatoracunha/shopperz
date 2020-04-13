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
<style type="text/css">
	/*input pesquisar*/
	@import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");

	.search {
		margin: 0 auto;
	}

	.search > h3 {
		font-weight: normal;
	}



	.search > div {
		display: inline-block;
		position: relative;
	}

	.search > div:after {
		content: "";
		background: white;
		width: 4px;
		height: 20px;
		position: absolute;
		top: 20px;
		right:0px;
		transform: rotate(135deg);
		box-shadow: 1px 0 #0091c2;
	}

	.search > div > input {
		color: white;
		font-size: 16px;
		background: transparent;
		width: 25px;
		height: 25px;
		padding: 10px;
		border: solid 3px white;
		outline: none;
		border-radius: 35px;
		box-shadow: 0 1px #0091c2;
		transition: width 0.5s;
	}

	.search > div > input::placeholder {
		color: #efefef;
		opacity: 1;
	}

	.search > div > input::-ms-placeholder {
		color: #efefef;
	}

	.search > div > input::-ms-input-placeholder {
		color: #efefef;
	}

	.search > div > input:focus,
	.search > div > input:valid {
		width: 250px;
	}
</style>
</head>
<body>

	<div id="header">
		<?php $this->load->view('menu.php') ?>
	</div>
	<div class="limiter">

		<div class="container-login100" style="background-image: url('<?php echo site_url(); ?>/imagens/bg-01.jpg');">
			<div class="row" style="margin-bottom: 5%">
				
				<div  class="search">
					<div class="row">
						<input onkeyup="pesquisar_transacao(this.value)" type="text" placeholder="       Pesquisar transação . . ." required>
					</div>
				</div>
				</div>
				
				<div class="wrap-login100 p-l-110 p-r-110 p-t-20 p-b-33">
					
					<a href="javascript:window.history.go(-1)"><- Voltar</a>
					<span class="login100-form-title p-b-53">
						<div class="p-t-31 p-b-9">
							<span class="txt1">
								Gerenciar vouchers
							</span>
						</div>
						<div style="align-items: center" class="input100 validate-input">
							<select  onchange="loadData()" class="input100" id="status">
								<option value="9">Pendentes</option>
								<option value="1">Usados Com Sucesso</option>
								<option value="3">Cancelados</option>
							</select>
							<span class="focus-input100"></span>
						</div>
					</span>
				<div class="col-lg-12">
					<table style="color:black" id="tabela" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Código</th>
								<th>Loja</th>
								<th>Data</th>
								
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

		

		function loadDataInTable(value){
			var lines = '';
			lines+='<tr onclick="abrirModal('+value.id_voucher+')" >';
			lines+='<td>'+value.id_voucher_cript+'</td>';
			lines+='<td>'+value.nome_loja+'</td>';
			lines+='<td>'+value.data_formatada+'</td>';

			lines+='</tr>'; 

			return lines;
		}

		function loadData(status = $('#status').val()){
			
			$.ajax({
				url: "<?php echo site_url();?>gupy/ajax_get_user_transactions",
				dataType:"json",
				type:"get",
				data:{status:status},
				cache:false,
				success:function(data){
					
					var lines = '';
					$.each(data,function(index,value){
						lines+= loadDataInTable(value);
					});

					if (lines) {
						$("#tabela tbody").html('');
						$("#tabela tbody").append(lines);
						if (Object.keys(data).length==1) {
							$('#tabela').css('margin-bottom','65%');
						}else{
							$('#tabela').css('margin-bottom','5%');
						}
					}else{
						$("#tabela tbody").html('');
						$("#tabela tbody").append('<td colsplan="3">Não há produtos com esse status</td>');
					}
				},error:function(e){
					alert('erro');
				}
			})
		}

		/*function fechar_transacao(voucher_id,confirmacao){
			console.log(voucher_id);
			$.ajax({
				url: "<?php echo site_url();?>gupy/ajax_fechar_transacao",
				dataType:"json",
				type:"get",
				data:{voucher_id:voucher_id,status:confirmacao},
				cache:false,
				success:function(data){
					alert('Voucher finalizado com sucesso!');
					loadData();
				},error:function(e){
					alert('erro');
				}
			})
		}*/

		/*function desabilitar(id_item){
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
		}*/

		function abrirModal(voucher_id){
            let status = $('#status').val()
			$.ajax({
				url: "<?php echo site_url();?>gupy/ajax_get_dados_transacao_user",
				dataType:"json",
				type:"get",
				data:{voucher_id:voucher_id,status:status},
				cache:false,
				success:function(data){
					$('#gerenciarCompra').modal('show');
					$('#voucherModal').html('');
					$('#voucherModal').html(data.voucher_code);
					$('#nomeModal').html('');
					$('#nomeModal').html(data.nome_loja);
					$('#confirmar_compra').val(voucher_id);
					$('#cancelar_compra').val(voucher_id);
					$('#itens').html('');
					$.each(data.itens,function(index,value){
						$('#itens').append('<br>');
						$('#itens').append(value);
						
					});
					if ($('#status').val()==9) {
						$('#modalFooter').show();
					}else{
						$('#modalFooter').hide();
					}
				},error:function(e){
					alert('erro');
				}
			})
		}

		function pesquisar_transacao(nome){

			let status = $('#status').val();
			$.ajax({
				url: "<?php echo site_url();?>gupy/ajax_get_user_transacao_by_nome_loja",
				dataType:"json",
				data:{nome:nome, status:status},
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
						if (Object.keys(data).length==1) {
							$('#tabela').css('margin-bottom','65%');
						}else{
							$('#tabela').css('margin-bottom','5%');
						}
					}else{
						$("#tabela tbody").html('');
						$("#tabela tbody").append('<td colsplan="3">Não há produtos com esse status</td>');
					}

				},error:function(e){
					alert('erro');
				}
			})
		}
	</script>
	
	<!-- Modal -->
	<div class="modal fade" id="gerenciarCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Gerenciar compra</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Dados da compra:<br>
					<center><strong>Voucher: <span id="voucherModal"></span></strong></center><br>
					<center><strong>Nome da Loja: <span id="nomeModal"></span></strong></center><br>
					<center><strong>Itens: <span id="itens"></span></strong></center><br>
				</div>
				<!-- <div id="modalFooter" class="modal-footer">
					<button type="button" id="confirmar_compra" value="" onclick="fechar_transacao(this.value,3)" class="btn btn-danger" data-dismiss="modal">Recusar Venda</button>
					<button type="button" id="cancelar_compra" value="" onclick="fechar_transacao(this.value,1)" class="btn btn-success" data-dismiss="modal">Confirmar Venda</button>
				</div> -->
			</div>
		</div>
	</div>
</body>
</html>