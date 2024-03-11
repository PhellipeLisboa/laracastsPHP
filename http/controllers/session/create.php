<?php 


use Core\Session;


view('session/create.view.php', [
    'heading' => 'login',
    'errors' => Session::get('errors'),
]);