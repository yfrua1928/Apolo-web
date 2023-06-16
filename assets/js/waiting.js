$(document).ready(function () {
    var token;
    var waiting;
    var url = '';
    var registers = new Array();

    // if (localStorage.getItem('institute') === null){
    //     url = '';
    // }else{
    //     url = `idInstitute=${$('#institution').val()}&`;
    // }

    getToken().then(data => {
        token = data;
        createTable(data);
    })

    $('#institution').on('change',(e) => {
        if ( parseInt(e.target.value) !== 0){
            $('#dateInitial').prop('disabled', false);
        }else{
            $('#dateInitial').prop('disabled', true);
            $('#dateInitial').val("");
            
        }
    })

    $('#clear').on('click',() => {
        $('#dateInitial').val("");
        $('#dateInitial').prop('disabled', true);
        $('#institution').val(0)
    });

    $('#filter').on('click', (e) => {
        registers = [];
        console.log('Hola mundo');
        console.log($('#dateInitial').val()===""); 
        validateUrl();
        waiting.destroy();
        $('tbody').remove();
        createTable(token);
    });

    $('#download').on('click', e => {
        console.log('Hola descarga');
        arrayObjToCsv(registers[0])
    });

    function createTable(token) {
        axios.get(`https://apolo-pruebas.tramisalud.com/Api/message/waitingList?token=${token}${url}`).then(response => {
            registers.push(response.data);
            console.log(response.data);
            waiting = $('#waiting').DataTable({
                language: espanol,
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
                    // {data: 'numberAuthorization'},
                    // {data: 'authorizationDateExpire'},
                    // {data: 'typeAppointment'},
                    { data: 'speciality' },
                    { data: 'idInstitution' },
                ],
                columnsDefs: [],
                order: [[1, "desc"]]
            })
            $('#download').prop('disabled', false);
        }).catch(err){
            alert(err.message);
        };
    }

    function validateUrl(){
        let inst = parseInt($('#institution').val());
        let date =  $('#dateInitial').val()

        if ( inst == 0 && date === "") {
            url = '';
            alert('Sino selecciona algo se mostraran todas las intituciones');
        }

        if (inst !== 0 && date === ""){
            url = `&idInstitute=${inst}`;
        }else{
            url = `&idInstitute=${inst}&date=${date}`;
            console.log(date);
        }
        console.log(url);
    }
    
})