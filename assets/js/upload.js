$(document).ready(function() {

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
                    url: 'https://apolo.tramisalud.com/Api/message/files?token=' + data,
                    dataSrc: '',
                    error: function(xhr, error, code) {
                        alert("Inconsistencia al cargar la tabla. Error numero: " + xhr.status);
                    },
                },
                columns: [{
                        data: "idFile",
                        render: function(data) {
                            return `<strong>${data}</strong>`
                        }
                    },
                    { data: "nameFile" },
                    { data: "nameUsers" },
                    { data: "nameInstituteAsigned" },
                    { data: "dateCreate" }
                ],
                order: [
                    [4, "desc"]
                ],
            })
            // fileModal.show();
    })

    // Descargar Plantilla
    $('#template').click(async(e) => {
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
            fileModal.show();
            butonsDisabled(true);
            
            var allowedExtensions = /(.csv)$/i;
            if (allowedExtensions.exec($('#fileImport').val())) {
                
                const reader = new FileReader();
                reader.onload = () => {
                    validate(reader.result);
                    modalTable = $('#modalFile').DataTable({
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
                            {
                                title: "Tipo",
                                data: "Type",
                                render: function(data) {
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
                $('#sonUp').addClass("quitCharge");
            } else {
                alert('Porfavor cargue un archivo valido');
            }

        })
        // Cerrar el modal y Vaciar datos
    $("#cancel").click(CloseModal);
    // Guardar y enviar registros a API Apolo
    $('#save').click(() => {
        $('#sonUp').removeClass('quitCharge');
        const urlFile = `https://apolo.tramisalud.com/Api/message/insert?token=${token}`
        butonsDisabled(true);

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
        axios.post(urlFile, JSON.stringify(data[0]), {
                headers: {
                    'Content-Type': 'application/json'
                },
            }).then(data => {
                console.log(data.data)
                if (data.data.Status === "0001") {
                    // aqui recarga la ventana
                    alert(data.data.Message);
                    location.reload();
                }
                alert(data.data.Message);
                butonsDisabled(false);
                $('#sonUp').addClass('quitCharge');

            })
            .catch(err => {
                alert("Muestre este error al administrado: " + err);
                butonsDisabled(false);
                $('#sonUp').addClass('quitCharge');
            });
    });
    // Descargar Archivos Malos
    $('#export').on('click', () => {
        butonsDisabled(true);

        alert("Solo se puede exportar los fallos de este archivo una vez");
        arrayObjToCsv(elementsFail[0], "Fallos por registro");

        $('#cancel').prop('disabled', false);
        $('#save').prop('disabled', false);

    })

    function validate(data) {
        let countGood = 0;
        let countBad = 0;
        data.split("\r\n").forEach(items => {
            let item = items.split(";");
            var count = 0;
            var total = 0;

            if (item.length > 1) {
                for (let a in item) {
                    if (item[a] === "") {
                        count++;
                    }
                    total++;
                }

            }
            if (total > 0) {
                if (total < 11 || total <= 11 && count > 0 || total == 12 && count > 1) {
                    elementsFail.push(item);
                    countBad++;
                } else {
                    let badwords = ["Documento", "Document", "document", "DOCUMENTO", "Tipo de Documento"];
                    if (!(item in badwords)) {

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
                            "cups": (item[11] == "" || item[11] == undefined || item[11] == null) ? 0 : item[11]
                        });
                        countGood++;
                    };
                }
            }

        });
        console.log(registers);
        $('#process').val(countGood + countBad);
        $('#success').val(countGood);
        $('#failes').val(countBad);

        $('#cancel').prop('disabled', false);
        if (registers.length > 0) $('#save').prop('disabled', false);
        if (elementsFail.length > 0) $('#export').prop('disabled', false);
    }

    function CloseModal() {
        fileModal.hide();
        elementsFail = [];
        registers = [];
        data = [];
        $('#fileImport').val("");
        modalTable.destroy();
    }

    function butonsDisabled(status) {
        $('#cancel').prop('disabled', status);
        $('#save').prop('disabled', status);
        $('#export').prop('disabled', status);

    }
});