<?php 

// Connect to the database and execute a query.
$config = require('config.php');
$db = new Database($config['database'], 'root', 'root');

$heading = "Notes";

$notes = $db->query('SELECT * FROM notes WHERE user_id = 3')->get();

require 'views/notes/index.view.php';