<?php
require 'model/database.php';
require 'model/player.php';
require 'model/first_team_db.php';
require 'utility/functions.php';
require 'model/fields.php';
require 'model/validate.php';
require 'model/login_db.php';

//create validate object
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('player-name');
$fields->addField('player-number');
$fields->addField('player-position');
$fields->addField('age');
$fields->addField('nationality');


// start session management with a persistent cookie
$lifetime = 60 * 60 * 24 * 7;  // 1 week in seconds

session_set_cookie_params($lifetime, '/');
session_start();

//create a session tag array if one does not exist
if (empty($_SESSION['log'])) {
    $_SESSION['log'] = array();
}

if(!empty($_POST)) {
    $_POST = array_map('trim', $_POST);
}

if (isset($_POST['action'])) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
} elseif (isset($_GET['action'])) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
} else {
    $action = 'list-player-details';
}

if ($action === 'list-player-details')
{
    $first_team = PlayerDB::getFirstTeamDetails();
    $pageTitle = 'Liverpool Player Details';
    include 'view/first_team_list.php';
}
elseif ($action === 'show-add-player')
{
    $pageTitle = 'Add Player';
    include 'view/first_team_add.php';
}
elseif ($action === 'add-player') {
    $playerName = filter_input(INPUT_POST, 'player-name');
    $playerNumber = filter_input(INPUT_POST, 'player-number');
    $playerPosition = filter_input(INPUT_POST, 'player-position');
    $age = filter_input(INPUT_POST, 'age');
    $nationality = filter_input(INPUT_POST, 'nationality');

    $validate->text('player-name', $playerName, true, 1, 50);
    $validate->pattern('player-number', $playerNumber, '/^([1-9]|[1-9][0-9])$/', 'Please enter a valid player number between 0 and 99');
    $validate->pattern('player-position', $playerPosition, '/^(Attacker|Defender|Midfielder|Goalkeeper)$/', 'Please choose one of the player positions from the drop down menu');
    $validate->pattern('age', $age, '/^([1-9]|[1-9][0-9])$/', 'Please enter correct numeric value for the age of the player');
    $validate->text('nationality', $nationality, true, 1, 25);


    if ($fields->hasErrors())
    {
        $error = 'All fields in the Add form must contain data. Please ensure all form elements contain appropriate values.';
        logErrorMessage($error);
        $pageTitle = 'Add Player';
        $playerNameError = $fields->getField('player-name')->getHTML();
        $playerNumberError = $fields->getField('player-number')->getHTML();
        $playerPositionError = $fields->getField('player-position')->getHTML();
        $ageError = $fields->getField('age')->getHTML();
        $nationalityError = $fields->getField('nationality')->getHTML();
        include 'view/first_team_add.php';
    } else {
        $player = new Player($playerName, $playerNumber, $playerPosition, $age, $nationality);
        PlayerDB::addPlayer($player);
        $first_team = PlayerDB::getFirstTeamDetails();
        $pageTitle = 'Liverpool Player List';
        header('Location:.');
    }
} elseif ($action === 'show-update-player')
{
    $id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $player = PlayerDB::getPlayer($id);
    $pageTitle = 'Update Player';
    include 'view/first_team_update.php';
} elseif ($action === 'update-player') {
    $id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $playerName = filter_input(INPUT_POST, 'player-name');
    $playerNumber = filter_input(INPUT_POST, 'player-number');
    $playerPosition = filter_input(INPUT_POST, 'player-position');
    $age = filter_input(INPUT_POST, 'age');
    $nationality = filter_input(INPUT_POST, 'nationality');

    $validate->text('player-name', $playerName, true, 1, 50);
    $validate->pattern('player-number', $playerNumber, '/^([1-9]|[1-9][0-9])$/', 'Please enter a valid player number between 0 and 99');
    $validate->pattern('player-position', $playerPosition, '/^(Attacker|Defender|Midfielder|Goalkeeper)$/', 'Please choose one of the positions for the player.');
    $validate->pattern('age', $age, '/^([1-9]|[1-9][0-9])$/', 'Please enter correct numeric value for the age of the player');
    $validate->text('nationality', $nationality, true, 1, 50);

    if ($fields->hasErrors())
    {
        $error = 'All fields in the Update form must contain data. Please ensure all form elements contain appropriate values.';
        logErrorMessage($error);
        $player = PlayerDB::getPlayer($id);
        $pageTitle = 'Update Player';
        $playerNameError = $fields->getField('player-name')->getHTML();
        $playerNumberError = $fields->getField('player-number')->getHTML();
        $playerPositionError = $fields->getField('player-position')->getHTML();
        $ageError = $fields->getField('age')->getHTML();
        $nationalityError = $fields->getField('nationality')->getHTML();
        include 'view/first_team_update.php';
    }
    else {
        $player = new Player($playerName, $playerNumber, $playerPosition, $age, $nationality);
        $player->setId($id);
        PlayerDB::updatePlayer($player);
        $first_team = PlayerDB::getFirstTeamDetails();

        $pageTitle = 'Liverpool Player List';
        header('Location:.');
    }
}elseif($action === 'show-delete-player'){
    $id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $player = PlayerDB::getPlayer($id);
    $pageTitle = 'Delete Player Confirmation';
    include 'view/first_team_delete.php';
}
elseif($action === 'delete-player'){
    $id = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_NUMBER_INT);
    $player = PlayerDB::getPlayer($id);
    $playerName = $player->getPlayerName();
    PlayerDB::deletePlayer($id, $playerName);
    $first_team = PlayerDB::getFirstTeamDetails();
    $pageTitle = 'Liverpool Player List';
    header('Location:.');
} elseif ($action === 'empty-log') {
    unset($_SESSION['log']);
    header('Location:.');
} elseif ($action === 'end-session'){
    $_SESSION = array(); //clear session data from memory
    session_destroy(); //clean up session ID

    //delete the cookie from the session
    $name = session_name();
    $expire = strtotime('-1 year');
    $params = session_get_cookie_params();
    $path = $params['path'];
    $domain = $params['domain'];
    $secure = $params['secure'];
    $httponly = $params['httponly'];
    setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
    header('Location:.');
} else if ($action === 'show-login-form'){
    $pageTitle = 'Log In';
    include 'view/login.php';
} else if ($action === 'show-register-form') {
    $pageTitle = 'Create Account';
    include 'view/register.php';
} else if ($action === 'register') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_STRING);

    if (empty($username)) {
        $errorUsername = 'Please enter a username.';
    } elseif(strlen($username) < 5){
        $errorUsername = 'The username must be at least 5 characters';
    } elseif (checkUsername($username) === true) {
        $errorUsername = 'This username is already taken.';
    }

    if (empty($password)) {
        $errorPassword = 'Please enter a password.';
    } else {
        if (strlen($password) < 9) {
            $errorPassword = 'The password must have at least 9 characters.<br>';
        }
        if (!preg_match('/[[:lower:]]/', $password)){
            $errorPassword .= 'The password must contain a lowercase letter.<br>';
        }
        if (!preg_match('/[[:upper:]]/', $password)){
            $errorPassword .= 'The password must contain an uppercase letter.<br>';
        }
        if (!preg_match('/[[:digit:]]/', $password)){
            $errorPassword .= 'The password must contain a number.<br>';
        }
        if (!preg_match('/[!@#%&|?]/', $password)){
            $errorPassword .= 'The password must contain at least one of these ! @ # % & | ? characters.<br>';
        }
    }

    if (empty($confirmPassword)) {
        $errorConfirmPassword = 'Please confirm the password.';
    } elseif ($confirmPassword !== $password) {
        $errorConfirmPassword = 'The passwords that were entered do not match.';
    }

    if(empty($errorUsername) && empty($errorPassword) && empty($errorConfirmPassword))
    {
        $userIP = $_SERVER['REMOTE_ADDR'];
        if (registerUser($username, $password, $userIP)) {
            header('Location:.?action=show-login-form');
        } else {
            $pageTitle = 'Create Account';
            include 'view/register.php';
        }
    } else {
        $pageTitle = 'Create Account';
        logErrorMessage('The account could not be created. Please see the errors below.');
        include 'view/register.php';
    }
} elseif ($action === 'log-in') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($username)) {
        $errorUsername = 'Please enter your username.';
    } elseif (checkUsername($username) === false) {
        $errorUsername = 'No account found with that username.';
    } else {
        if (empty($password)) {
            $errorPassword = 'Please enter your password.';
        } elseif (isValidLogin($username, $password) === false) {
            $errorPassword = 'The password is incorrect.';
        }
    }
    if (empty($errorUsername) && empty($errorPassword)) {
        session_start();
        $_SESSION['username'] = $username;
        header('Location:.');
    } else {
        $pageTitle = 'Log In';
        logErrorMessage('Unsuccessful log in attempt. Please see the error(s) below.');
        include 'view/login.php';
    }
} elseif ($action ==='log-out') {
    session_start();
    $_SESSION = array();
    session_destroy();
    session_start();
    logSuccessMessage('You have successfully logged out.');
    header('Location:.');
    exit();
}
else
{
    $error = "The <strong> $action </strong> action was not handled in the code.";
    logErrorMessage($error);
    $first_team = PlayerDB::getFirstTeamDetails();
    $pageTitle= 'Code Error';
    header('Location:.');
}