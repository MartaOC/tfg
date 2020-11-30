<?php

function prepareDataLogin($user)
{
    $session = new Session();
    $session->setAttribute('id', $user['id']);
    $session->setAttribute('nombre', $user['nombre']);
    $session->setAttribute('login', true);
    $session->setAttribute('isAdmin', $user['rol'] == "1");
}

function today()
{
    $datetime = new DateTime();
    return $datetime->format('Y-m-d H:i');
}

function isModeDebug()
{
    return MODE_DEBUG === TRUE;
}

function writeLog($type, $origin, $message)
{
    $log = new Log();
    $log->writeLine($type, $origin, $message);
    $log->close();
}
//logueado
function isLogged()
{
    $session = new Session();
    if (!$session->getAttribute('login')) {
        header('Location: /tfgPsico');
    }
}

function redirect_to_url($url)
{
    header("Location: " . $url);
}


