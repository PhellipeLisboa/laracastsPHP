<?php 

use Core\Response;

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
};

function urlIS($value) {
    return $_SERVER['REQUEST_URI'] === $value;
};

function abort($code = 404) {
    http_response_code($code);

    view("404.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if (! $condition) {
        abort($status);
    }
};


function base_path($path)
{
    return BASE_PATH . $path;
}


function view($path, $attributes = [])
{
    extract($attributes);   
    require base_path('views/' . $path);
}

function login($user) 
{
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = [
        'email' => $user['email'],
        'id' => $user['id'],
    ];

    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];
    session_destroy();


    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}