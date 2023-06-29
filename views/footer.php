<?php
//echo 'este es el footer';
?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    Creado con <i class="bi bi-heart"></i> para <strong><span>Tramisalud</span></strong>. Todos los Derechos Reservados
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Tools -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="assets/libs/jquery/jquery-3.7.0.min.js" type="text/javascript"></script>
<script src="assets/libs/datatable/datatables.min.js" type="text/javascript"></script>

<!-- Libreria de Estilos -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/utils.js?v1" type="text/javascript"  ></script>
<!-- <script src="assets/js/main.js?v1" type="module"  ></script> -->

<!-- Personal Templeate JS File-->
<?php 
echo (isset ($this->pathJs))?"<script type='module'>
        import { $this->pathJs } from './assets/js/".$GLOBALS['URL'].".js';
        let ".$GLOBALS['URL']." = new {$this->pathJs}();
</script>":"";
?>

<!-- Librerias de graficos -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/libs/chart.js/chart.umd.js"></script>
<script src="assets/libs/echarts/echarts.min.js"></script>

</body>

</html>