<?php

session_start();
require_once 'url.php';
require_once 'twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$user                            = $_SESSION['user']['usuid'];



if ($_SERVER['DOCUMENT_ROOT'] == '/var/www') {
    
    $loader = new Twig_Loader_Filesystem('forms/');
    #$twig = new Twig_Environment($loader, array('cache' => 'cache/'));
    $twig   = new Twig_Environment($loader);
} else {
    $loader = new Twig_Loader_Filesystem('/home/taskevolution/public_html/app/forms/');
    #$twig = new Twig_Environment($loader, array('cache' => '/home/nuevocomienzo/public_html/mmsv.com.ve/system/cache/'));
    $twig   = new Twig_Environment($loader);
}



if ($_SESSION) {
    $datos['sesion'] = $_SESSION;
}

function IMPORTANTE__($x)
{
    
    if (!$x) {
        session_destroy();
        echo $twig->render('login.html', array(
            'dato' => $datos
        ));
        exit;
    }
    
}




#Session validation


if ($_POST['usulog']) {
    
    
    $USER      = New userModelo();
    $USER_DATA = $USER->validation($_POST);
    if ($USER_DATA !== 0) {
        
        $_SESSION['user'] = $USER_DATA[0];
       // $LOG->log_inicio($_SESSION['user']);
        $datos['sesion'] = $_SESSION;
        
        $TASK = new taskModelo();
        unset($_SESSION['temp']['task_id']);
        $datos['datatable']            = $TASK->datatable_();
        $datos['archivo']              = 'task_list.html';
        $datos['notifications_sesion'] = $TASK->windows_task();
        $datos['notifications_modal']  = $TASK->windows_task();
        $datos['modulos'] .= $TASK->call_module('tskest', 'task');
        $datos['modulos'] .= $TASK->call_module('tskest_search', 'task');
        echo $twig->render($datos['archivo'], array(
            'dato' => $datos
        ));
        exit;
        
        
    } else {
        
        
        
        session_destroy();
        echo $twig->render('login.html', array(
            'dato' => $datos
        ));
        exit;
        
        
    }
    

}


# Task Controler


if ($_GET['opcion'] == 'task') {
    
    $TASK = new taskModelo();
    unset($_SESSION['temp']['task_id']);
    $datos['datatable']           = $TASK->datatable_();
    $datos['archivo']             = 'task_list.html';
    $datos['notifications_modal'] = $TASK->windows_task();
    
    $datos['modulos'] .= $TASK->call_module('tskest', 'task');
    $datos['modulos'] .= $TASK->call_module('tskest_search', 'task');
    
    
    echo $twig->render($datos['archivo'], array(
        'dato' => $datos
    ));
    exit;
}




session_destroy();
echo $twig->render('login.html', array(
    'dato' => $datos
));
exit;
?>
