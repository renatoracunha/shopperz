<!DOCTYPE html>
<html lang="en">

<head>
	<title>Gupy</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../../imagens/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"	href="../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../css/util.css">
	<link rel="stylesheet" type="text/css" href="../../css/main.css">
	<link rel='manifest' href='../../manifest.json'>
	<!--===============================================================================================-->
	<!--google login api-->
	<script src="https://apis.google.com/js/api:client.js"></script>
	<meta name="google-signin-client_id"
		content="578741701184-fj68vi10l264nfopfjfj3b3hi44mmvsu.apps.googleusercontent.com">
	<!--google login api-->
	<!--facebook login api-->
	<!-- HTTPS required. HTTP will give a 403 forbidden response -->
	<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
	<script async defer crossorigin="anonymous"
		src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v5.0&appId=177869810191658&autoLogAppEvents=1"></script>

	<!--facebook login api-->

</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('../../imagens/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w"
					action="<?php echo base_url() ?>/gupy/login">
					<span class="login100-form-title p-b-53">
						Entrar com...
					</span>

					<button onclick="login_facebook()" type="button" class="btn-face m-b-20">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</button>

					<button id="signin_login-google-btn" type="button" class="btn-google m-b-20">
						<img src="../../imagens/icons/icon-google.png" alt="GOOGLE">
						Google
					</button>

					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Telefone
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<input class="input100" type="text" id="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{5,4}">
						<span class="focus-input100"></span>
					</div>

					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Senha
						</span>

						<a href="<?php echo base_url()?>gupy/recuperarSenha" class="txt2 bo1 m-l-5">
							Esqueceu a senha?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" id="senha">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button type="button" class="login100-form-btn" onclick="verify_login()">
							Entrar
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Não é membro ainda?
						</span>

						<a href="<?php echo base_url()?>gupy/cadastro" class="txt2 bo1">
							Cadastre-se!
						</a>
					</div>
					<div class="w-full text-center p-t-10">
						<span class="txt2">
							Quer conferir nossas parceiras?
						</span>

						<a href="<?php echo base_url()?>gupy/main" class="txt2 bo1">
							Clique aqui!!!
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="../../vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="../../vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="../../vendor/bootstrap/js/popper.js"></script>
	<script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="../../vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="../../vendor/daterangepicker/moment.min.js"></script>
	<script src="../../vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="../../vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="../../js/main.js"></script>
	<script type="text/javascript" src="../../js/jquery.mask.min.js" />
	</script>
	<script type="text/javascript">$("#telefone").mask("(00) 00000-0009");</script>
	<!--===============================================================================================-->


	<script type="text/javascript">
		$(document).ready(function () {

			//load sdk from facebook login
			(function (d, s, id) { // Load the SDK asynchronously
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s);
				js.id = id;
				js.src = "https://connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
			//render do btn loginn google

			startApp();
		});

		var googleUser = {};
        var startApp = function() {
            gapi.load('auth2', function() {
                // Retrieve the singleton for the GoogleAuth library and set up the client.
                auth2 = gapi.auth2.init({
                    client_id: '578741701184-fj68vi10l264nfopfjfj3b3hi44mmvsu.apps.googleusercontent.com',
                    cookiepolicy: 'single_host_origin',
                    // Request scopes in addition to 'profile' and 'email'
                    //scope: 'additional_scope'
                });


                attachSignin(document.getElementById('signin_login-google-btn'));
            });
        };

        function attachSignin(element) {

            auth2.attachClickHandler(element, {},
                function(googleUser) {

                    var profile = googleUser.getBasicProfile();
                    var id_token = googleUser.getAuthResponse().id_token;
                    let login = {};
                    
                    login.id = profile.getId();
                    login.nome = profile.getName();
                    login.email = profile.getEmail();
                    login.api = 'google';
                    login.profile_picture_url = profile.getImageUrl();
                    login.google_token = id_token;

                    api_login(login);

                    //console.log(profile.ofa);

                },
                function(error) {
                    console.log(JSON.stringify(error, undefined, 2));
                });
        }
        

        function login_facebook() {
			alert('Funcionalidade desabilitada temporáriamente.');
			return false;
            FB.login(function(response) { // See the onlogin handler
                FB.api('/me', {
                    fields: 'name,email,picture.width(250).height(250)'
                }, function(response) {
                    var fb_profile = response;
                    let login = {};
                    login.id = fb_profile.id;
                    login.nome = fb_profile.name;
                    login.email = fb_profile.email;
                    login.api = 'facebook';                    
					login.profile_picture_url = fb_profile.picture.data.url;
                    api_login(login);

                });
            }, {
                scope: 'public_profile,email',
                return_scopes: true
            });

        }



        window.fbAsyncInit = function() {
            //verifica se o usuário está conectado ao facebook no load da página
            FB.init({
                appId: '177869810191658',
                cookie: true, // Enable cookies to allow the server to access the session.
                xfbml: true, // Parse social plugins on this webpage.
                version: 'v5.0' // Use this Graph API version for this call.
            });
        };

		function api_login(login_info) {
			
			$.ajax({
				url: "<?php echo site_url();?>gupy/ajax_api_login",
				dataType: "json",
				type: "get",
				data: { nome: login_info.nome, email: login_info.email,api:login_info.api },
				cache: false,
				success: function (data) {
					if (data.TELEFONE == '') {
						window.location.href = "./add_phone";
					} else {
						window.location.href = "./main";
					}
				}, error: function (e) {
					alert('erro');
				}
			})
		}


		function verify_login() {
			let telefone = $('#telefone').val();
			let senha = $('#senha').val();

			if (senha == '') {
				$('#senha').addClass('is-invalid');
				$('#senha').focus();
				$('#senha').attr('placeholder', 'Informe uma senha');
				$('#senha').css("background-color", "#FFD6D6");
			}
			if (telefone == '') {
				$('#telefone').addClass('is-invalid');
				$('#telefone').focus();
				$('#telefone').attr('placeholder', 'Informe um telefone');
				$('#telefone').css("background-color", "#FFD6D6");
			}
			$.ajax({
				url: "<?php echo site_url();?>gupy/ajax_get_user_data",
				dataType: "json",
				type: "get",
				data: { senha: senha, telefone: telefone },
				cache: false,
				success: function (data) {
					if (data) {
						window.location.href = "<?php echo base_url() ?>";
					} else {
						alert('cadastro inválido ou inexistente')
					}
				}, error: function (e) {
					alert('erro');
				}
			})
		}
	</script>
</body>

</html>