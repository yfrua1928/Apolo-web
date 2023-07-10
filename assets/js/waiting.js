$(document).ready(function() {
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

    $('#institution').on('change', (e) => {
        if (parseInt(e.target.value) !== 0) {
            $('#dateInitial').prop('disabled', false);
            $('#dateFinal').prop('disabled', false);
        } else {
            $('#dateInitial').prop('disabled', true);
            $('#dateInitial').val("");

            $('#dateFinal').prop('disabled', true);
            $('#dateFinal').val("");

        }
    })

    $('#clear').on('click', () => {
        $('#dateInitial').val("");
        $('#dateFinal').val("");
        $('#dateInitial').prop('disabled', true);
        $('#dateFinal').prop('disabled', true);
        $('#institution').val(0)
    });

    $('#filter').on('click', (e) => {
        let date = $('#dateInitial').val();
        let date2 = $('#dateFinal').val();

        if (date2 !== '' && date == '' || moment(date).isAfter(date2)) {
            alert("La fecha Final no puede ser superior a la fecha inicial, vuelva a validar la informacion");

        } else {
            registers = [];
            validateUrl();
            waiting.destroy();
            $('tbody').remove();
            createTable(token);
        }

    });

    $('#download').on('click', e => {
        arrayObjToCsv(registers[0], "Lista de Espera");
    });

    function createTable(token) {
        axios.get(`https://apolo.tramisalud.com/Api/message/waitingList?token=${token}${url}`).then(response => {
            registers.push(response.data);
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
                    { data: 'numberAuthorization' },
                    { data: 'authorizationDateExpire' },
                    { data: 'typeAppointment' },
                    { data: 'speciality' },
                    { data: 'idInstitution' },
                ],
                order: [
                    [1, "desc"]
                ],

            });
            $('#download').prop('disabled', false);
        })
    }

    function validateUrl() {
        let inst = parseInt($('#institution').val());
        let date = $('#dateInitial').val();
        let date2 = $('#dateFinal').val();

        if (inst == 0 && date === "") {
            url = '';
            alert('Sino selecciona algo se mostraran todas las intituciones');
        }

        if (inst !== 0 && date === "" && date2 === "") {
            url = `&idInstitute=${inst}`;
        } else {
            if (date2 == '') date2 = date
            url = `&idInstitute=${inst}&startDate=${date}&endDate=${date2}`;
        }
        // console.log(url);
    }

})