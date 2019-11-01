<?php 
//$usuario_id = $_SESSION['user_id'];
//$admin = $_SESSION['admin'];
?>

<nav class="navbar navbar-dark bg-dark ">
  <!-- Conteúdo do navbar -->
  
  <button class="btn btn-sm btn-dark" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php if ($_SESSION['user_tipo']==2) {
    ?>
    <a id="brand" class="navbar-brand" href="<?php echo site_url('shopperz/main');?>"><?php echo $_SESSION['user_name'] ?></a>
  <?php
  } else{?>
  <a id="brand" class="navbar-brand" href="<?php echo site_url('shopperz/main');?>">Shopperz</a>
  <?php 
    }
  ?>  

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <?php if ($_SESSION['user_tipo']==2) {
       
       ?>      
      <li id="li_adm" class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Opções de administrador
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url("shopperz/cadastrarProduto")?>">Cadastrar Produto</a>
          <a class="dropdown-item" href="<?php echo site_url("shopperz/editarProduto")?>">Editar Produto</a>
          <a class="dropdown-item" href="<?php echo site_url("shopperz/gerenciarVendas")?>">Gerenciar Vendas</a>
        </div>
      </li>  
      <?php
    }else{ ?>
     <li class="nav-item active">
      <a class="nav-link" href="<?php echo site_url('shopperz/main');?>">Listar Parceiras</a>
    </li>
      <li id="li_adm" class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Opções de usuário
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url("shopperz/perfil")?>">Perfil</a>
          <a class="dropdown-item" href="<?php echo site_url("shopperz/codigo")?>">Compartilhar Código</a>
          
        </div>
      </li>
    <?php
     }
    ?> 
    <li class="nav-item active">
      <a class="nav-link" href="<?php echo site_url()?>">Sair</a>
    </li>   
  </ul> 
  </div>   
</nav>

<script type="text/javascript">

  /*$(document).ready(function(){
    get_usuario();
  });

  function pesquisar_palavra(){
    nome = $('#pesquisar_palavra').val();
    $.ajax({
      url: "<?php echo site_url();?>arqlibras/ajax_get_pesquisar",
      dataType:"json",
      type:"get",
      data:{nome:nome},
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
          alert('não há vídeos cadastrados');
        }
      },
      error:function(e){
        alert('erro');
      }
    });

  }

  function get_usuario(){
      //console.log(<?php echo $usuario_id ;?>);
     // let usuario_id = ;
     $.ajax({
      url: "<?php echo site_url();?>arqlibras/ajax_get_info_usuarios",
      dataType:"json",
      type:"get",
      data:{usuario_id:<?php echo $usuario_id ; ?>},
      cache:false,
      success:function(data){
        if (data.admin !='T') {
          $('#li_adm').hide();
          $('#btn_search').hide();
        }
      },
      error:function(e){
        alert('erro');
      }
    });
   }*/
 </script>
