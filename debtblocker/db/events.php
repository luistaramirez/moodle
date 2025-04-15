<?php
defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname'   => '\core\event\user_loggedin', // Evento de inicio de sesión.
        'callback'    => 'local_debtblocker_user_loggedin', // Función que se ejecutará.
        'includefile' => '/local/debtblocker/lib.php', // Archivo donde se encuentra la función.
        'priority'    => 1000, // Prioridad del evento.
    ],
];