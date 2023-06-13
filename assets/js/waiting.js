$(document).ready( function() {
    var token;
    var waiting;
    var url = '';

    // if (localStorage.getItem('institute') === null){
    //     url = '';
    // }else{
    //     url = `idInstitute=${$('#institution').val()}&`;
    // }

    getToken().then(data =>{
        token = data;
        createTable(data);
    })

    $('#filter').on('click', (e)=>{
        console.log('Hola mundo');
        if ($('#institution').val() == 0){
            url = '';
            alert('Sino selecciona algo se mostraran todas las intituciones');
        }else{
           
            url = `idInstitute=${$('#institution').val()}&`;
            
        }
        waiting.destroy();
        $('tbody').remove();
        createTable(token);
    });

    function createTable(token){
        waiting = $('#waiting').DataTable({
            language: espanol,
            ajax: {
                url: `https://apolo.tramisalud.com/Api/message/waitingList?${url}token=${token}`,
                dataSrc: ''
            },
            columns: [
                {data: 'id'},
                {data: 'dateRegister'},
                {data: 'numberPatient'},
                {data: 'typeDocument'},
                {data: 'document'},
                {data: 'fullName'},
                // {data: 'addrees'},
                // {data: 'birthdate'},
                // {data: 'municipality'},
                // {data: 'email'},
                // {data: 'mainPhone'},
                // {data: 'secondPhone'},
                {data: 'eps'},
                // {data: 'numberAuthorization'},
                // {data: 'authorizationDateExpire'},
                // {data: 'typeAppointment'},
                {data: 'speciality'},
                {data: 'idInstitution'},
            ]
        })
    }
})