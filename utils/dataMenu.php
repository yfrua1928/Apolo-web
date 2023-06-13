<?php
// Permisos: 0 -> SuperAdmin, 1 -> Admin, 2 -> employee 
$funcionales = array(
    "home" => [
        "module" => "home",
        "icon" => "bi bi-grid",
        "title" => "Principal",
        "permit" => [0, 1, 2]
    ],
    "upload" => [
        "module" => "upload",
        "icon" => "bi bi-cloud-upload",
        "title" => "Cargar Documentos",
        "permit" => [0, 1, 2]
    ],
    "download" => [
        "module" => "download",
        "icon" => "ri-calendar-todo-line",
        "title" => "Descarga Documentos",
        "permit" => [0, 1, 2]
    ],
    "waiting" => [
        "module" => "waiting",
        "icon" => "bi bi-hourglass-split",
        "title" => "Lista de Espera",
        "permit" => [0, 1, 2]
    ],
    "users" => [
        "module" => "users",
        "icon" => "bi bi-people",
        "title" => "Usuarios",
        "permit" => [0,1]
    ],
    "institutions" => [
        "module" => "institutions",
        "icon" => "bi bi-people",
        "title" => "Instituciones",
        "permit" => [0,1]
    ]
);
// Estos son los mudulos que salen despues del separador 'ADICIONAL'
$adds = array(
    
    "personal" => [
        "module" => "profile",
        "icon" => "bi bi-person-fill",
        "title" => "Perfil",
    ],
    "logout" => [
        "module" => "logout",
        "icon" => "bi bi-box-arrow-in-right",
        "title" => "Cerrar Sesion",
    ],
);