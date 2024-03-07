<?php 

use Core\Database;

// Connect to the database and execute a query.
$config = require(base_path('config.php'));
$db = new Database($config['database'], 'root', 'root');


$notes = $db->query('SELECT * FROM notes WHERE user_id = 3')->get();


view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes,
]);