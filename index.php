<?php 

require('functions.php');
require('Database.php');
//require('router.php');

// Connect to the database and execute a query.

$config = require('config.php');

$db = new Database($config['database']);
$posts = $db->query("SELECT * FROM posts")->fetchAll();

dd($posts);