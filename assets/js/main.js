
async function getToken() {
  try {
    let response = await axios.post("https://apolo.tramisalud.com/Api/Login").catch(err => {throw err;});
    return await response.data.accessToken;
  } catch (err) {
    return null;
  }
}

function arrayObjToCsv(ar, name) {
  //comprobamos compatibilidad
  if (window.Blob && (window.URL || window.webkitURL)) {
      var contenido = "",
          d = new Date(),
          blob,
          reader,
          save,
          clicEvent;
      //creamos contenido del archivo
      for (var i = 0; i < ar.length; i++) {
          //construimos cabecera del csv
          if (i == 0)
              contenido += Object.keys(ar[i]).join(";") + "\n";
          //resto del contenido
          contenido += Object.keys(ar[i]).map(function(key) {
              return ar[i][key];
          }).join(";") + "\n";
      }
      //creamos el blob
      blob = new Blob(["\ufeff", contenido], { type: 'text/csv' });
      //creamos el reader
      var reader = new FileReader();
      reader.onload = function(event) {
              //escuchamos su evento load y creamos un enlace en dom
              save = document.createElement('a');
              save.href = event.target.result;
              save.target = 'blank';
              //aquí le damos nombre al archivo
              save.download = name + d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear() + ".csv";
              try {
                  //creamos un evento click
                  clicEvent = new MouseEvent('click', {
                      'view': window,
                      'bubbles': true,
                      'cancelable': true
                  });
              } catch (e) {
                  //si llega aquí es que probablemente implemente la forma antigua de crear un enlace
                  clicEvent = document.createEvent("MouseEvent");
                  clicEvent.initEvent('click', true, true);
              }
              //disparamos el evento
              save.dispatchEvent(clicEvent);
              //liberamos el objeto window.URL
              (window.URL || window.webkitURL).revokeObjectURL(save.href);
          }
          //leemos como url
      reader.readAsDataURL(blob);
  } else {
      //el navegador no admite esta opción
      alert("Su navegador no permite esta acción");
  }
};

