import { Main } from './main.js';
import { Espanol } from './utils/espanol.js';
import { DownloadCSV } from './utils/downloadCSV.js';

var token;
var espanol;
var registers = new Array();
var waiting;
var csv;
var url = '';

export class Waiting{

    constructor(){
        let main = new Main();
        espanol = new Espanol();
        csv = new DownloadCSV();
        main.getToken().then(response => {
            token = response;
            this.createTable(response);
        });      
        $('#clear').on('click', () =>{ this.clearFields(); });
        $('#filter').on('click', (e) => { this.filterDate(); });
        $('#download').on('click', e => { csv.arrayObjToCsv(registers[0], "Lista de Espera"); });
        $('#institution').on('change',(e) => { this.changeInFields(e) })
    };

    changeInFields(e){   
        if ( parseInt(e.target.value) !== 0){
            $('#dateInitial').prop('disabled', false);
            $('#dateFinal').prop('disabled', false);
        }else{
            $('#dateInitial').prop('disabled', true);
            $('#dateInitial').val("");

            $('#dateFinal').prop('disabled', true);
            $('#dateFinal').val("");
            
        }
    };

    clearFields() {
        $('#dateInitial').val("");
        $('#dateFinal').val("");
        $('#dateInitial').prop('disabled', true);
        $('#dateFinal').prop('disabled', true);
        $('#institution').val(0)
    };

    filterDate(){
        let date =  $('#dateInitial').val();
        let date2 =  $('#dateFinal').val();

        if (date2 !== '' && date == '' || moment( date ).isAfter( date2 )){
            alert("La fecha Final no puede ser superior a la fecha inicial, vuelva a validar la informacion");
            
        }else{
            registers = [];
            this.validateUrl();
            waiting.destroy();
            $('tbody').remove();
            this.createTable(token);
        }
    };

    createTable() {
                
        axios.get(`https://apolo-pruebas.tramisalud.com/Api/message/waitingList?token=${token}${url}`)
        .then(response => {
            registers.push(response.data);
            // console.log(response.data);
            waiting = $('#waiting').DataTable({
                language: espanol.espanol(),
                data: response.data,
                columns: [
                    { data: 'id' },
                    { data: 'dateRegister' },
                    { data: 'numberPatient' },
                    { data: 'typeDocument' },
                    { data: 'document' },
                    { data: 'fullName' },
                    // {data: 'addrees'},
                    // {data: 'birthdate'},
                    // {data: 'municipality'},
                    // {data: 'email'},
                    // {data: 'mainPhone'},
                    // {data: 'secondPhone'},
                    { data: 'eps' },
                    {data: 'numberAuthorization'},
                    {data: 'authorizationDateExpire'},
                    {data: 'typeAppointment'},
                    { data: 'speciality' },
                    { data: 'idInstitution' },
                ],
                order: [[1, "desc"]],
                
            });
            $('#download').prop('disabled', false);
        })
    }

    validateUrl(){
        let inst = parseInt($('#institution').val());
        let date =  $('#dateInitial').val();
        let date2 =  $('#dateFinal').val();

        if ( inst == 0 && date === "") {
            url = '';
            alert('Sino selecciona algo se mostraran todas las intituciones');
        }

        if (inst !== 0 && date === "" && date2 === ""){
            url = `&idInstitute=${inst}`;
        }else{
            if (date2 == '')date2 = date
            url = `&idInstitute=${inst}&startDate=${date}&endDate=${date2}`;
        }
        // console.log(url);
    }
    
}

