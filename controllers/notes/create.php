<?php 

require('Validator.php');

// Connect to the database and execute a query.
$config = require('config.php');
$db = new Database($config['database'], 'root', 'root');

$heading = "Create Note";  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];


    if (! Validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = 'A body of no more than 1000 characteres is required.';
    }   

    if (empty($errors)) {
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 3
        ]);           
    }
}

require 'views/notes/create.view.php';   