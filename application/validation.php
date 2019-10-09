<?php
session_start();

// Name of input and verification
$inputs = ['registration' => [
    ['name' => 'mail', 'pattern' => '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/'],
    ['name' => 'password', 'pattern' => '/^.{8,}$/']
], 'aboutMe' => [
    ['name' => 'username', 'pattern' => '/^.{3,}$/'],
    ['name' => 'about-myself', 'pattern' => '/^.{5,}$/'],
    ['name' => 'location', 'pattern' => '/^.{2,}$/']
]];

/** We check every input. If the mail and password fields are valid, print the second form.
 * If the second form is valid, write the user information to the file.
 * @param $args list of parameters with their values.
 */
function formValidation($args, $config){
    if(isset($args['registrationSave'])){
        registrationForm($args, $config);
    }
    if (isset($args['aboutMeSave'])) {
        aboutMeForm($args, $config);
    }
}

// Check on the validation form about yourself
function aboutMeForm($args, $config){
    global $inputs;
    $_SESSION['aboutMeForm'] = true;
    if(checkInputs($args, $inputs['aboutMe'])){
        unset($_SESSION['flags']);
        unset($_SESSION['aboutMeForm']);
        writeAccount($config);
        session_destroy();
    }
}

// Write user to file
function writeAccount($config){
    global $inputs;
    $fileName = $config['ACCOUNT_FILE_PATH'] . $_SESSION['mail'] . $config['ACCOUNT_FILE_EXTENSION'];
    $data = [];
    foreach ($inputs as $formName){
        foreach ($formName as $input){
            array_push($data, [$input['name'] => $_SESSION[$input['name']]]);
        }
    }
    array_push($data, ['remember' => $_SESSION['remember']]);
    $file = fopen($fileName, 'w');
    fwrite($file, json_encode($data));
    fclose($file);
}

// registration form processing
function registrationForm($args, $config){
    global $inputs;
    if(checkInputs($args, $inputs['registration'])){
        if(file_exists($config['ACCOUNT_FILE_PATH'] . $_SESSION['mail'] . $config['ACCOUNT_FILE_EXTENSION'])){
            $_SESSION['flags']['accountExists'] = false;
        } else {
            $_SESSION['aboutMeForm'] = true;
            $_SESSION['remember'] = $args['remember'] ?? false;
        }
    }
}

// Check list inputs
function checkInputs($args, $inputs){
    $result = true;
    foreach ($inputs as $input){
        $name = $input['name'];
        $_SESSION['flags'][$name] = isset($args[$name]) ? check($args[$name], $input['pattern']) : false;
        if($_SESSION['flags'][$name]){
            $_SESSION[$name] = $args[$name];
        } else {
            $result = false;
        }
    }
    return $result;
}

function check($value, $pattern){
    return preg_match($pattern, $value);
}