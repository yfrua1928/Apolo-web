<?php
spl_autoload_register(function ($className) {
    include "controllers/" . $className . ".php";
});