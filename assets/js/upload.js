import { Main } from './main.js';
import { Espanol } from './utils/espanol.js';
import { DownloadCSV } from './utils/downloadCSV.js';
import * as conf from '../../config/config.js';

var token;
var espanol;
var csv;

const fileModal = new bootstrap.Modal(document.getElementById('fileModal'));
var nameFile;
var data = new Array();
var elementsFail = new Array();
var registers = [];
var file;
var modalTable;

export class Upload{

    constructor(){
        let main = new Main(); 
        espanol = new Espanol(); 
        csv = new DownloadCSV();

        // Tabla Principal
        main.getToken().then(data => {
            token = data;
            $('#files').DataTable({
                language: espanol.espanol(),
                pageLength: 50,
                ajax: {
                    url: `${conf.base}message/files?token=${data}`,
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
                    {data: "nameFile" },
                    {data: "nameUsers"},
                    {data: "nameInstituteAsigned"},
                    {data: "dateCreate" }
                ],
                order:[[4, "desc"]],
            })
            // fileModal.show();
        })

        // Capturar Informacion del Archivo
        $('#fileImport').on('change',e => { file = e.target.files[0] });
        // Enviar Informacion del Archivo a la web
        $('#charge').on('click',() => { this.setDataFromFile(); })
        // Guardar y enviar registros a API Apolo
        $('#save').on('click',() => { this.save() });
        // Cerrar el modal y Vaciar datos
        $("#cancel").on('click',() => { this.closeModal() });
        // Descargar Datos Malos
        $('#export').on('click',()=>{ this.exportFails() })
        // Descargar Plantilla
        $('#template').on('click',async(e)=>{ this.downLoadTemplate(e) });
    }    

    setDataFromFile(){
        var allowedExtensions = /(.csv)$/i;
        if (allowedExtensions.exec($('#fileImport').val())) {
            fileModal.show();
            this.butonsDisabled(true);
            const reader = new FileReader();
            reader.onload = () => {
                this.validate(reader.result);
                modalTable = $('#modalFile').DataTable({
                    pageLength: 50,
                    language: espanol.espanol(),
                    data: registers,
                    columns: [
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
                                        return '<span class="mensa" data-tooltip="Agenda Disponible"><i style="color:green;"  class="fs-2 bx bx-task"></i></span>';
                                    case "AND":
                                        return '<span class="mensa" data-tooltip="Agenda No Disponible"><i style="color:red;" class="fs-2 bx bx-task-x"></i></span>';
                                    default:
                                        return '<span class="mensa" data-tooltip="Confirmacion"><i style="color:blue;padding-left:3px" class="fs-4 bi bi-check-circle"></i></span>';
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
    };

    validate(data) {
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
            
            if (total > 0){
                if (total < 11 || total <= 11 && count > 0 || total == 12 && count > 1) {
                    elementsFail.push(item);
                    countBad++;
                } else {
                    if (!item.includes("Documento", "Document", "document", "DOCUMENTO", "Tipo de Documento")) {
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
        $('#process').val(countGood + countBad);
        $('#success').val(countGood);
        $('#failes').val(countBad);

        $('#cancel').prop('disabled', false);
        if (registers.length > 0) $('#save').prop('disabled', false);
        if (elementsFail.length > 0) $('#export').prop('disabled', false);
    }

    save(){
        $('#sonUp').removeClass('quitCharge');
        const urlFile = `${conf.base}message/insert?token=${token}`
        this.butonsDisabled(true);

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
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/json'
                },
        }).then(data => {
            // console.log(data.data)
            if (data.data.Status === "0001") {
                // aqui recarga la ventana
                alert(data.data.Message);
                location.reload();
            } 
            alert(data.data.Message);   
            this.butonsDisabled(false);
            $('#sonUp').addClass('quitCharge');
            
        })
        .catch(err => {
            alert("Muestre este error al administrado: " + err);
            this.butonsDisabled(false);
            $('#sonUp').addClass('quitCharge');
        });
    }

    exportFails(){
        this.butonsDisabled(true);
        alert("Solo se puede exportar los fallos de este archivo una vez");
        csv.arrayObjToCsv(elementsFail, "Fallos por registro");
        $('#cancel').prop('disabled', false);
        $('#save').prop('disabled', false);
    }

    butonsDisabled(status) {
        $('#cancel').prop('disabled', status);
        $('#save').prop('disabled', status);
        $('#export').prop('disabled', status);
    }

    closeModal() {
        fileModal.hide();
        elementsFail = [];
        registers = [];
        data = [];
        $('#fileImport').val("");
        modalTable.destroy();
    }

    async downLoadTemplate(e){
        e.preventDefault();
        const response = await fetch("files/plantilla.csv");
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = "Formato AppointmentBooking.csv";
        document.body.appendChild(a);
        a.click();
        a.remove();
        window.URL.revokeObjectURL(url);
    }
}