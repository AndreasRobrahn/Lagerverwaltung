<?php
spl_autoload_register(function ($class) {
    require_once BASEPATH . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
});
