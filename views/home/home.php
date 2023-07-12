<?php
include 'views/header.php';
include 'views/menu.php';

// var_dump($GLOBALS);
?>

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-3 col-md-6">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Agendamiento </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-calendar-range"></i>
                </div>
                <div class="ps-3 row">
                  <?php foreach ($this->datosAd as $file) { ?>
                    <h5><?php echo $file['Total']; ?></h5>
                    <span class="text-muted small pt-1 fw-bold"><?php echo $file['CanceladosXenvio']; ?><a class="text-muted small pt-4 ps-1">-Pendiente De Envio</a></span> 
                    <span class="text-success small pt-1 fw-bold w-100"><?php echo $file['Confirmados']; ?><a class="text-muted small pt-4 ps-1">-Confirmados</a></span> 
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['Cancelados']; ?><a class="text-muted small pt-4 ps-1">-Canceladas Por Usuario</a></span> 
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['CanceladosXnoRespuesta']; ?><a class="text-muted small pt-4 ps-1">-Canceladas Por No Respuesta</a></span> 
                    <span class="text-muted small pt-1 fw-bold"><?php echo $file['NoRespuestas']; ?><a class="text-muted small pt-4 ps-1">-Sin Respuesta</a></span> 
                  <?php } ?>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Customers Card -->
        <div class="col-xxl-3 col-md-6">

          <div class="card info-card revenue-card">



            <div class="card-body">
              <h5 class="card-title">Confirmacion </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-clock-history"></i>
                </div>
                <div class="ps-3 row">
                  <?php foreach ($this->datosC as $file) { ?>
                    <h5><?php echo $file['Total']; ?></h5>
                    <span class="text-muted small pt-1 fw-bold"><?php echo $file['CanceladosXenvio']; ?><a class="text-muted small pt-4 ps-1">-Pendiente De Envio</a></span> 
                    <span class="text-success small pt-1 fw-bold w-100"><?php echo $file['Confirmados']; ?><a class="text-muted small pt-4 ps-1">-Confirmados</a></span> 
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['Cancelados']; ?><a class="text-muted small pt-4 ps-1">-Canceladas Por Usuario</a></span> 
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['CanceladosXnoRespuesta']; ?><a class="text-muted small pt-4 ps-1">-Canceladas Por No Respuesta</a></span> 
                    <span class="text-muted small pt-1 fw-bold"><?php echo $file['NoRespuestas']; ?><a class="text-muted small pt-4 ps-1">-Sin Respuesta</a></span> 
                  <?php } ?>
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->
        <!-- Customers Card -->
        <div class="col-xxl-3 col-md-6">

          <div class="card info-card customers-card">



            <div class="card-body">
              <h5 class="card-title">Lista Espera </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-phone"></i>
                </div>
                <div class="ps-3 row">
                  <?php foreach ($this->datosLE as $file) { ?>
                    <h5><?php echo $file['Total']; ?></h5>
                    <span class="text-success small pt-1 fw-bold w-100"><?php echo $file['HGM']; ?><a class="text-muted small pt-4 ps-1">-HGM</a></span> 
                    <span class="text-success small pt-1 fw-bold"><?php echo $file['HLM']; ?><a class="text-muted small pt-4 ps-1">-HLM</a></span> 
                    <span class="text-success small pt-1 fw-bold"><?php echo $file['COX']; ?><a class="text-muted small pt-4 ps-1">-COX</a></span> 
                    <span class="text-success small pt-1 fw-bold"><?php echo $file['HVDD']; ?><a class="text-muted small pt-4 ps-1">-HVDD</a></span> 
                    <span class="text-success small pt-1 fw-bold"><?php echo $file['HCIM']; ?><a class="text-muted small pt-4 ps-1">-HCIM</a></span> 
                  <?php } ?>
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-3 col-md-6">
          <div class="card info-card info-card">



            <div class="card-body">
              <h5 class="card-title">Agenda No disponible </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-chat-dots"></i>
                </div>
                <div class="ps-3 row">
                  <?php foreach ($this->datosAnd as $file) { ?>
                    <h5><?php echo $file['Total']; ?></h5>
                    <span class="text-danger small pt-1 fw-bold w-100"><?php echo $file['HGM']; ?><a class="text-muted small pt-4 ps-1">-HGM</a></span> 
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['HLM']; ?><a class="text-muted small pt-4 ps-1">-HLM</a></span> 
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['COX']; ?><a class="text-muted small pt-4 ps-1">-COX</a></span> 
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['HVDD']; ?><a class="text-muted small pt-4 ps-1">-HVDD</a></span> 
                    <span class="text-danger small pt-1 fw-bold"><?php echo $file['HCIM']; ?><a class="text-muted small pt-4 ps-1">-HCIM</a></span> 
                  <?php } ?>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        
        <!-- Reports -->
        <div class="col-12">
          <div class="card">



            <div class="card-body">
              <h5 class="card-title">Reportes X semana de mensajes enviados</h5>

              <div id="reportsChart"></div>

              <?php foreach ($this->SmsXh as $file) { ?>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#reportsChart"), {
                    series: [{ 
                      name: 'HGM',
                      data: [ <?php echo $file['S1HGM']; ?>, <?php echo $file['S2HGM'];?>, <?php echo $file['S3HGM']; ?>, <?php echo $file['S4HGM']; ?>]
                    }, {
                      name: 'HLM',
                      data: [<?php echo $file['S1HLM']; ?>, <?php echo $file['S2HLM']; ?>, <?php echo $file['S3HLM']; ?>, <?php echo $file['S4HLM']; ?>]
                    }, {
                      name: 'COX',
                      data: [<?php echo $file['S1COX']; ?>,<?php echo $file['S2COX']; ?>, <?php echo $file['S3COX']; ?>, <?php echo $file['S4COX']; ?>]
                    }, {
                      name: 'HVDD',
                      data: [<?php echo $file['S1HVDD']; ?>,<?php echo $file['S2HVDD']; ?>, <?php echo $file['S3HVDD']; ?>, <?php echo $file['S4HVDD']; ?>]
                    }, {
                      name: 'HCIM',
                      data: [<?php echo $file['S1HCIM']; ?>,<?php echo $file['S2HCIM']; ?>, <?php echo $file['S3HCIM']; ?>, <?php echo $file['S4HCIM']; ?>]
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
                    colors: ['#4154f1', '#2eca6a', '#B8290A', '#870EE0', '#ff771d'],
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
                      type: 'date',
                      categories: ["  Semana 1-Total: <?php echo $file['S1Total'];?>","Semana 2-Total: <?php echo $file['S2Total'];?>", "Semana 3-Total: <?php echo $file['S3Total'];?>", "Semana 4-Total: <?php echo $file['S4Total'];?>"]
                    },
                    tooltip: {
                      x: {
                        format: 'dd/MM/yy HH:mm'
                      },
                    }
                  }).render();
                });
              </script>
