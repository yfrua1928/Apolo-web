$("document").ready(function() {
    var token;
    var tableRegister;
    var initTable;
    var idGlobal;

    const modalito = $("#registerModal");
    const registerModal = new bootstrap.Modal(modalito);
    var registers = new Array();
    var reesend = new Array();

    // Tabla Principal
    getToken().then((data) => {
        token = data;
        initTable = $("#initTable").DataTable({
            language: espanol,
            ajax: {
                url: "https://apolo.tramisalud.com/Api/message/files?token=" +
                    data,
                dataSrc: "",
            },
            columns: [{
                    data: "idFile",
                    render: function(data) {
                        return `<strong>${data}</strong>`;
                    },
                },
                { data: "nameFile" },
                { data: "nameUsers" },
                { data: "nameInstituteAsigned" },
                { data: "dateCreate" },
            ],

            columnDefs: [{
                target: 5,
                orderable: false,
                data: null,
                render: function(data, type, row, meta) {
                    let boton = '';
                    if (data.resend == 0) {
                        boton = `<a class="btn p-1 send mensa" data-tooltip="Reenviar"><i class="fs-3 bi bi-send"></i></a>`
                    }
                    return `<div class="d-flex mt-2">
                            <a class="btn p-1 eye mensa" data-tooltip="Ver"><i class="fs-3 bi bi-eye"></i></a>
                            ${boton}                                                  
                            </div>`;
                },
            }, ],
            order: [
                [4, "desc"]
            ],
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $(nRow).on("click", ".eye", () => {
                    if ($("#sonUp").hasClass("quitCharge")) {
                        $("#sonUp").removeClass("quitCharge");
                    }
                    getDataRegisters(aData.idFile);
                });

                $(nRow).on("click", ".send", () => {
                    idGlobal = aData.idFile;
                    getDataForResend();
                });
            },
        });
    });
    // Reenvir datos de la lista
    $("#send").on("click", () => {
        butonsDisabled(true);
        alert("Se van a reenviar los datos, por favor no cierre esta ventana.");
        $("#sonUp").removeClass("quitCharge");
        let fileName = "reenvio-" + moment().format("L-H:mm:ss") + "-" + idGlobal;
        console.log(fileName);
        getDataForResend();
    });

    function getDataForResend() {
        let info = new Array();
        var registers;
        axios.get(`https://apolo.tramisalud.com/Api/message/registers?identifier=${idGlobal}&token=${token}`)
            .then((response) => response.data)
            .then((response) => {
                registers = response.filter((item) => {
                    return item.status == "1";
                }).map((item) => {
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
                    };
                });

                info = {
                    identifier: uuid.v4(),
                    nameFile: "reenvio-" + idGlobal + "-" + moment().format("L-H:mm:ss"),
                    idUser: $("#identifier").val(),
                    data: registers,
                };
                console.log(info);
            })
            .then(() => {
                if (registers.length >= 1) {
                    const urlFile = `https://apolo.tramisalud.com/Api/message/insert?token=${token}`;
                    axios.post(urlFile, JSON.stringify(info), {
                            headers: { "Content-Type": "application/json" },
                        }).then((data) => {
                            console.log(data.data);
                            if (data.data.Status === "0001") {
                                // aqui recarga la ventana
                                axios.put(`https://apolo.tramisalud.com/Api/traceability/UpdateStatusFile?token=${token}`,
                                    JSON.stringify({ idFile: idGlobal }), {
                                        headers: {
                                            "Content-Type": "application/json",
                                        },
                                    }
                                ).then((data) => {
                                    console.log(data);
                                    if (data.data.Message === "0005") {
                                        alert(data.data.Message);
                                        location.reload();
                                    }
                                });
                            }
                            alert(data.data.Message);
                            butonsDisabled(false);
                            $("#sonUp").addClass("quitCharge");
                        })
                        .catch((err) => {
                            alert("Muestre este error al administrado: " + err);
                            butonsDisabled(false);
                            $("#sonUp").addClass("quitCharge");
                        });
                } else {
                    alert(
                        "Actualmente ya no hay registros para reenviar, actualice la tabla para ver informacion mas reciente"
                    );
                }
            });
    }

    function getDataRegisters(id) {
        idGlobal = id;
        const titleRegister = document.querySelector(".modal-title");
        titleRegister.textContent = `Documento # ${id}`;

        let total = 0;
        let ad = 0;
        let and = 0;
        let confir = 0;
        let nothing = 0;
        let sg = 0;
        let sr = 0;
        let con = 0;
        let can = 0;
        let canTimeOut = 0;

        let urlRegisters = `https://apolo.tramisalud.com/Api/message/registers?identifier=${id}&token=${token}`;
        axios({
                method: "POST",
                url: urlRegisters,
            })
            .then((response) => response.data)
            .then((data) => {
                registers = data;
                total = data.length > 0 ? data.length : 0;
                tableRegister = $("#tableRegister").DataTable({
                    language: espanol,
                    data: data,
                    columns: [
                        { data: "typeDocument" },
                        { data: "document" },
                        { data: "name" },
                        { data: "cellPhone" },
                        { data: "dateAppointment" },
                        { data: "appointmentHour" },
                        { data: "medic" },
                        { data: "speciality" },
                        { data: "autorization" },
                        { data: "Type" },
                        {
                            data: "status",
                            render: function(data) {
                                switch (data) {
                                    case "1":
                                        row =
                                            '<td><span class="mensa" data-tooltip="Sin Respuesta"><i class="bx bx-check fs-2" ></i></span></td>';
                                        break;
                                    case "2":
                                        row =
                                            '<td><span class="mensa" data-tooltip="Confirmada"><i style="color:#53bdeb;" class="fs-2 bx bx-check-double"></i></span></td>';
                                        break;
                                    case "3":
                                        row =
                                            '<td><span class="mensa" data-tooltip="Cancelada"><i style="color:red;" class="fs-4 bi bi-x-octagon"></i></span></td>';
                                        break;
                                    case "7":
                                        row =
                                            '<td><span class="mensa" data-tooltip="Cancelada"><i style="color:orange;" class="fs-4 bi bi-hourglass"></i></span></td>';
                                        break;
                                    default:
                                        row =
                                            '<td><span class="mensa" data-tooltip="Sin Gestionar"><i style="color:#ffc800db;" class="bx bxs-message-rounded-minus fs-2" ></i></span></td>';
                                        break;
                                }
                                return row;
                            },
                        },
                    ],
                });
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
                }
                for (let i = 0; i < status.length; i++) {
                    switch (status[i]) {
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
                    canTimeOut: canTimeOut,
                });
                butonsDisabled(false);
                $("#sonUp").addClass("quitCharge");
            })
            .catch((err) => console.error(err));
        registerModal.show();
    }

    $("#initTable tbody .eye").on("click", function() {
        let datos = $(this).closest("tr").data();
        console.log(datos);
    });

    function botonUpdate() {
        update.removeAttribute("disabled");
        update.classList.add("btn-primary");
        update.classList.remove("btn-secondary");
    }

    function setStadistics(stadistics) {
        $("#total").val(stadistics.total);
        $("#ad").val(stadistics.ad);
        $("#and").val(stadistics.and);
        $("#confir").val(stadistics.confir);
        $("#nothing").val(stadistics.nothing);
        $("#sg").val(stadistics.sg);
        $("#sr").val(stadistics.sr);
        $("#con").val(stadistics.con);
        $("#can").val(stadistics.can);
        $("#canTimeOut").val(stadistics.canTimeOut);
    }

    function closeModal() {
        registers = [];
        tableRegister.destroy();
        $("#tableRegister").children("tbody").remove();
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
            canTimeOut: 0,
        });
    }

    $("#exit").on("click", () => registerModal.hide());

    $("#registerModal").on("hidden.bs.modal", () => closeModal());

    $("#update").on("click", () => {
        $("#sonUp").removeClass("quitCharge");
        butonsDisabled(true);
        tableRegister.destroy();
        $("#tableRegister").children("tbody").remove();
        console.log(idGlobal);
        getDataRegisters(idGlobal);
    });

    $("#export").on("click", () => arrayObjToCsv(registers, "Cargamasiva"));

    function butonsDisabled(status) {
        $("#send").prop("disabled", status);
        $("#export").prop("disabled", status);
        $("#update").prop("disabled", status);
        $("#exit").prop("disabled", status);
    }
});