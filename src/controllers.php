<?php

function show_login_action() {
    $email = trim($_POST['email'] ?? null);
    $password = trim($_POST['password'] ?? null);

    $error = [];

    // валидация
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($email)) {
            $error['email'] = 'Укажите email';
        }
        if (empty($password)) {
            $error['password'] = 'Укажите пароль';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($error) === 0) {
        if (check_auth($email, $password) !== '0') {
            setcookie('email', $email, time()+3600, '/');
            setcookie('pass', $password, time()+3600, '/');
            header('Location: /');
            exit;
        }
        $error['auth'] = 'Не верный логин или пароль';
    }

    require_once __DIR__ . '/../templates/login.php';
    exit;
}

function list_post_action()
{
    $posts = get_all_posts();
    require_once __DIR__ . '/../templates/list.php';
    exit;
}

function show_post_action($id)
{
    $post = get_post($id);
    if (!$post) {
        header('HTTP/1.1 404 Not Found');
        echo '<html><body><h1>Page Not Found</h1></body></html>';
        exit;
    }

    require_once __DIR__ . '/../templates/show.php';
}

function create_post_action()
{
    $author = $_COOKIE['email'];
    $title = trim($_POST['title'] ?? null);
    $body = trim($_POST['body'] ?? null);

    $error = [];

    // валидация
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($author)) {
            $error['author'] = 'Укажите автора';
        }
        if (empty($title)) {
            $error['title'] = 'Придумайте заголовок';
        }
        if (empty($body)) {
            $error['body'] = 'Напишите пост';
        }
    }

    // сохранение
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($error) === 0) {
        create_post($title, $author, $body);
        header('Location: /');
        exit;
    }

    require_once __DIR__ . '/../templates/create.php';
    exit;
}

function update_post_action($id, $title, $author, $body) {
    $title_new = trim($_POST['title'] ?? null);
    $body_new = trim($_POST['body'] ?? null);

    $error = [];

    // валидация
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($author)) {
            $error['author'] = 'Укажите автора';
        }
        if (empty($title_new)) {
            $error['title'] = 'Придумайте заголовок';
        }
        if (empty($body_new)) {
            $error['body'] = 'Напишите пост';
        }
    }

    // сохранение
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($error) === 0) {
        update_post($id, $title_new, $author, $body_new);
        header('Location: /');
        exit;
    }

    require_once __DIR__ . '/../templates/update.php';
    exit;
}

function create_comment_action($id_post)
{
    $author = $_COOKIE['email'];
    $comment = trim($_POST['comment'] ?? null);

    $error = [];

    // валидация
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($author)) {
            $error['author'] = 'Укажите автора';
        }
        if (empty($comment)) {
            $error['comment'] = 'Придумайте комментарий';
        }
    }

    // сохранение
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($error) === 0) {
        create_comment($comment, $author, $id_post);
        header('Location: /show/?id=' . $id_post);
        exit;
    }

    require_once __DIR__ . '/../templates/сreate_comment.php';
}

function list_comment_post_action($id)
{
    $comments = get_all_commemts_post($id);
    require_once __DIR__ . '/../templates/list_comment.php';
    exit;
}