(() => {
  "use strict";
   /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function (e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  document.addEventListener('click', function (event) {
    if (!select('aside').contains(event.target)) {
      if (!select('body').classList.contains('toggle-sidebar')
        && !event.target.classList.contains('toggle-sidebar-btn')) {
        select('body').classList.toggle('toggle-sidebar')
      }
    }
  });


  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  /**
   * Initiate TinyMCE Editor
   */
  const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

  /**
   * Initiate Bootstrap validation check
   */
  var needsValidation = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(needsValidation)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })


  /**
   * Autoresize echart charts
   */
  const mainContainer = select('#main');
  if (mainContainer) {
    setTimeout(() => {
      new ResizeObserver(function () {
        select('.echart', true).forEach(getEchart => {
          echarts.getInstanceByDom(getEchart).resize();
        })
      }).observe(mainContainer);
    }, 200);
  }

})();
var espanol = {
  "emptyTable": "Tabla Vacia",
  "loadingRecords": "Cargando...",
  "processing": "Procesando...",
  "select": {
    "cells": {
      "_": "%d celdas seleccionadas",
      "1": "1 celda seleccionada"
    },
    "columns": {
      "_": "%d columnas seleccionadas",
      "1": "1 columna seleccionada"
    },
    "rows": {
      "1": "Fila seleccionada",
      "_": "Filas Seleccionadas"
    }
  },
  "autoFill": {
    "cancel": "Cancelar",
    "fill": "Llenar",
    "fillHorizontal": "Llenar celdas horizontalmente",
    "fillVertical": "Llenar celdas verticalemente",
    "info": "Información"
  },
  "searchBuilder": {
    "conditions": {
      "date": {
        "after": "Después",
        "before": "Antes",
        "between": "Entre",
        "empty": "Vacío",
        "equals": "Igual",
        "not": "No",
        "notBetween": "No Entre",
        "notEmpty": "No Vacío"
      },
      "number": {
        "between": "Entre",
        "empty": "Vacío",
        "equals": "Igual",
        "gt": "Mayor",
        "gte": "Mayor o Igual",
        "lt": "Menor",
        "lte": "Menor o Igual",
        "not": "No",
        "notBetween": "No Entre",
        "notEmpty": "No vacío"
      },
      "string": {
        "contains": "Contine",
        "empty": "Vacío",
        "endsWith": "Termina en",
        "equals": "Iguales",
        "not": "No",
        "notEmpty": "No Vacío",
        "startsWith": "Empieza en",
        "notContains": "No Contiene",
        "notStartsWith": "No empieza en",
        "notEndsWith": "No finaliza en"
      },
      "array": {
        "equals": "Iguales",
        "empty": "Vacío",
        "contains": "Contiene",
        "not": "No",
        "notEmpty": "No Vacío",
        "without": "Con"
      }
    },
    "add": "Agragar condición",
    "button": {
      "_": "Creador de búsquedas (%d)",
      "0": "Creador de búsquedas"
    },
    "clearAll": "Quitar filtro",
    "data": "Datos",
    "logicAnd": "Y",
    "logicOr": "O",
    "value": "Valor",
    "condition": "Condición",
    "deleteTitle": "Eliminar regla",
    "leftTitle": "Izquierda",
    "rightTitle": "Derecha",
    "title": {
      "0": "Generador de Consultas",
      "_": "Generador de Consultas (%d)"
    }
  },
  "searchPanes": {
    "clearMessage": "Borrar Filtro",
    "collapseMessage": "desplegar todo",
    "loadMessage": "Cargando informacion",
    "showMessage": "Mostrar todos",
    "title": "Filtros Activos - %d",
    "collapse": {
      "0": "Paneles de Búsqueda",
      "_": "Paneles de Búsqueda (%d)"
    },
    "count": "{total}",
    "countFiltered": "{shown} ({total})",
    "emptyPanes": "No hay información"
  },
  "buttons": {
    "collection": "Colección",
    "colvis": "Visibilidad Columna",
    "colvisRestore": "Restaurar Visibilidad",
    "copy": "Copiar",
    "copySuccess": {
      "_": "Copiado con exito",
      "1": "Fila copiada con exito"
    },
    "copyTitle": "Tabla Copiada",
    "csv": "CSV",
    "excel": "Excel",
    "pageLength": {
      "_": "ver %d filas",
      "-1": "Ver todas las Filas",
      "1": "Ver una fila"
    },
    "pdf": "PDF",
    "print": "Imprimir",
    "copyKeys": "Presione Inicio + C para copiar la información de la tabla.  Para Cancelar hacer click en este mensaje para o ESC",
    "createState": "Crear estado",
    "removeAllStates": "Eliminar todos los estados",
    "removeState": "Eliminar",
    "renameState": "Renombrar",
    "savedStates": "Estados Guardados",
    "stateRestore": "Estado %d",
    "updateState": "Actualizar"
  },
  "decimal": ".",
  "datetime": {
    "previous": "Anterior",
    "next": "Siguiente",
    "hours": "Horas",
    "minutes": "Minutos",
    "seconds": "Segundos",
    "unknown": "Desconocido",
    "months": {
      "0": "Enero",
      "1": "Febrero",
      "10": "Noviembre",
      "11": "Diciembre",
      "2": "Marzo",
      "3": "Abril",
      "4": "Mayo",
      "5": "Junio",
      "6": "Julio",
      "7": "Agosto",
      "8": "Septiembre",
      "9": "Octubre"
    },
    "weekdays": {
      "0": "Dom",
      "1": "Lun",
      "2": "Mar",
      "3": "Mié",
      "4": "Jue",
      "5": "Vie",
      "6": "Sáb"
    },
    "amPm": [
      "am",
      "pm"
    ]

  },
  "editor": {
    "close": "Cerrar",
    "create": {
      "button": "Nuevo",
      "submit": "Crear",
      "title": "Crear nueva entrada"
    },
    "edit": {
      "button": "Editar",
      "submit": "Actualizar",
      "title": "Editar Registro"
    },
    "remove": {
      "button": "Borrar",
      "submit": "Borrar",
      "title": "Borrar",
      "confirm": {
        "_": "Esta seguro de eliminar %d registros",
        "1": "Esta seguro de eliminar 1 registro"
      }
    },
    "multi": {
      "info": "Los elementos seleccionados contienen diferentes valores para esta entrada. Para editar y configurar todos los elementos de esta entrada en el mismo valor, haga clic o toque aquí, de lo contrario, conservar sus valores individuales.",
      "noMulti": "Múltiples valores",
      "title": "Valores multiples",
      "restore": "Deshacer cambios"
    },
    "error": {
      "system": "Ha ocurrido un error del sistema ( Mas Información)"
    }
  },

  "stateRestore": {
    "removeSubmit": "Eliminar",
    "creationModal": {
      "button": "Crear",
      "order": "Ordenar",
      "paging": "Paginado",
      "scroller": "Posición desplazamiento",
      "search": "Buscar",
      "select": "Seleccionar",
      "columns": {
        "search": "Búsqueda columnas",
        "visible": "Visibilidad de columa"
      },
      "name": "Nombre:",
      "searchBuilder": "Generador de Consultas",
      "title": "Crear Nuevo Estado",
      "toggleLabel": "Incluir:"
    },
    "renameButton": "Renombrar",
    "duplicateError": "Ya existe un estado con este nombre",
    "emptyError": "El nombre no puede estar vacío",
    "emptyStates": "Estado sin Guardar",
    "removeConfirm": "Esta seguro de eliminar el estado %d?",
    "removeError": "Error al eliminar el estado",
    "removeJoiner": "y",
    "removeTitle": "Eliminar Estado",
    "renameLabel": "Nuevo nombre para %s",
    "renameTitle": "Renombrar Estado"
  },
  "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
  "infoFiltered": "(filtrado de _MAX_ entradas totales)",

  "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
  "lengthMenu": "Mostrar _MENU_ Entradas",
  "paginate": {
    "first": "Primero",
    "last": "Último",
    "next": "Siguiente",
    "previous": "Anterior"
  },
  "zeroRecords": "No se encontro información",
  "aria": {
    "sortAscending": "Activar para ordenar ascendente",
    "sortDescending": "Activar para ordenar descendente"
  },
  "infoThousands": ",",
  "searchPlaceholder": "Busqueda en tabla",
  "search": "Buscar:",
  "thousands": ",",
  "infoPostFix": ""
};
