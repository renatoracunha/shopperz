
<?php $usuario_id = $_SESSION['user_id'] ?>
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
    function get_view_produtos_loja(id_loja){
      window.location.href = "<?php echo base_url('shopperz/listar_produtos/') ?>/"+id_loja; 
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
        url: "<?php echo site_url();?>shopperz/ajax_get_listar_lojas_ativas",
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
          alert('errorr');
        }
      })
    }

    function get_favoritos(){
      $.ajax({
        url: "<?php echo site_url();?>shopperz/ajax_get_lojas_favoritas_usuario",
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
        },
        error:function(e){
          alert('erro');
        }
      })
    }

    /*function abrirPesquisa(){
      $('#brand').toggle();     
      $('#pesquisar_palavra').toggle();                   
    }    */


    function get_lojas_populares(){
      $.ajax({
        url: "<?php echo site_url();?>shopperz/ajax_get_lojas_populares",
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
        },
        error:function(e){
          alert('erro');
        }
      })
    }

   /* function get_produtos_descontos(){
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
      url: "<?php echo site_url();?>shopperz/ajax_get_loja_by_nome",
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
      url: "<?php echo site_url();?>shopperz/ajax_get_loja_by_tipo",
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
        }else{
          alert('nenhuma loja encontrada');
        }
      },error:function(e){
        alert('erro');
      }
    })
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
  <div id="header">
    <?php $this->load->view('menu.php') ?>
  </div>

  <div class="container">

    <div class="row">
      <div class="btn-group" role="group" style="margin-bottom: 3%">
      <select onchange='get_tipo_produto(this.value)' class="form-control" id="tipo_de_produto">
        <option disabled selected>Tipo</option>
          <?php 
            foreach ($tipos_produtos as $produto) {
              echo "<option  value=".$produto['id'].">".$produto['descricao']."</option>";
            }
          ?>
        </select>
        <button type="button" onclick="get_lojas_populares()" class="btn btn-secondary btn_select">Em Alta</button>
        <button type="button" onclick="get_favoritos()" class="btn btn-secondary btn_select">Favoritos</button> 
      </div>
      <div class="search" >
        
        <div>

          <input id="input_pesquisar" onkeyup="pesquisar_loja(this.value)" type="text" placeholder="       Pesquisar lojas . . ." required>
        </div>
      </div>
      <div id="lojas"></div>
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