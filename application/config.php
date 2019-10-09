<?php
$dir = dirname(__DIR__);
return [
    'ACCOUNT_FILE_PATH' => $dir . DIRECTORY_SEPARATOR . 'application'. DIRECTORY_SEPARATOR .'accounts' . DIRECTORY_SEPARATOR,
    'ACCOUNT_FILE_EXTENSION' => '.json'
];

// Path to the folder with the files of accounts
define("ACCOUNT_FILE_PATH", 'application/accounts/');
// account file extensions
define("ACCOUNT_FILE_EXTENSION" , ".json");