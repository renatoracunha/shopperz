
<?php
$usuario_id = $_SESSION['user_id'] ;
?>
<!DOCTYPE html>
<html lang="pt-br">
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
  .container{
    text-align: center;
    align-items: center;
  }
  .card_img{
    margin-top: 50px;    
    width: 100%;
    background-color: #808080;
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
      <div style="margin-bottom: 5%" class="search">
        <div>
          <input onkeyup="pesquisar_produto(this.value)" type="text" placeholder="       Pesquisar produto . . ." required>
        </div>
      </div>
      <div class="wrap-login100  p-b-33">
        <div style="margin-bottom: 70%" id="produtos"></div>
      </div>
      <!-- botão favoritar -->
      <div id="div_favButton"></div>
    </div>
  </div>
</div><!--Fim container-->


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
  function get_view_produto(id_produto){
    let loja_id = "<?php echo $loja_id; ?>";
    window.location.href = "<?php echo base_url('shopperz/produto_view/') ?>/"+id_produto+"/"+loja_id; 
  }
  $(document).ready(function(){
    loadData();
      //$('#pesquisar_palavra').hide();
    });
  function loadDataInApp(value){
    let img = value.img.replace('C:\\fakepath\\','');
    var lines = '';
    lines+='<div style="text-align: center" onclick="get_view_produto('+value.id+')" class="card card_img" >';

    lines+=value.nome+'-R$'+value.preco+'<img class="card-img-top" style="width: 100%" src="<?php echo base_url('imagens') ?>/'+img+'" alt="Imagem de capa do card"></div>'; 

    return lines;
  }

  function loadData(){
    $.ajax({
      url: "<?php echo site_url();?>shopperz/ajax_get_listar_produtos",
      dataType:"json",
      data:{loja_id:<?php echo $loja_id ; ?>},
      type:"get",
      cache:false,
      success:function(data){
          console.log(data);

          var lines = '';
          $.each(data.produtos,function(index,value){
            lines+= loadDataInApp(value);
          });

          if (data.favorita) {

            $('#div_favButton').append('<button onclick="status_desfav()" class="btn btn-danger btnFav">f</button>');
          }else{
            $('#div_favButton').append('<button onclick="status_fav()" class="btn btn-primary btnFav">f</button>');
          }

          if (lines) {
            $("#produtos").html('');
            $("#produtos").append(lines);
            if (Object.keys(data.produtos).length==1) {
              $('#produtos').css('margin-bottom','65%');
            }else{
              $('#produtos').css('margin-bottom','5%');
            }
          }else{
            alert('não há produtos cadastrados');
          }
        },error:function(e){
          alert('errorr');
        }
      })
  }

   /* function get_favoritos(){
      $.ajax({
        url: "<?php echo site_url();?>shopperz/ajax_get_favoritos",
        dataType:"json",
        data:{usuario_id:<?php echo $usuario_id ; ?>},
        type:"get",
        cache:false,
        success:function(data){
          var lines = '';
          $.each(data,function(index,value){
            lines+= loadDataInApp(value);
          });

          if (lines) {
            $("#palavras").html('');
            $("#palavras").append(lines);
          }else{
            alert('Você não favoritou nenhuma palavra ainda!');
          }
        },
        error:function(e){
          alert('erro');
        }
      })
    }*/

    /*function abrirPesquisa(){
      $('#brand').toggle();     
      $('#pesquisar_palavra').toggle();                   
    }    */


  /*  function get_palavras_populares(){
      $.ajax({
        url: "<?php echo site_url();?>shopperz/ajax_get_produtos_populares",
        dataType:"json",
        type:"get",
        cache:false,
        success:function(data){
          var lines = '';
          $.each(data,function(index,value){
            lines+= loadDataInApp(value);
          });

          if (lines) {
            $("#produtos").html('');
            $("#produtos").append(lines);
          }else{
            alert('não há vídeos cadastrados');
          }
        },error:function(e){
          alert('erro');
        }
      })
    }

    function get_produtos_descontos(){
     $.ajax({
      url: "<?php echo site_url();?>shopperz/ajax_get_produtos_descontos",
      dataType:"json",
      type:"get",
      cache:false,
      success:function(data){
        var lines = '';
        $.each(data,function(index,value){
          lines+= loadDataInApp(value);
        });

        if (lines) {
          $("#produtos").html('');
          $("#produtos").append(lines);
        }else{
          alert('não há vídeos cadastrados');
        }
      },error:function(e){
        alert('erro');
      }
    })
  }*/
  function pesquisar_produto(nome){
    $.ajax({
      url: "<?php echo site_url();?>shopperz/ajax_get_produto_by_nome",
      dataType:"json",
      data:{loja_id:<?php echo $loja_id ; ?>,nome:nome},
      type:"get",
      cache:false,
      success:function(data){
        var lines = '';
        $.each(data,function(index,value){
          lines+= loadDataInApp(value);
        });

        if (lines) {
          $("#produtos").html('');
          $("#produtos").append(lines);
          if (Object.keys(data).length==1) {
            $('#produtos').css('margin-bottom','65%');
          }else{
            $('#produtos').css('margin-bottom','5%');
          }
        }else{
          alert('nenhum produto encontrado');
        }
      },error:function(e){
        alert('erro');
      }
    })
  }


  function status_fav(){
    $.ajax({
      url: "<?php echo site_url();?>shopperz/ajax_usuario_favoritar_loja",
      dataType:"json",
      cache:false,
      type:"get",
      data:{ usuario_id:<?php echo $_SESSION['user_id'] ?>,loja_id:<?php echo $loja_id ?>},
      success: function(data){
        $('#div_favButton').html('');
        $('#div_favButton').append('<button onclick="status_desfav()" class="btn btn-danger btnFav">F</button>');
      },
      error:function(e){
        alert('erro');
      }
    });
  }

  function status_desfav(){
    $.ajax({
      url: "<?php echo site_url();?>shopperz/ajax_usuario_desfavoritar_loja",
      dataType:"json",
      cache:false,
      type:"get",
      data:{usuario_id:<?php echo $_SESSION['user_id'] ?>,loja_id:<?php echo $loja_id ; ?>},
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
</body>
</html>