<?php } ?>

            </div>

          </div>
        </div>


      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-6">


<!-- Website Traffic -->
<div class="card">


  <div class="card-body pb-0">
    <h5 class="card-title">Sms de Confirmacion X Hospital</h5>

    <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
    <?php foreach ($this->ConfirmacionXh as $file) { ?>
            <h5>Total de mensajes: <?php echo $file['Total']; ?></h5>
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
                  name: 'HCIM'
                },
                {
                  value: <?php echo $file['HVDD']; ?>,
                  name: 'HVDD'
                }
              ]
            }]
          });
        });
      </script>

    <?php } ?>
  </div>
</div>

</div><!-- End Right side columns -->


    <div class="col-lg-6">


      <!-- Website Traffic -->
      <div class="card">


        <div class="card-body pb-1">
          <h5 class="card-title">Sms de Agendamiento X Hospital</h5>

          <div id="trafficChart1" style="min-height: 400px;" class="echart"></div>
          <?php foreach ($this->AgendamientoXh as $file) { ?>
            <h5>Total de mensajes: <?php echo $file['Total']; ?></h5>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                echarts.init(document.querySelector("#trafficChart1")).setOption({
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
                        name: 'HCIM'
                      },
                      {
                        value: <?php echo $file['HVDD']; ?>,
                        name: 'HVDD'
                      }
                    ]
                  }]
                });
              });
            </script>

          <?php } ?>
        </div>
      </div>
    </div>

 
    </div><!-- End Right side columns -->

  </div>
</section>


<?php
include 'views/footer.php';
