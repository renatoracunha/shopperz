<?php
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">
        <title>Gupy Checkout</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="../../vendor/bootstrap/css/bootstrap.min.css">
        <!-- Custom styles for this template -->
        <link href="form-validation.css" rel="stylesheet">
    </head>

    <body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h2>Checkout form</h2>
            <p class="lead">
                <?php //print_r($dados);?>
                <?php //print_r($user_info);exit;?>
                <?php //print_r($produtos_info);?>
            </p>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Carrinho</span>
                    <span class="badge badge-secondary badge-pill"><?php echo count($dados);?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                        foreach ($produtos_info as $key => $value) {
                            foreach ($value as $key2 => $value2) {?>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0"><?php echo $value2['NOME']." x".$dados[$key]['quantidade']?></h6>
                                    </div>
                                    <span class="text-muted">$12</span>
                                </li>
                    <?php
                            }
                        }
                    ?>
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
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>

      <!-- <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer> -->
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
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