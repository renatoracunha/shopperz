
<?php 
if(!empty($_SESSION['user_id']))
  $usuario_id = $_SESSION['user_id']; 
//print_r($_SESSION);exit;
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



</head>
<body>


  <style type="text/css">
   .title{
    color: white;
    text-align: center;
  }
  #pesquisar_palavra {
    border-radius: 15px;
    border: none;
    text-align: center;
  }

  .card_img{
    margin-top: 50px;    
    width: 100%;
    background-color: white;
  }
  .card-img-top{
    color: black;
    font-size: 10em;
  }
  .card_btn{
    width: 100%;
    background-color: #F7819F;
  }
  .btn_select{
    width: 150%;
    border-color: gray;
    color: black;
    background-color: white;   
  }
  .btn_select:focus {
    background-color: #A9A9A9;
    box-shadow: 0 5px #FF0000;
    transform: translateY(4px);
  }
  .btn_select:active {
    background-color: #A9A9A9;
    box-shadow: 0 5px #FF0000;
    transform: translateY(4px);
  }
  .btn-group {
    width: 100%;
    padding-top: 30px;
  }
  /*input pesquisar*/
  @import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");

  .search {
    margin: 0 auto;
  }

  .search > h3 {
    font-weight: normal;
  }
  /* .search > div {
    display: inline-block;
    position: relative;
  } */

  .search > div:after {
    content: "";
    background: white;
    width: 4px;
    height: 20px;
    /* position: absolute; */
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
  .login100-form-btn{
    border-radius: 0;
  }
</style>
</head>
<body>
  <div id="header">
    <?php $this->load->view('menu.php') ?>
  </div>
  <div class="limiter">
    <div class="container-login100" style="background-image: url('<?php echo site_url(); ?>/imagens/bg-01.jpg');">
      <div>
        <div class="search" >
          <div>
            <input id="input_pesquisar"  onkeyup="pesquisar_loja(this.value)" type="text" placeholder="       Pesquisar lojas . . ." required>
          </div>
        </div>
      </div>
      <br>
      <br>
      <br>
      <div class="wrap-login100  p-b-5">
      <div class="btn-group" role="group" style="margin-bottom: 3%;">
        <select class="" onchange='get_tipo_produto(this.value)'  id="tipo_de_produto">
          <option disabled selected>Tipo</option>
          <?php 
          foreach ($tipos_produtos as $produto) {
            echo "<option  value=".$produto['id'].">".$produto['descricao']."</option>";
          }
          ?>
        </select>
        <button type="button" class="login100-form-btn" onclick="get_lojas_populares()" >Em Alta</button>
        <?php
        if (!empty($usuario_id)) {
          echo'<button type="button" id="btn_favoritos" class="login100-form-btn" onclick="get_favoritos()" >Favoritos</button>';
        } 
        ?>
      </div>
      <div id="lojas"></div>
    </div>
  </div><!--Fim container-->
</div><!--Fim limiter-->
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
  function get_view_produtos_loja(id_loja){
    window.location.href = "<?php echo base_url('gupy/listar_produtos/') ?>/"+id_loja; 
  }
  $(document).ready(function(){
    loadData();
      //$('#pesquisar_palavra').hide();
    });
  function loadDataInApp(value){

    var lines = '';
    lines+='<div onclick="get_view_produtos_loja('+value.id+')" class="card card_img" >';

    lines+='<img class="card-img-top" style="width: 100%" src="../imagens/'+value.img+'" alt="Imagem de capa do card"></div>'; 

    return lines;
  }

  function loadData(){
    $.ajax({
      url: "<?php echo site_url();?>gupy/ajax_get_listar_lojas_ativas",
      dataType:"json",
      type:"get",
      cache:false,
      success:function(data){
        var lines = '';
        $.each(data,function(index,value){
          lines+= loadDataInApp(value);

        });

        if (lines) {
          $("#lojas").html('');
          $("#lojas").append(lines);
          if (Object.keys(data).length==1) {
            $('#lojas').css('margin-bottom','65%');
          }else{
            $('#lojas').css('margin-bottom','5%');
          }
        }else{
          alert('não há produtos cadastrados');
        }
      },error:function(e){
        alert('errorr');
      }
    })
  }

  function get_favoritos(){
    $.ajax({
      url: "<?php echo site_url();?>gupy/ajax_get_lojas_favoritas_usuario",
      dataType:"json",
      type:"get",
      cache:false,
      success:function(data){
        var lines = '';
        $.each(data,function(index,value){
          lines+= loadDataInApp(value);
        });

        if (lines) {
          $("#lojas").html('');
          $("#lojas").append(lines);
          if (Object.keys(data).length==1) {
            $('#lojas').css('margin-bottom','65%');
          }else{
            $('#lojas').css('margin-bottom','5%');
          }
        }else{
          alert('não há produtos cadastrados');
        }
      },
      error:function(e){
        alert('erro');
      }
    })
  }


    function get_lojas_populares(){
      $.ajax({
        url: "<?php echo site_url();?>gupy/ajax_get_lojas_populares",
        dataType:"json",
        type:"get",
        cache:false,
        success:function(data){
         var lines = '';
         $.each(data,function(index,value){
          lines+= loadDataInApp(value);
        });

         if (lines) {
          $("#lojas").html('');
          $("#lojas").append(lines);
          if (Object.keys(data).length==1) {
            $('#lojas').css('margin-bottom','65%');
          }else{
            $('#lojas').css('margin-bottom','5%');
          }
        }else{
          alert('não há produtos cadastrados');
        }
      },
      error:function(e){
        alert('erro');
      }
    })
    }

   /* function get_produtos_descontos(){
     $.ajax({
      url: "<?php echo site_url();?>gupy/ajax_get_produtos_descontos",
      dataType:"json",
      type:"get",
      cache:false,
      success:function(data){
        var lines = '';
        $.each(data,function(index,value){
          lines+= loadDataInApp(value);
        });

        if (lines) {
          $("#lojas").html('');
          $("#lojas").append(lines);
        }else{
          alert('não há produtos cadastrados');
        }
      },error:function(e){
        alert('erro');
      }
    })
  }*/

  function pesquisar_loja(nome){
    $.ajax({
      url: "<?php echo site_url();?>gupy/ajax_get_loja_by_nome",
      dataType:"json",
      data:{nome:nome},
      type:"get",
      cache:false,
      success:function(data){
        var lines = '';
        $.each(data,function(index,value){
          lines+= loadDataInApp(value);
        });

        if (lines) {
          $("#lojas").html('');
          $("#lojas").append(lines);
          if (Object.keys(data).length==1) {
            $('#lojas').css('margin-bottom','65%');
          }else{
            $('#lojas').css('margin-bottom','5%');
          }
        }else{
          alert('nenhuma loja encontrada');
        }
      },error:function(e){
        alert('erro');
      }
    })
  }

  function get_tipo_produto(tipo_id){

   $.ajax({
    url: "<?php echo site_url();?>gupy/ajax_get_loja_by_tipo",
    dataType:"json",
    data:{tipo_id:tipo_id},
    type:"get",
    cache:false,
    success:function(data){

      var lines = '';
      $.each(data,function(index,value){
        lines+= loadDataInApp(value);
      });

      if (lines) {
        $("#lojas").html('');
        $("#lojas").append(lines);
        if (Object.keys(data).length==1) {
          $('#lojas').css('margin-bottom','65%');
        }else{
          $('#lojas').css('margin-bottom','5%');
        }
      }else{
        alert('nenhuma loja encontrada');
      }
    },error:function(e){
      alert('erro');
    }
  })
 }
</script>



</body>
</html>