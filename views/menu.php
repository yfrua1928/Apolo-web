  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar" >

    <ul class="sidebar-nav" id="sidebar-nav">
      <?php
      require_once "utils/dataMenu.php";
      $rol = $_SESSION['rol'];
      
      foreach ($funcionales as $field) {
        if (in_array($rol, $field["permit"])) {
      ?>
          <li class="nav-item">
            <a class="nav-link " href="<?php echo constant('URL') . $field["module"] ?>">
              <i class="<?php echo $field["icon"] ?>"></i>
              <span><?php echo $field["title"] ?></span>
            </a>
          </li><!-- End Dashboard Nav -->
      <?php } } ?>

      <li class="nav-heading">Adicional</li>

      <?php 
      
      foreach ($adds as $add) {
      ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo constant('URL') . $add["module"] ?>">
          <i class="<?php echo $add["icon"] ?>"></i>
          <span><?php echo $add["title"] ?></span>
        </a>
      </li><!-- End information Nav -->

      <?php }  ?>
    </ul>
  </aside><!-- End Sidebar-->