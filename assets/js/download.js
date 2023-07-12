import { Main } from './main.js';
import { Espanol } from './utils/espanol.js';
import { DownloadCSV } from './utils/downloadCSV.js';
import * as conf from '../../config/config.js';

var token;
var espanol;
var csv;

var tableRegister;
var initTable;
var idGlobal;
var sr = 0;

const modalito = $('#registerModal'); 
const registerModal = new bootstrap.Modal(modalito);
var registers = new Array();
var reesend = new Array();

// Funciones Globales

export class Download{

    constructor(){
        let main = new Main(); 
        espanol = new Espanol(); 
        csv = new DownloadCSV();
        // Tabla Principal
        main.getToken().then(data => { this.createPrincipalTable(data) });

        // Reenvir datos de la lista
        $('#send').on('click', () => { this.resend() });
        // Exportar todos los datos de la lista en el modal
        $('#export').on('click', () => csv.arrayObjToCsv(registers, "Cargamasiva"));
        // Actualizar la tabla
        $('#update').on("click", () => { this.update(); });
        // Cerrar el modal 
        $('#exit').on("click", ()=> registerModal.hide());
        // Ejecuta la funcion de cerrar modal
        $('#registerModal').on('hidden.bs.modal', () => this.closeModal());
    }

    createPrincipalTable(data){
        
        token = data;
        initTable = $('#initTable').DataTable({
            language: espanol.espanol(),
            pageLength: 50,
            ajax: {
                url: `${conf.base}message/files?token=${data}`,
                dataSrc: ''
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

            columnDefs: [{target: 5, orderable: false,  data: null, 
            render: function (data, type, row, meta) {
                let boton = '';
                if (data.resend == 0){
                    boton = `<a class="btn p-1 send mensa" data-tooltip="Reenviar"><i class="fs-3 bi bi-send"></i></a>
                    <a class="btn p-1 cancel mensa" data-tooltip="Cancelar Envio"><i class="fs-3 bi bi-send-slash"></i></a>`
                }
                let botones = `
                    <div class="d-flex mt-2">  
                    <a class="btn p-1 eye mensa" data-tooltip="Ver"><i class="fs-3 bi bi-eye"></i></a>
                    ${boton}
                    </div>`;
                return botones;
            }
            }],
            order:[[4, "desc"]],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $(nRow).on("click", '.eye', function() {
                    if ($('#sonUp').hasClass('quitCharge')) {
                        $('#sonUp').removeClass('quitCharge');
                    }
                    // console.log(aData.idFile);
                    getDataRegisters(aData.idFile);
                })

                $(nRow).on("click", '.send',() => {
                    idGlobal = aData.idFile
                    // console.log(idGlobal);
                    getDataForResend();
                })

                $(nRow).on("click", '.cancel',() => {
                    idGlobal = aData.idFile
                    // console.log(idGlobal);
                    updateFile();
                })

            }
        })

               
    }
    
    resend(){
        butonsDisabled(true);
        alert('Se van a reenviar los datos, por favor no cierre esta ventana.');
        $('#sonUp').removeClass('quitCharge');
        getDataForResend();
    }

    update(){
        $('#sonUp').removeClass('quitCharge');
        butonsDisabled(true);
        tableRegister.destroy();
        $('#tableRegister').children('tbody').remove();
        getDataRegisters(idGlobal);
    }

    closeModal() {
        registers =[];
        tableRegister.destroy();
        $('#tableRegister').children('tbody').remove();
        setStadistics({
            total: 0,
            ad: 0,
            and: 0,
            confir: 0,
            nothing: 0,
            sg: 0,
            sr: 0,
            con: 0,
            can: 0,
            canTimeOut: 0
        });    
    }

}

