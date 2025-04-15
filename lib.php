<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/lib/classes/event/user_loggedin.php');
use core\event\user_loggedin;
global $CFG;
require_once($CFG->libdir . '/dml/moodle_database.php');
require_once($CFG->libdir . '/filelib.php'); // Required for curl class.
require_once($CFG->libdir . '/classes/curl.php'); // Include the curl class.

/**
 * Callback que se ejecuta cuando un usuario inicia sesión.
 *
 * @param \ core\ event\ user_loggedin $event Evento de inicio de sesión.
 */
function local_debtblocker_user_loggedin($event) {
    global $DB;

    // Obtén el usuario que inició sesión.
    $userid = $event->relateduserid;
    $user = $DB->get_record('user', ['id' => $userid], '*', 'MUST_EXIST');

    // URL de la API REST externa.
    $apiurl = 'https://tudominio.com/api/deuda?username=' . urlencode($user->username);

    // Realiza la solicitud a la API.
    $curl = new \curl();
    $response = $curl->get($apiurl);

    // Decodifica la respuesta JSON.
    $data = json_decode($response);

    // Verifica si la respuesta contiene la clave "deuda".
    if (isset($data->deuda)) {
        if ($data->deuda === true) {
            // Si tiene deuda, suspende al usuario.
            if ($user->suspended == 0) {
                $DB->set_field('user', 'suspended', 1, ['id' => $user->id]);
            }
        } else {
            // Si no tiene deuda, desbloquea al usuario si está suspendido.
            if ($user->suspended == 1) {
                $DB->set_field('user', 'suspended', 0, ['id' => $user->id]);
            }
        }
    }
}