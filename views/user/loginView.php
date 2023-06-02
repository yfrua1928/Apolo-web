<form method="POST">
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card">
          <div class="card-body p-5 text-center ">
            <p class="login-form-font-header"><img src="<?php echo PATH_IMG;?>logo_trami.jpg"><p>
            <h4 class="mb-5">Bienvenido. Por favor inicie sesión.<hr></h4>

            <div class="form-outline mb-4">
              <input type="text" class="form-control form-control-lg" name="txtUser" id="txtUser" placeholder="Usuario"/>
            </div>

            <div class="form-outline mb-4">
              <input type="password" class="form-control form-control-lg" name="txtPassword" id="txtPassword" placeholder="Contraseña" />
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-success text-white ">Iniciar Sesión</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
