<?php 

use Core\Database;

// Connect to the database and execute a query.
$config = require(base_path('config.php'));
$db = new Database($config['database'], 'root', 'root');


$currentUserId = 3; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $note = $db->query('SELECT * FROM notes WHERE id = :id', [
        'id' => $_GET['id'] 
        ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query('DELETE FROM notes WHERE id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: /notes');
    exit();

} else {   

    $note = $db->query('SELECT * FROM notes WHERE id = :id', [
        'id' => $_GET['id'] 
        ])->findOrFail();
    

    authorize($note['user_id'] === $currentUserId);
    
    
    view("notes/show.view.php", [
        'heading' => 'Note',
        'note' => $note,
    ]);  
}