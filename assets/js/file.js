const fileModal = new bootstrap.Modal(document.getElementById('fileModal'));
const datafile = document.getElementById("fileImport");
const charges = document.getElementById("charge");
const mostrar = document.getElementById("contenido");
const complement = document.getElementById("complement");
const sonUp = document.getElementById("sonUp");

const cancel = document.getElementById("cancel");
const saveFile = document.getElementById("save");
const down = document.getElementById("export");


// fileModal.show();
var token;
var nameFile = "";
var data = new Array();
var elementsFail = new Array();

function getToken() {
    const urlLogin = "https://apolo.tramisalud.com/Api/Login";
    axios({
            method: "POST",
            url: urlLogin,
        })
        .then((data) => (token = data.data.accessToken))
        .catch((err) => alert(err));
}
getToken();

function createRow(register) {
    let row = "<th scope='row'>" + register[1] + "</th>" +
        "<td>" + register[2] + "</td>" +
        "<td>" + register[3] + "</td>" +
        "<td>" + register[0] + "</td>" +
        "<td>" + register[4] + "</td>" +
        "<td>" + register[5] + "</td>" +
        "<td>" + register[6] + "</td>" +
        "<td>" + register[7] + "</td>" +
        "<td>" + register[8] + "</td>" +
        "<td>" + register[9] + "</td>";

    switch (register[10].toUpperCase()) {
        case "AD":
            row += '<td><i style="color:green;" data-bs-toggle="tooltip" data-bs-title="Agenda Disponible" class="fs-2 bx bx-task"></i></td>';
            break;
        case "AND":
            row += '<td><i style="color:red;" data-bs-toggle="tooltip" data-bs-title="Agenda NO Disponible" class="fs-2 bx bx-task-x"></i></td>';
            break;
        default:
            row += '<td><i style="color:blue;padding-left:3px" data-bs-toggle="tooltip" data-bs-title="Confirmacion" class="fs-4 bi bi-check-circle"></i></td>';
            break;
    }

    return row;
}

function validateInformation(contenido) {

    let tbody = document.createElement("tbody");
    document.getElementById("table").appendChild(tbody);
    tbody.classList.add("first");

    let registers = [];
    let countGood = 0;
    let countBad = 0;
    var row = "";
    console.log(contenido);
    contenido.split("\r\n").forEach(element => {
        let register = element.split(";");
        if (register.includes("") || register.length < 10) {
            elementsFail.push(register);
            countBad++;
        } else {
            if (!register.includes("Documento")) {
                let tr = document.createElement("TR");
                registers.push({
                    "cellPhone": register[0],
                    "typeDocument": register[1],
                    "document": register[2],
                    "name": register[3],
                    "idInstitute": register[4],
                    "dateAppointment": register[5],
                    "appointmentHour": register[6],
                    "medic": register[7],
                    "speciality": register[8],
                    "autorization": register[9],
                    "Type": register[10],
                });
                tr.innerHTML = createRow(register);
                tbody.appendChild(tr);
                countGood++;
            }

        }

    })

    let fileName = () => {
        let parts = nameFile.split(".");
        return parts[0] + "-" + moment().format('L-H:mm:ss') + "." + parts[1];
    }

    console.log(fileName());
    data.push({
        "identifier": uuid.v4(),
        "nameFile": fileName(),
        "idUser": "1",
        "data": registers
    })



    document.querySelector("#exampleModalLabel").innerHTML = "Carga de Archivo: " + nameFile;
    document.querySelector("#process").value = countGood + countBad;
    document.querySelector("#success").value = countGood;
    document.querySelector("#failes").value = countBad;

    // console.log( elementsFail );
    // console.log(registers);
    // console.log( countGood );
    // console.log(countBad);
    saveFile.removeAttribute('disabled');
    down.removeAttribute('disabled');

    sonUp.style.visibility = 'hidden';
    sonUp.style.opacity = '0';
    sonUp.style.transition = 'all 500ms ease';


}

charges.addEventListener('click', (e) => {
    var allowedExtensions = /(.csv)$/i;

    if (!allowedExtensions.exec(datafile.value)) {
        alert('Porfavor cargue un archivo valido');
    } else {
        // sonUp.style.visibility = 'visible';
        // sonUp.style.opacity = '1';
        saveFile.setAttribute('disabled', "true");
        down.setAttribute('disabled', "true");
        fileModal.show();
        const reader = new FileReader();
        reader.onload = function() {
            validateInformation(reader.result);
        }
        nameFile = datafile.files[0].name;
        reader.readAsText(datafile.files[0])
    }

}, false);

cancel.addEventListener("click", CloseModal);

saveFile.addEventListener("click", () => {
    sonUp.style.visibility = 'visible';
    sonUp.style.opacity = '1';

    const urlFile = `https://apolo.tramisalud.com/Api/message/insert?token=${token}`
    axios({
            method: "POST",
            url: urlFile,
            data: JSON.stringify(data[0]),
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(data => {
            console.log(data.data)
            if (data.data.Status === "0001") {
                // aqui recarga la ventana
                alert("Guardado Correctamente");
                location.reload();

            } else {
                alert("Error al guardar");
                sonUp.style.visibility = 'hidden';
                sonUp.style.opacity = '0';
                sonUp.style.transition = 'all 500ms ease';
            }
        })
        .catch(err => {
            alert("Muestre este error al administrado: " + err);
            sonUp.style.visibility = 'hidden';
            sonUp.style.opacity = '0';
            sonUp.style.transition = 'all 500ms ease';
        });
    console.log(urlFile);
})

function CloseModal() {
    elementsFail = [];
    data = [];
    datafile.value = "";
    fileModal.hide();
    setTimeout(function() {
        const list = document.querySelector(".first");
        list.parentNode.removeChild(list);
    }, 200);
}