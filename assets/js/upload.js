
$(document).ready(function () {
    
    const fileModal = new bootstrap.Modal(document.getElementById('fileModal'));
    var nameFile;
    var data = new Array();
    var elementsFail = new Array();
    var registers = [];
    var token;
    var file;
    var modalTable

    // Tabla Principal
    getToken().then(data => {
        token = data;
        $('#files').DataTable({
            language: espanol,
            ajax: {
                url: 'https://apolo-pruebas.tramisalud.com/Api/message/files?token=' + data,
                dataSrc: '',
                error: function (xhr, error, code) {
                    alert("Inconsistencia al cargar la tabla. Error numero: "+xhr.status);
                },
            },
            columns: [
                {
                    data: "idFile", render: function (data) {
                        return `<strong>${data}</strong>`
                    }
                },
                { data: "name" },
                { data: "dateCreate" }
            ]
        })
    })

    // Descargar Plantilla
    $('#template').click(async (e) =>{
        e.preventDefault();

        const response = await fetch("Apolo-web/files/Formato AppointmentBooking.csv");
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = "Formato AppointmentBooking.csv";
        document.body.appendChild(a);
        a.click();
        a.remove();
        window.URL.revokeObjectURL(url);
    });

    // Capturar Informacion del Archivo
    $('#fileImport').change(e => { file = e.target.files[0] });

    // Enviar Informacion del Archivo a la web
    $('#charge').click(() => {

        $('#cancel').prop('disabled', true);
        $('#save').prop('disabled', true);
        $('#export').prop('disabled', true);

        var allowedExtensions = /(.csv)$/i;
        if (allowedExtensions.exec($('#fileImport').val())) {
            const reader = new FileReader();
            reader.onload = () => {
                validate(reader.result);
                modalTable = $('#modalFile').DataTable({
                    "bAutoWidth": false,
                    "language": espanol,
                    "data": registers,
                    "columns": [
                        { title: "Tipo de Documento", data: "typeDocument" },
                        { title: "Documento", data: "document" },
                        { title: "Nombre", data: "name", width: "20%" },
                        { title: "Telefono", data: "cellPhone" },
                        { title: "Institucion", data: "idInstitute" },
                        { title: "Fecha", data: "dateAppointment" },
                        { title: "Hora", data: "appointmentHour" },
                        { title: "Especialista", data: "medic" },
                        { title: "Especialidad", data: "speciality" },
                        { title: "Tipo", data: "Type", render:
                            function (data) {
                                switch (data.toUpperCase()) {
                                    case "AD":
                                        return '<i style="color:green;" data-bs-toggle="tooltip" data-bs-title="Agenda Disponible" class="fs-2 bx bx-task"></i>';
                                    case "AND":
                                        return '<i style="color:red;" data-bs-toggle="tooltip" data-bs-title="Agenda NO Disponible" class="fs-2 bx bx-task-x"></i>';
                                    default:
                                        return '<i style="color:blue;padding-left:3px" data-bs-toggle="tooltip" data-bs-title="Confirmacion" class="fs-4 bi bi-check-circle"></i>';
                                }
                            }
                        },
                    ]
                });
            };
            reader.readAsText(file);
            nameFile = file.name;
            $('#exampleModalLabel').html("Carga de Archivo: " + nameFile);

            $('#cancel').prop('disabled', false);
            if (registers.length > 0)$('#save').prop('disabled', false);
            $('#export').prop('disabled', false);

            fileModal.show();
        } else {
            alert('Porfavor cargue un archivo valido');
        }

    })

    // Cerrar el modal y Vaciar datos
    $("#cancel").click(CloseModal);

    // Guardar y enviar registros a API Apolo
    $('#save').click(() => {
        const urlFile = `https://apolo.tramisalud.com/Api/message/insert?token=${token}`
        $('#cancel').prop('disabled', true);
        $('#save').prop('disabled', true);
        $('#export').prop('disabled', true);

        let fileName = () => {
            let parts = nameFile.split(".");
            return parts[0] + "-" + moment().format('L-H:mm:ss') + "." + parts[1];
        }

        data.push({
            "identifier": uuid.v4(),
            "nameFile": fileName(),
            "idUser": $('#identifier').val(),
            "data": registers
        })
        console.log(JSON.stringify(data));
        axios.post(urlFile, JSON.stringify(data), {
                headers: {
                    'Content-Type': 'application/json'
                },
            }).then(data => {
                    console.log(data.data)
                    if (data.data.Status === "0001") {
                        // aqui recarga la ventana
                        alert("Guardado Correctamente");
                        location.reload();
                    } else {
                        alert("Error al guardar");
                        // sonUp.style.visibility = 'hidden';
                        // sonUp.style.opacity = '0';
                        // sonUp.style.transition = 'all 500ms ease';
                    }
                    $('#cancel').prop('disabled', true);
                    $('#save').prop('disabled', true);
                    $('#export').prop('disabled', true);
                })
                .catch(err => {
                    alert("Muestre este error al administrado: " + err);
                    // sonUp.style.visibility = 'hidden';
                    // sonUp.style.opacity = '0';
                    // sonUp.style.transition = 'all 500ms ease';
                    $('#cancel').prop('disabled', true);
                    $('#save').prop('disabled', true);
                    $('#export').prop('disabled', true);
                });
    });

    function validate(data) {
        let countGood = 0;
        let countBad = 0;
        data.split("\r\n").forEach(items => {
            let item = items.split(";");
            if (item.includes("") || item.length != 11) {
                elementsFail.push(item);
                countBad++;
            } else {
                if (!item.includes("Documento") && !item.includes("document")) {
                    registers.push({
                        "cellPhone": item[0],
                        "typeDocument": item[1],
                        "document": item[2],
                        "name": item[3],
                        "idInstitute": item[4],
                        "dateAppointment": item[5],
                        "appointmentHour": item[6],
                        "medic": item[7],
                        "speciality": item[8],
                        "autorization": item[9],
                        "Type": item[10],
                    });
                    countGood++;
                };
            }
        });
        $('#process').val(countGood + countBad);
        $('#success').val(countGood);
        $('#failes').val(countBad);

        $('#cancel').prop('disabled', false);
        if (registers.length > 0)$('#save').prop('disabled', false);
        $('#export').prop('disabled', false);
    }

    function CloseModal() {
        fileModal.hide();
        elementsFail = [];
        registers = [];
        data = [];
        $('#fileImport').val("");
        modalTable.destroy();
    }
});

const sonUp = document.getElementById("sonUp");
// sonUp.style.visibility = 'visible';
// sonUp.style.opacity = '1';

// fileModal.show();



// sonUp.style.visibility = 'hidden';
// sonUp.style.opacity = '0';
// sonUp.style.transition = 'all 500ms ease';




// saveFile.addEventListener("click", () => {
//     sonUp.style.visibility = 'visible';
//     sonUp.style.opacity = '1';

//     
//
//     console.log(urlFile);
// })