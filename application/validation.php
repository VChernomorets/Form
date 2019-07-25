<?php
session_start();
define('PATH', "application/accounts/");

/** We check every input. If the mail and password fields are valid, print the second form.
 * If the second form is valid, write the user information to the file.
 * @param $args list of parameters with their values.
 */
function formValidation($args)
{
    if (isset($args['registrationSave'])) {
        if (inputValidation($args, array('mail', 'password'))) {
            if(file_exists(PATH . $_SESSION['mail'] . ".json")){
                $_SESSION['flags']['accountExists'] = false;
            } else {
                $_SESSION['aboutMeForm'] = true;
                $_SESSION['remember'] = $args['remember'];
            }
        }
    }
    if (isset($args['aboutMeSave'])) {
        $_SESSION['aboutMeForm'] = true;
        if (inputValidation($args, array('username', 'location', 'about-myself'))) {
            unset($_SESSION['flags']);
            unset($_SESSION['aboutMeForm']);
            writeAccount();
            session_destroy();
        }
    }
}

/**
 * Write the account information to the file.
 */
function writeAccount(){
    $fileName = "application/accounts/" . $_SESSION['mail'] . '.json';
    $date = json_encode(
        [
            'mail' => $_SESSION['mail'],
            'password' => $_SESSION['password'],
            'username' => $_SESSION['username'],
            'location' => $_SESSION['location'],
            'about-myself' => $_SESSION['about-myself'],
            'remember' => $_SESSION['remember']
        ]);
    $file = fopen($fileName, 'w');
    fwrite($file, $date);
    fclose($file);
}

/**
 * We check for validity
 * @param $args inputs and their meanings
 * @param $inputs name of input
 * @return bool if at least one input is invalid - false
 */
function inputValidation($args, $inputs)
{
    $result = true;
    foreach ($inputs as $input) {
        $_SESSION['flags'][$input] = isset($args[$input]) ? checking($input, $args[$input]) : false;
        if ($_SESSION['flags'][$input]) {
            $_SESSION[$input] = $args[$input];
        } else {
            $result = false;
        }
    }
    return $result;
}


/**
 * We select a regular schedule, and check the value of the input
 * @param $name Name of the input
 * @param $value value of the input
 * @return false|int result of checking
 */
function checking($name, $value)
{
    $regexp = '';
    switch ($name) {
        case 'mail' :
            $regexp = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/';
            break;
        case 'password' :
            $regexp = '/^.{8,}$/';
            break;
        case 'username' :
            $regexp = '/^.{3,}$/';
            break;
        case 'about-myself' :
            $regexp = '/^.{5,}$/';
            break;
        case 'location' :
            $regexp = '/^.{1,}$/';
            break;
    }
    return preg_match($regexp, $value);
}