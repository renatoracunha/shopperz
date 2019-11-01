<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shopperz</title>
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
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo site_url(); ?>/imagens/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				
					<?php 
						if (!empty($patrocinador['CODIGO'])) {
					?>
							<span class="login100-form-title p-b-53">
								Indicado pelo shopper: <?php echo $patrocinador['NOME'] ?>
							</span>
					<?php 	
						}else{
					?>
							<span class="login100-form-title p-b-53">
								Cadastro Independente
							</span>
					<?php 			
						}
					?>
					
					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Nome
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" id="nome"  >
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Email
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" id="email"  >
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Telefone
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" id="telefone"  >
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Senha
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" id="senha" >
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-13 p-b-9">
						<span class="txt1" id="span_confirmarSenha">
							Confirmar senha
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" id="confirmarSenha" >
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Tipo de usuário
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<select class="input100" id="tipoUsuario">
							<option value="1">Shopper</option>
							<option value="2">Empresa</option>
						</select>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button type="button" class="login100-form-btn"  onclick="verify_cadastro()">
							Cadastrar
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
	<script src="<?php echo site_url(); ?>/js/main.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo site_url(); ?>js/jquery.mask.min.js"/></script>
	<script type="text/javascript">$("#telefone").mask("(00) 00000-0009");</script>

	<script type="text/javascript">
		function verify_cadastro(){
			let email = $('#email').val();
			let nome = $('#nome').val();
			let senha = $('#senha').val();
			let telefone = $('#telefone').val();
			let confirmarSenha = $('#confirmarSenha').val();
			let tipoUsuario = $('#tipoUsuario').val();

			if(senha==''){
				$('#senha').addClass('is-invalid');
				$('#senha').focus();
				$('#senha').attr('placeholder','Informe uma senha');
				$('#senha').css("background-color", "#FFD6D6");
				return;
			}

			if(email==''){
				$('#email').addClass('is-invalid');
				$('#email').focus();
				$('#email').attr('placeholder','Informe um email/Login');
				$('#email').css("background-color", "#FFD6D6");
				return;
			}
			if(nome==''){
				$('#nome').addClass('is-invalid');
				$('#nome').focus();
				$('#nome').attr('placeholder','Informe um nome');
				$('#nome').css("background-color", "#FFD6D6");
				return;
			}
			if(telefone==''){
				$('#telefone').addClass('is-invalid');
				$('#telefone').focus();
				$('#telefone').attr('placeholder','Informe um telefone');
				$('#telefone').css("background-color", "#FFD6D6");
				return;
			}
			if(confirmarSenha==''){
				$('#confirmarSenha').addClass('is-invalid');
				$('#confirmarSenha').focus();
				$('#confirmarSenha').attr('placeholder','Informe um confirmação de senha');
				$('#confirmarSenha').css("background-color", "#FFD6D6");
				return;
			}
			if(senha!=confirmarSenha){
				$('#confirmarSenha').addClass('is-invalid');
				$('#confirmarSenha').focus();
				$('#confirmarSenha').val('');
				$('#senha').val('');
				$('#span_confirmarSenha').html('');
				$('#span_confirmarSenha').html('Senhas não correspondentes');
				$('#confirmarSenha').attr('placeholder','senhas informadas diferentes');
				$('#confirmarSenha').css("background-color", "#FFD6D6");
				return;
			}
			$.ajax({
				url: "<?php echo site_url();?>shopperz/ajax_cadastro",
				dataType:"json",
				type:"get",
				data:{senha:senha,email:email,nome:nome,telefone:telefone,tipoUsuario:tipoUsuario,patrocinador:<?php echo $patrocinador['CODIGO'] ?>},
				cache:false,
				success:function(data){
					if (data.cadastrado) {
						alert('email já cadastrado');
					}else if(data.usuario){
						window.location.href = "<?php echo site_url(); ?>shopperz/main";
					}else{
						alert('Para registro de empresa, aguarde nossa análise de dados.');
						window.location.href = "<?php echo site_url(); ?>";
					}
				},error:function(e){
					alert('erro');
				}
			})
		}
	</script>

</body>
</html>