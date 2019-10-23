<?php
session_start();

// Name of input and verification
$inputs = ['registration' => [
    ['name' => 'mail', 'pattern' => '/^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/'],
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
function formValidation($args, $config)
{
    if (isset($args['registrationSave'])) {
        registrationForm($args, $config);
    }
    if (isset($args['aboutMeSave'])) {
        aboutMeForm($args, $config);
    }
}

//We check the sending form about ourselves, if everything is correct, add the information to the file.
function aboutMeForm($args, $config)
{
    global $inputs;
    $_SESSION['aboutMeForm'] = true;
    if (checkInputs($args, $inputs['aboutMe'])) {
        unset($_SESSION['flags']);
        unset($_SESSION['aboutMeForm']);
        editAccount($config, $args);
        session_destroy();
    } else {
        echo json_encode($_SESSION['flags']);
    }
}

// Add information to the file.
function editAccount($config, $args)
{
    $fileName = $config['ACCOUNT_FILE_PATH'] . $_SESSION['mail'] . $config['ACCOUNT_FILE_EXTENSION'];
    if (!file_exists($fileName)) {
        echo json_encode('Error: No account');
        return;
    }
    $account = json_decode(file_get_contents($fileName), true);
    global $inputs;
    foreach ($inputs['aboutMe'] as $input) {
        $account[$input['name']] = $args[$input['name']] ?? null;
    }
    $file = fopen($fileName, 'w');
    if ($account != null) {
        fwrite($file, json_encode($account));
    }
    fclose($file);
    echo json_encode(true);
}

// Write user to file
function createAccount($config, $args)
{
    global $inputs;
    $fileName = $config['ACCOUNT_FILE_PATH'] . $args['mail'] . $config['ACCOUNT_FILE_EXTENSION'];
    $data = [];
    foreach ($inputs as $formName) {
        foreach ($formName as $input) {
            $data[$input['name']] = $args[$input['name']] ?? null;
        }
    }
    $data['remember'] = $args['remember'] ?? false;
    $file = fopen($fileName, 'w');
    fwrite($file, json_encode($data));
    fclose($file);
}

// registration form processing
function registrationForm($args, $config)
{
    global $inputs;
    if (checkInputs($args, $inputs['registration'])) {
        $_SESSION['mail'] = $args['mail'];
        if (file_exists($config['ACCOUNT_FILE_PATH'] . $_SESSION['mail'] . $config['ACCOUNT_FILE_EXTENSION'])) {
            $_SESSION['flags']['accountExists'] = false;
        } else {
            createAccount($config, $args);
            $_SESSION['aboutMeForm'] = true;
        }
    }
    header("Location: index.php");
}

// Check list inputs
function checkInputs($args, $inputs)
{
    $result = true;
    foreach ($inputs as $input) {
        $name = $input['name'];
        $_SESSION['flags'][$name] = isset($args[$name]) ? preg_match($input['pattern'], $args[$name]) : false;
        if (!$_SESSION['flags'][$name]) {
            $result = false;
        }
    }
    return $result;
}