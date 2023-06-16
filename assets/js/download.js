$('document').ready(function() {
    var token;
    
    const modalito = $('#registerModal'); 
    const registerModal = new bootstrap.Modal(modalito);
    const exit = document.getElementById("exit");
    const update = document.getElementById("update");


    const closeRegister = document.getElementById("closeRegister");
    const init = document.querySelector("#initTable");
    const titleRegister = document.querySelector(".modal-title");
    const exportar = document.getElementById("export");


    var registers = new Array();
    var reesend = new Array();
    var id = undefined;

    // Tabla Principal
    getToken().then(data => {
        token = data;
        var modalTable = $('#initTable').DataTable({
            language: espanol,
            ajax: {
                url: 'https://apolo-pruebas.tramisalud.com/Api/message/files?token=' + data,
                dataSrc: ''
            },
            columns: [
                {
                    data: "idFile", render: function (data) {
                        return `<a type="button" class="btn_register btn btn-sm" id="${data}_id" data-bs-target="#registerModal"><strong>${data}</strong></strong></a>`
                    }
                },
                { data: "name" },
                { data: "dateCreate" }
            ],
            order:[
            [2, "desc"]
            ]
        })
        
        modalTable.on('draw.dt', function(){
            const btnReg = document.querySelectorAll(".btn-sm");
            btnReg.forEach((boton) => {
                boton.addEventListener("click", getDataRegisters);
            });
        })

    })

    $('#send').on('click',() => {
        $('#send').prop('disabled', true);
        $('#export').prop('disabled', true);
        $('#update').prop('disabled', true);
        $('#exit').prop('disabled', true);
        alert('Se va reenviar los datos, por favor no cierre esta ventana.');

        let fileName = 'reenvio-'+moment().format('L-H:mm:ss')
               
        
    });

    function getDataRegisters() {

        if (id == undefined) {
            id = this.innerText;
        }
    
        titleRegister.textContent = `Documento # ${id}`;
    
        var total = 0;
        var ad = 0;
        var and = 0;
        var confir = 0;
        var nothing = 0;
    
        let urlRegisters = `https://apolo-pruebas.tramisalud.com/Api/message/registers?identifier=${id}&token=${token}`;
        console.log(urlRegisters);
    
        axios({
                method: "POST",
                url: urlRegisters,
            })
            .then((response) => response.data)
            .then((data) => {
                reesend.push(data);
                console.log(data);
                total = data.length;
                data.forEach((item) => {
                    switch (item.Type.toUpperCase()) {
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
                    console.log(item);
                    let tr = document.createElement("TR");
                    tr.innerHTML = createRowRegister(item);
                    tbody.appendChild(tr);
                    registers.push(item);
                }).catch((error) => {
                    alert(error.message);
                });
                console.log(total);
    
                setStadistics(total, ad, and, confir, nothing);
                botonUpdate();
    
            })
            .catch((err) => console.error(err));
    
        var tbody = document.createElement("tbody");
        document.getElementById("tableRegister").appendChild(tbody);
        tbody.classList.add("first");
    
        // son.style.visibility = 'hidden';
        // son.style.opacity = '0';
        // son.style.transition = 'all 500ms ease';
    
        registerModal.show();
    }

    function createRowRegister(register) {

        let row =
            // "<th scope='row'>" + register.id + "</th>" +
            "<td >" + register.typeDocument + "</td>" +
            "<td>" + register.document + "</td>" +
            "<td>" + register.name + "</td>" +
            "<td>" + register.cellPhone + "</td>";
        // switch (register.idInstitute) {
        //     case '890905177':
        //         row += "<td>HLM</td>";
        //         break;
        //     case '8909051772':
        //         row += "<td>HLM</td>";
        //         break;
        //     case '900625317':
        //         row += "<td>HCIM</td>";
    
        //         break;
        //     case '900425272':
        //         row += "<td>CRX</td>";
    
        //         break;
        //     case '890904646':
        //         row += "<td>HGM</td>";
    
        //         break;
    
        // }
        row += "<td>" + register.dateAppointment + "</td>" +
            "<td>" + register.appointmentHour + "</td>" +
            "<td>" + register.medic + "</td>" +
            "<td>" + register.speciality + "</td>" +
            "<td>" + register.autorization + "</td>" +
            "<td>" + register.Type + "</td>";
    
        switch (register.status) {
    
            case "1":
                row += '<td ><i class="bx bx-check fs-2"></i></td>';
                break;
            case "2":
                row += '<td><i style="color:#53bdeb;" class="fs-2 bx bx-check-double"></i></td>';
                break;
            case "3":
                row += '<td><i style="color:red;" class="fs-4 bi bi-x-octagon"></i></td>';
                break;
            case "4":
                row += '<td><i class="bx bx-check fs-2"></i></td>';
                break;
            case "5":
                row += '<td><i style="color:red;" class="bx bxs-message-rounded-x fs-2"></i></td>';
                break;
            case "6":
                row += '<td><i style="color:red;" class="bx bx-user-x fs-2"></i></td>';
                break;
            case "7":
                row += '<td><i style="color:red;" class="bx bx-alarm-off fs-2"></i></td>';
                break;
                // default:
                //     row += '<td data-bs-toggle="tooltip" data-bs-title="asdsad"><i style="color:#ffc800db;" class="bx bxs-message-rounded-minus fs-2" ></i></td>';
                //     break;
        }
        return row;
    }
    
    function botonUpdate() {
        update.removeAttribute('disabled');
        update.classList.add("btn-primary");
        update.classList.remove("btn-secondary");
    }
    
    function setStadistics(total, ad, and, confirm, nothing) {
        document.getElementById("total").value = total;
        document.getElementById("ad").value = ad;
        document.getElementById("and").value = and;
        document.getElementById("confir").value = confirm;
        document.getElementById("nothing").value = nothing;
    }
    
    
    
    // btnReg.forEach((boton) => {
    //     boton.addEventListener("click", getDataRegisters);
    // });
    
    function closeModal() {
        registerModal.hide();
        setStadistics(0, 0, 0, 0, 0);
        setTimeout(function() {
            titleRegister.textContent = '';
            const list = document.querySelector(".first");
            list.parentNode.removeChild(list);
            id = undefined;
        }, 200);
    
    }
    
    exit.addEventListener("click", closeModal);
    
    // modalito.addEventListener("hidden.bs.modal", closeModal);
    
    update.addEventListener("click", () => {
        console.log(id);
        update.setAttribute('disabled', "true");
        update.classList.remove("btn-primary");
        update.classList.add("btn-secondary");
        setStadistics(0, 0, 0, 0, 0)
        const list = document.querySelector(".first");
        list.parentNode.removeChild(list);
        getToken()
        getDataRegisters();
        console.log("hola mundo!");
    });
        
    exportar.addEventListener("click", () => {
        arrayObjToCsv(registers, "Cargamasiva");
        console.log("Hola Mundo!");
    })


})

