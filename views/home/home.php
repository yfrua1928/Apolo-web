<?php
include 'views/header.php';
include 'views/menu.php';

// var_dump($GLOBALS);
?>

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Agendamiento </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-calendar-range"></i>
                </div>
                <div class="ps-3">
                  <?php foreach ($this->datosAd as $file) { ?>
                    <h6><?php echo $file['Total']; ?></h6>

                    <?php $TotalAd=$file['Total'];?>
                    <span class="text-success small pt-1 fw-bold"><?php echo $file['Confirmados']; ?></span> <span class="text-muted small pt-2 ps-1">Confirmados</span>
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['Cancelados']; ?></span> <span class="text-muted small pt-2 ps-1">Canceladas</span>
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['NoRespuestas']; ?></span> <span class="text-muted small pt-2 ps-1">Sin Respuesta</span>
                  <?php } ?>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

           

            <div class="card-body">
              <h5 class="card-title">Agenda No disponible </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-chat-dots"></i>
                </div>
                <div class="ps-3">
                <?php foreach ($this->datosAnd as $file) { ?>
                    <h6><?php echo $file['Total']; ?></h6>

                    <?php $TotalAnd=$file['Total'];?>
                    <span class="text-success small pt-1 fw-bold"><?php echo $file['Confirmados']; ?></span> <span class="text-muted small pt-2 ps-1">Confirmados</span>
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['Cancelados']; ?></span> <span class="text-muted small pt-2 ps-1">Canceladas</span>
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['NoRespuestas']; ?></span> <span class="text-muted small pt-2 ps-1">Sin Respuesta</span>
                  <?php } ?>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

            

            <div class="card-body">
              <h5 class="card-title">Confirmacion </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-clock-history"></i>
                </div>
                <div class="ps-3">
                <?php foreach ($this->datosC as $file) { ?>
                    <h6><?php echo $file['Total']; ?></h6>

                    <?php $TotalC=$file['Total'];?>
                    <span class="text-success small pt-1 fw-bold"><?php echo $file['Confirmados']; ?></span> <span class="text-muted small pt-2 ps-1">Confirmados</span>
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['Cancelados']; ?></span> <span class="text-muted small pt-2 ps-1">Canceladas</span>
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['NoRespuestas']; ?></span> <span class="text-muted small pt-2 ps-1">Sin Respuesta</span>
                  <?php } ?>
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

        <!-- Reports -->
        <div class="col-12">
          <div class="card">

         

            <div class="card-body">
              <h5 class="card-title">Reportes</h5>

              <!-- Line Chart -->
              <div id="reportsChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#reportsChart"), {
                    series: [{
                      name: 'Confirmacion',
                      data: [31, 40, 28, 51, 42, 82, 56],
                    }, {
                      name: 'Lsta Espera',
                      data: [11, 32, 45, 32, 34, 52, 41]
                    }, {
                      name: 'Agendamiento',
                      data: [15, 11, 32, 18, 9, 24, 11]
                    }],
                    chart: {
                      height: 350,
                      type: 'area',
                      toolbar: {
                        show: false
                      },
                    },
                    markers: {
                      size: 4
                    },
                    colors: ['#4154f1', '#2eca6a', '#ff771d'],
                    fill: {
                      type: "gradient",
                      gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'smooth',
                      width: 2
                    },
                    xaxis: {
                      type: 'datetime',
                      categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                    },
                    tooltip: {
                      x: {
                        format: 'dd/MM/yy HH:mm'
                      },
                    }
                  }).render();
                });
              </script>
              <!-- End Line Chart -->

            </div>

          </div>
        </div><!-- End Reports -->


      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">


      <!-- Website Traffic -->
      <div class="card">
       

        <div class="card-body pb-0">
          <h5 class="card-title">Sms Enviados</h5>

          <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
          <?php foreach ($this->datosXh as $file) { ?>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              echarts.init(document.querySelector("#trafficChart")).setOption({
                tooltip: {
                  trigger: 'item'
                },
                legend: {
                  top: '5%',
                  left: 'center'
                },
                series: [{
                  // name: ['General De Medellin','La Maria','Coraxon','Consejo Infantil'],
                  type: 'pie',
                  radius: ['40%', '70%'],
                  avoidLabelOverlap: false,
                  label: {
                    show: false,
                    position: 'center'
                  },
                  emphasis: {
                    label: {
                      show: true,
                      fontSize: '18',
                      fontWeight: 'bold'
                    }
                  },
                  labelLine: {
                    show: false
                  },
                  data: [{
                      value: <?php echo $file['HGM']; ?>,
                      name: 'HGM'
                    },
                    {
                      value: <?php echo $file['HLM']; ?>,
                      name: 'HLM'
                    },
                    {
                      value: <?php echo $file['COX']; ?>,
                      name: 'COX'
                    },
                    {
                      value: <?php echo $file['HCIM']; ?>,
                      name: 'HCI'
                    }
                  ]
                }]
              });
            });
          </script>

<?php } ?>
        </div>
      </div><!-- End Website Traffic -->

      <!-- News & Updates Traffic -->


    </div><!-- End Right side columns -->

  </div>
</section>


<?php
include 'views/footer.php';
