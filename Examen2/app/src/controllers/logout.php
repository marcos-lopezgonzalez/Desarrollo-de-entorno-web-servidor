<?php

require __DIR__ . "/../../vendor/autoload.php";
session_start();
enviar_log("info", "Usuario deslogueado");
session_unset();
session_destroy();

header("Location: ./../views/login.php");
die;
