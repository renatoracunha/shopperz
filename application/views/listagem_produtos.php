
<?php $usuario_id = 1 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css') ?>">
  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="<?php echo base_url('js/jquery.js') ?>"></script>
  <script src="<?php echo base_url('js/popper.js') ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.js') ?>"></script>
  <script src="https://kit.fontawesome.com/8d24bc018e.js"></script>

  <title>Shopperz!</title>


  <script>
    function get_view_produto(id_produto){
      window.location.href = "<?php echo base_url('shopperz/produto_view/') ?>/"+id_produto; 
    }
    $(document).ready(function(){
      loadData();
      //$('#pesquisar_palavra').hide();
    });
    function loadDataInApp(value){

      var lines = '';
      lines+='<div onclick="get_view_produto('+value.id+')" class="card card_img" >';
      
      lines+=value.nome+'-R$'+value.preco+'<img class="card-img-top" style="width: 100%" src="<?php echo base_url('imagens') ?>/'+value.img+'" alt="Imagem de capa do card"></div>'; 
      
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
          //console.log(data.favorita);
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
<body style="background-color: #3761a3">
  <div style="margin-bottom: 2%" id="header">
    <?php $this->load->view('menu.php') ?>
  </div>

  <div class="container">

    <div class="row">
      <div class="search">
        <div>
          <input onkeyup="pesquisar_produto(this.value)" type="text" placeholder="       Pesquisar produto . . ." required>
        </div>
      </div>
     <!-- <div class="btn-group" role="group" aria-label="Exemplo básico">
        <button type="button" onclick="get_produtos_descontos()" class="btn btn-secondary btn_select">Descontos</button>
        <button type="button" onclick="get_produtos_populares()" class="btn btn-secondary btn_select">Em Alta</button>
        <button type="button" onclick="get_favoritos()" class="btn btn-secondary btn_select">Favoritos</button>
      </div>-->
      <div class="row" id="produtos"></div>
      <!-- botão favoritar -->
    <div id="div_favButton"></div>
    </div>
  </div>
</div><!--Fim container-->


<script type="text/javascript">			
	
    // This is the "Offline page" service worker

    // Add this below content to your HTML page, or add the js file to your page at the very top to register service worker

    // Check compatibility for the browser we're running this in
    if ("serviceWorker" in navigator) {
      if (navigator.serviceWorker.controller) {
        console.log("[PWA Builder] active service worker found, no need to register");
      } else {
            // Register the service worker
            navigator.serviceWorker
            .register("./pwabuilder-sw.js")
            .then(function (reg) {
              console.log("[PWA Builder] Service worker has been registered for scope: " + reg.scope);
            });
          }
        }	
      </script>
    </body>
    </html>