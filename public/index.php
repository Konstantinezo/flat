<?php

require_once __DIR__ . '/../src/models.php';
require_once __DIR__ . '/../src/controllers.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$auth = '0';

if (isset($_COOKIE['email']) && isset($_COOKIE['pass'])) {
    $auth = check_auth($_COOKIE['email'], $_COOKIE['pass']);
    //print_r($auth);
}

if ('/login/' === $uri || $auth === '0') {
    show_login_action();
}

if ('/index.php' === $uri || '/' === $uri) {
    list_post_action();
}

if ('/show/' === $uri && isset($_GET['id'])) {
    show_post_action($_GET['id']);
    create_comment_action($_GET['id']);
    list_comment_post_action($_GET['id']);
}

if ('/update/' === $uri && isset($_GET['id'])) {
    $post = get_post($_GET['id']);
    update_post_action($_GET['id'], $post['title'], $post['author'], $post['body']);
}

if('/create/' === $uri) {
    create_post_action();
}


header('HTTP/1.1 404 Not Found');
echo '<html><body><h1>Page Not Found</h1></body></html>';
