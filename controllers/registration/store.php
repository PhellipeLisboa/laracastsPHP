<?php

use Core\Database;
use Core\Validator;
use Core\App;


$email = $_POST['email'];
$password = $_POST['password'];


// validate the form inputs.
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least 7 characteres.';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// check if the account already exists

$db = App::resolve(Database::class);

$result = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();


if ($user) {
    // then someone eith that email already exists and has an account.
    // If yes, redirect to a login page.
    header('location: /');
    exit();
} else {
    // Is not, save one to the database, and then log the user in, and redirect.
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => $password,
    ]);
}

// mark that the user has logged in.

$_SESSION['logged_in'] = true;
$_SESSION['user'] = [
    'email' => $email,
];

header('location: /');
exit();

//view('registration/create.view.php');