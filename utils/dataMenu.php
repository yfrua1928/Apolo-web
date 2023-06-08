<?php
// Permisos: 0 -> Admin, 1 -> employe, 2 -> user 
$funcionales = array(
    "home" => [
        "module" => "home",
        "icon" => "bi bi-grid",
        "title" => "Principal",
        "permit" => [0, 1]
    ],
    "upload" => [
        "module" => "upload",
        "icon" => "bi bi-cloud-upload",
        "title" => "Cargar Documentos",
        "permit" => [0,1]
    ],
    "download" => [
        "module" => "download",
        "icon" => "ri-calendar-todo-line",
        "title" => "Descarga Documentos",
        "permit" => [0,1]
    ],
    "waiting" => [
        "module" => "waiting",
        "icon" => "bi bi-hourglass-split",
        "title" => "Lista de Espera",
        "permit" => [0,1]
    ]
);
// Estos son los mudulos que salen despues del separador 'ADICIONAL'
$adds = array(
    
    // "personal" => [
    //     "module" => "profile",
    //     "icon" => "bi bi-person-fill",
    //     "title" => "Perfil",
    // ],
    "logout" => [
        "module" => "logout",
        "icon" => "bi bi-box-arrow-in-right",
        "title" => "Cerrar Sesion",
    ],
);