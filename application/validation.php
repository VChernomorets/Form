<?php
session_start();

// Name of input and verification
$inputs = ['registration' => [], 'aboutMe' => []];
array_push($inputs['registration'], ['name' => 'mail', 'pattern' => '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/']);
array_push($inputs['registration'], ['name' => 'password', 'pattern' => '/^.{8,}$/']);
array_push($inputs['aboutMe'], ['name' => 'username', 'pattern' => '/^.{3,}$/']);
array_push($inputs['aboutMe'], ['name' => 'about-myself', 'pattern' => '/^.{5,}$/']);
array_push($inputs['aboutMe'], ['name' => 'location', 'pattern' => '/^.{2,}$/']);


/** We check every input. If the mail and password fields are valid, print the second form.
 * If the second form is valid, write the user information to the file.
 * @param $args list of parameters with their values.
 */
function formValidation($args){
    if(isset($args['registrationSave'])){
        registrationForm($args);
    }
    if (isset($args['aboutMeSave'])) {
        aboutMeForm($args);
    }
}

// Check on the validation form about yourself
function aboutMeForm($args){
    global $inputs;
    $_SESSION['aboutMeForm'] = true;
    if(checkInputs($args, $inputs['aboutMe'])){
        unset($_SESSION['flags']);
        unset($_SESSION['aboutMeForm']);
        writeAccount();
        session_destroy();
    }
}

// Write user to file
function writeAccount(){
    global $inputs;
    $fileName = ACCOUNT_FILE_PATH . $_SESSION['mail'] . ACCOUNT_FILE_EXTENSION;
    $date = [];
    foreach ($inputs as $formName){
        foreach ($formName as $input){
            array_push($date, [$input['name'] => $_SESSION[$input['name']]]);
        }
    }
    array_push($date, ['remember' => $_SESSION['remember']]);
    $file = fopen($fileName, 'w');
    fwrite($file, json_encode($date));
    fclose($file);
}

// registration form processing
function registrationForm($args){
    global $inputs;
    if(checkInputs($args, $inputs['registration'])){
        if(file_exists(ACCOUNT_FILE_PATH . $_SESSION['mail'] . ACCOUNT_FILE_EXTENSION)){
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