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
    <div id="header">
		<?php $this->load->view('menu.php') ?>
	</div>	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url(); ?>/imagens/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-20 p-b-33">

				<a href="javascript:window.history.go(-1)"><- Voltar</a>
                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Nome
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Username is required">
                    <input class="input100" type="text" id="nome" value="<?php echo $dados['NOME']?>"  >
                    <span class="focus-input100"></span>
                </div>
                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Email
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Username is required">
                    <input class="input100" type="text" id="email" value="<?php echo $dados['EMAIL']?>">
                    <span class="focus-input100"></span>
                </div>
                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Telefone
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Username is required">
                    <input class="input100" type="text" id="telefone" value="<?php echo $dados['TELEFONE']?>">
                    <span class="focus-input100"></span>
                </div>
                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Tipo de usuário
                    </span>
                </div>
                <div class="wrap-input100 validate-input">
                    <select class="input100" id="tipoUsuario" disabled>
                        <option <?php echo ($dados['CODIGO_TIPO_USUARIO'] == 1)?'selected':''?> value="1">Shopper</option>
                        <option <?php echo ($dados['CODIGO_TIPO_USUARIO'] == 2)?'selected':''?> value="2">Empresa</option>
                    </select>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn m-t-17">
                    <button type="button" class="login100-form-btn"  onclick="update()">
                        Atualizar
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
		function update(){
			let email = $('#email').val();
			let nome = $('#nome').val();
			let telefone = $('#telefone').val();

			if(email==''){
				$('#email').addClass('is-invalid');
				$('#email').focus();
				$('#email').attr('placeholder','Informe um email/Login');
				$('#email').css("background-color", "#FFD6D6");
				return false;
			}
			if(nome==''){
				$('#nome').addClass('is-invalid');
				$('#nome').focus();
				$('#nome').attr('placeholder','Informe um nome');
				$('#nome').css("background-color", "#FFD6D6");
				return false;
			}
			if(telefone==''){
				$('#telefone').addClass('is-invalid');
				$('#telefone').focus();
				$('#telefone').attr('placeholder','Informe um telefone');
				$('#telefone').css("background-color", "#FFD6D6");
				return false;
			}
			
			$.ajax({
				url: "<?php echo base_url();?>gupy/update_cadastro",
				dataType:"json",
				type:"get",
				data:{email:email,nome:nome,telefone:telefone},
				cache:false,
				success:function(data){
					if (data) {
						alert('Dados Atualizados.');
					}
				},error:function(e){
					alert('erro');
				}
			})
		}
	</script>

</body>
</html>