function getDataRegisters(id) {  
    idGlobal = id; 
    $('.modal-title').text(`Documento # ${id}`)

    let total = 0;
    let ad = 0;
    let and = 0;
    let confir = 0;
    let nothing = 0;
    let sg = 0;
    sr = 0;
    let con = 0;
    let can = 0;
    let canTimeOut = 0
    axios({
            method: "POST",
            url: `${conf.base}message/registers?identifier=${id}&token=${token}`,
        })
        .then((response) => response.data)
        .then((data) => {
            // console.log(data);
            
            if (data.length > 0){
                registers = data.map( item => {
                    return [item.cellPhone, item.typeDocument, item.document, item.name, item.dateAppointment, item.appointmentHour, item.speciality, item.autorization, item.cups]
                })

                total = data.length;
            }
            tableRegister = $('#tableRegister').DataTable({
                language: espanol.espanol(),
                data: data,
                pageLength: 50,
                columns:[
                    {data: 'typeDocument'},
                    {data: 'document'},
                    {data: 'name'},
                    {data: 'cellPhone'},
                    {data: 'dateAppointment'},
                    {data: 'appointmentHour'},
                    {data: 'medic'},
                    {data: 'speciality'},
                    {data: 'autorization'},
                    {data: 'Type'},
                    {data: 'status', render: function(data) {
                        let row;
                        switch (data) {
                            case "1":
                                row = '<td><span class="mensa" data-tooltip="Sin Respuesta"><i class="bx bx-check fs-2" ></i></span></td>';
                                break;
                            case "2":
                                row = '<td><span class="mensa" data-tooltip="Confirmada"><i style="color:#53bdeb;" class="fs-2 bx bx-check-double"></i></span></td>';
                                break;
                            case "3":
                                row = '<td><span class="mensa" data-tooltip="Cancelada"><i style="color:red;" class="fs-4 bi bi-x-octagon"></i></span></td>';
                                break; 
                            case "7":
                                row = '<td><span class="mensa" data-tooltip="Cancelada"><i style="color:orange;" class="fs-4 bi bi-hourglass"></i></span></td>';
                                break;                           
                            default:
                                row = '<td><span class="mensa" data-tooltip="Sin Gestionar"><i style="color:#ffc800db;" class="bx bxs-message-rounded-minus fs-2" ></i></span></td>';
                                break;
                        }
                        return row;
                    
                    }}
                ]
            })
            let count = tableRegister.column(9).data();
            let status = tableRegister.column(10).data();
            for (let i = 0; i < count.length; i++) {
                switch (count[i].toUpperCase()) {
                    case "AD":
                        ad++;
                        break;
                    case "AND":
                        and++;
                        break;
                    case "C":
                        confir++;
                        break;
                    default:
                        nothing++;
                        break;
                }
            };   
            for (let i = 0; i < status.length; i++) {
                switch(status[i]){
                    case "1":
                        sr++;
                        break;
                    case "2":
                        con++;
                        break;
                    case "3":
                        can++;
                        break;
                    case "7":
                        canTimeOut++;
                        break;
                    default:
                        sg++;
                }
            }               
            setStadistics({
                total: total,
                ad: ad,
                and: and,
                confir: confir,
                nothing: nothing,
                sg: sg,
                sr: sr,
                con: con,
                can: can,
                canTimeOut: canTimeOut
            });
            butonsDisabled(false);
            $('#sonUp').addClass("quitCharge");
        }).catch((err) => console.error(err));    
    registerModal.show();
} 

function setStadistics(stadistics) {
    $("#total").val(stadistics.total);
    $("#ad").val(stadistics.ad);
    $("#and").val(stadistics.and);
    $("#confir").val(stadistics.confir);
    $("#nothing").val(stadistics.nothing);
    $("#sg").val(stadistics.sg);
    $("#sg").text(stadistics.sg);
    $("#sr").text(stadistics.sr);
    $("#con").text(stadistics.con);
    $("#can").text(stadistics.can);
    $("#canTimeOut").text(stadistics.canTimeOut);
}

function butonsDisabled(status) {
    if (sr >= 1){
        $('#send').prop('disabled', status);
        $('#cancel').prop('disabled', status);
    }
    $('#export').prop('disabled', status);
    $('#update').prop('disabled', status);
    $('#exit').prop('disabled', status);
}

function getDataForResend(){
    let info = new Array();
    var registers;
    axios.get(`${conf.base}message/registers?identifier=${idGlobal}&token=${token}`)
    .then(response => response.data).then(response =>{
        registers = response.filter(item => { return item.status == '1'})
        .map(item => {
           return {
            "cellPhone": item.cellPhone,
            "typeDocument": item.typeDocument,
            "document": item.document,
            "name": item.name.trim(),
            "idInstitute": item.idInstitute,
            "dateAppointment": item.dateAppointment,
            "appointmentHour": item.appointmentHour,
            "medic": item.medic,
            "speciality": item.speciality,
            "autorization": item.autorization,
            "Type": item.Type,
            "cups": item.cups   
           } 
        })

        info =  {
            "identifier": uuid.v4(),
            "nameFile": 'reenvio-'+idGlobal+'-'+moment().format('L-H:mm:ss'),
            "idUser": $('#identifier').val(),
            "data": registers
        }
        
    })
    .then(() =>{
        if (registers.length >= 1){
            axios.post(`${conf.base}message/insert?token=${token}`, JSON.stringify(info), {
                headers: {
                    'Content-Type': 'application/json'
                },
            }).then(data => {
                // console.log(data.data)
                if (data.data.Status === "0001") {
                    // aqui recarga la ventana
                    updateFile();
                } 
                alert(data.data.Message);   
                butonsDisabled(false);
                $('#sonUp').addClass('quitCharge');
    
            }).catch(err => {
                alert("Muestre este error al administrado: " + err);              
                butonsDisabled(false);
                $('#sonUp').addClass('quitCharge');
            });
        }else{
            alert("Actualmente ya no hay registros para reenviar, actualice la tabla para ver informacion mas reciente")
        }
    })
}

function updateFile(){
    axios.put(`${conf.base}traceability/UpdateStatusFile?token=${token}`, JSON.stringify({"idFile":idGlobal}), {
        headers: {
            'Content-Type': 'application/json'
        },
    }).then( data => {
        if (data.data.Status === "0001") {
            alert(data.data.Message);
            location.reload();
        }
    });

}