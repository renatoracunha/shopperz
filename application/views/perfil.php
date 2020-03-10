<?php
$usuario_id = $_SESSION['user_id'] ;
?>
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
			bottom: 15%;
			right: 3%;
			z-index: 100;
			border-radius: 50%;
			font-size: 20px;
			padding: 15px;
		}
		.btnComprar{
			position: fixed;
			float: bottom;
			bottom: 3%;
			z-index: 100;
			font-size: 100%;
			
		}
		
	</style>
</head>
<body >
	<div id="header">
        <?php $this->load->view('menu.php');
        print_r($info);?>

	</div>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo site_url(); ?>/imagens/bg-01.jpg');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
                <span class="login100-form-title p-b-53">Perfil	</span>
                					
                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Nome
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Defina um nome">
                    <input class="input100" type="text" id="nome"  >
                    <span class="focus-input100"></span>
                </div>
                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        E-mail
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Defina um email">
                    <input class="input100" type="text" id="email"  >
                    <span class="focus-input100"></span>
                </div>
                    <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Telefone
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "defina um telefone">
                    <input class="input100" type="text" id="telefone" >
                    <span class="focus-input100"></span>
                </div>
					

                <div class="container-login100-form-btn m-t-17">
                    <button type="button" class="login100-form-btn" onclick="cadastrar()">
                        Alterar
                    </button>
                </div>

				
			</div>
		</div>
	</div>
	

	
		</div>		
	</div><!--Fim container-->

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
	
</body>
</html>

