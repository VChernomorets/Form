<?php
include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR .  'validation.php';
$config = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'config.php';


// We start form validation
formValidation($_POST, $config);
