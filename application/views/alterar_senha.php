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

<div class="limiter">
    <div class="container-login100" style="background-image: url('<?php echo site_url(); ?>/imagens/bg-01.jpg');">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">

            <a href="javascript:window.history.back"><- Voltar</a>
            <div class="p-t-13 p-b-9">
                <span class="txt1">
                    Nova Senha:
                </span>
            </div>
            <div class="wrap-input100" id="div_nova_senha">
                <input class="input100 auto-complete" type="password" id="nova_senha" required >
                <span class="focus-input100"></span>
            </div>
            <div class="p-t-13 p-b-9">
                <span class="txt1">
                    Confirme a nova senha:
                </span>
            </div>
            <div class="wrap-input100" id="div_conf_nova_senha">
                <input class="input100 auto-complete" type="password" id="conf_nova_senha" required >
                <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn m-t-17">
                <button class="login100-form-btn" type="button" onclick="enviar()">Enviar</button>
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
<script>
    function enviar()
    {
        nova_senha = $("#nova_senha").val();
        conf_nova_senha = $("#conf_nova_senha").val();

        if(nova_senha == conf_nova_senha){
            $.ajax({
                url: "<?php echo base_url()?>gupy/ajax_alterar_senha",
                type: "post",
                dataType: "json",
                data: {nova_senha:nova_senha, user: <?php echo $id ?> },
                cache: false,
                success: function (data) {
                    if (data){
                        alert('Senha Alterada com sucesso!')
                        window.location = "<?php echo base_url()?>";
                    }
                },
                error: function (d) {
                    alert('error')
                }
            });
        } else {
            alert('As senhas não coincidem!');
        }
    }
</script>

</body>
</html>
