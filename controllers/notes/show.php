<?php 


use Core\Database;


// Connect to the database and execute a query.
$config = require(base_path('config.php'));
$db = new Database($config['database'], 'root', 'root');


$currentUserId = 1; 


$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id'] 
    ])->findOrFail();


authorize($note['user_id'] === $currentUserId);


view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note,
]);  