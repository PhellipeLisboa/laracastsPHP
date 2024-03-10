<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = APP::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// Validation

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a password.';
}

if (! empty($errors)) {
    return view('session/create.view.php', [
        'errors' => $errors
    ]);
}


// match the credentials
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();


if ($user) {
    if (password_verify($password, $user['password'])) {
        // login
        login([
            'email' => $email,
            //linha por conta própria
            'id' => $user['id']
        ]);
        
        header('location: /');
        exit();
    }
}

return view('session/create.view.php', [
    'errors' => [
        'email' => 'No matching account for that email address and password!'
    ]
]);


 