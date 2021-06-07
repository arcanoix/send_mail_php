<?php
session_start(); 
error_reporting(E_ERROR | E_PARSE);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <title>Envio de Mail</title>
  </head>
  <body>
   
    <div class="container">

            <?php if(!empty($_REQUEST["statusMsg"])) { ?>
              <div class="row mt-4 mb-3">
                 <p class="alert alert-success"><?php echo $_REQUEST["statusMsg"]; ?></p>
              </div>
            <?php } ?>

       <div class="row mt-3">
        <div class="card">
            <div class="card-header">
              Envio de email
            </div>
            <div class="card-body">
                <form action="./assets/sendmail.php" class="row g-3 requires-validation" method="post" id="myform" enctype="multipart/form-data" novalidate>
                    <div class="mb-3">
                        <label for="to" class="form-label">De</label>
                        <input type="email" class="form-control" id="de" name="to" placeholder="name@example.com" required>
                          <div class="invalid-feedback">
                            El campo De es requerido
                          </div>
                    </div>
                    <div class="mb-3">
                        <label for="from" class="form-label">Para</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="from" placeholder="name@example.com" required>
                        <div class="invalid-feedback">
                          El campo Para es obligatorio
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Titulo</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titulo" required>
                        <div class="invalid-feedback">
                          El campo Titulo es obligatorio
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" rows="3" name="message" required></textarea>
                        <div class="invalid-feedback">
                          EL campo Mensaje es obligatorio
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Adjutar archivo</label>
                        <input class="form-control form-control-sm" id="attachment" type="file" name="attachment" />
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary" type="submit" > <i class="fas fa-mail-bulk"></i>Enviar</button>
                        <a href="/sendmail/" class="btn btn-success">Refrescar</a>
                        
                    </div>
                </form>
            </div>
          </div>
       </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="/assets/js/popper.min.js" ></script>
    <script src="/assets/js/bootstrap.min.js"></script>
               <script>
                 (function () {
                  'use strict'
                  const forms = document.querySelectorAll('.requires-validation')
                  Array.from(forms)
                    .forEach(function (form) {
                      form.addEventListener('submit', function (event) {
                      if (!form.checkValidity()) {
                          event.preventDefault()
                          event.stopPropagation()
                      }
                        form.classList.add('was-validated')
                      }, false)
                    })
                  })()
               </script>
  </body>
</html>