<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gupy</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>/imagens/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/main.css">
<!--===============================================================================================-->

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url(); ?>/imagens/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">

				<a href="javascript:window.history.back()"><- Voltar</a>
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Adicione seu número de telefone
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="text" id="telefone"  >
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn m-t-17">
					<button type="button" class="login100-form-btn" onclick="add_phone()">
						Cadastrar
					</button>
				</div>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>/js/main.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mask.min.js"/></script>
	<script type="text/javascript">$("#telefone").mask("(00) 00000-0009");</script>

	<script type="text/javascript">
		function add_phone(){
			let telefone = $('#telefone').val();
			if(telefone==''){
				$('#telefone').addClass('is-invalid');
				$('#telefone').focus();
				$('#telefone').attr('placeholder','Informe um telefone');
				$('#telefone').css("background-color", "#FFD6D6");
				return false;
			}
			$.ajax({
				url: "<?php echo base_url();?>gupy/adicionar_telefone",
				dataType:"json",
				type:"get",
				data:{telefone:telefone},
				cache:false,
				success:function(data){
					if (data) {
						window.location.href = './main';
					} else {
						alert('Não foi possivel cadastrar o telefone no momento!');
					}
				},error:function(e){
					alert('erro');
				}
			})
		}
	</script>

</body>
</html>