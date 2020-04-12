<?php
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Gupy Checkout</title>
	    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>/imagens/icons/favicon.ico"/>
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <style>
            .botao{
                height: 30px;
                width: 30px;
                padding: unset;
                margin-top: 10px;
            }
            div > h6{
                font-size: 12px;
            }
        </style>
    </head>

    <body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <!-- <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
            <h2>Finalizar Compra</h2>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Carrinho</span>
                    <span id="qtd_produtos" class="badge badge-secondary badge-pill"><?php echo count($produtos_info);?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                        foreach ($produtos_info as $key => $value) {?>
                        
                            <li id="<?php echo $key?>" class="list-group-item d-flex justify-content-between">
                                <div>
                                    <h6 class="my-3"><?php echo $value['nome']?></h6>
                                    
                                </div>
                                <button id="<?php echo "qtd".$key?>" class="btn btn-light botao" onclick="diminuir()">-</button><h6 class="my-3">4</h6><button class="btn btn-light botao" onclick="aumentar()">+</button>
                                <span id="<?php echo "precoTotalItem".$key?>" class="text-muted my-3"><?php echo "R$".$value['precoTotalItem']?></span>
                                <button class="btn btn-light botao" onclick="remover('<?php echo $key?>')"><span class="material-icons">delete</span></button>
                            </li>
                    <?php
                        }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (R$)</span>
                        <strong id="precoTotalCompra"><?php echo "R$".$precoTotalCompra;?></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Informações do Comprador</h4>
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" value="<?php echo $user_info['NOME'] ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email <span class="text-muted"></span></label>
                            <input type="email" class="form-control" id="email" value="<?php echo $user_info['EMAIL'] ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefone">Telefone <span class="text-muted"></span></label>
                            <input type="text" class="form-control" id="telefone" value="<?php echo $user_info['TELEFONE'] ?>" disabled>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="button" onclick="">finalizar compra</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script>

        function remover(id){
            let confirma = confirm("Realmente deseja exlcluir o item?");
            alert(confirma);
            if(confirma){
                document.getElementById(''+id).remove();
                $.ajax({
                    url: "<?php echo base_url();?>gupy/ajax_remover_item",
                    dataType: "json",
                    type: "post",
                    data: {id:id},
                    cache: false,
                    success: function(data){
                        console.log(data);
                        let qtd_produtos = data.qtd_produtos;
                        if(qtd_produtos == 0){
                            window.location.href = '/gupy/main'
                        } else {
                            $('#qtd_produtos').val(qtd_produtos);
                            $('#precoTotalCompra').val(data.precoTotalCompra);
                        }
                    },
                    error: function(d){
                        alert();
                    }
                });
            }
        }
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>