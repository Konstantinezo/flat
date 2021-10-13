<?php

function db_connect()
{
    return new PDO('sqlite:' . __DIR__ . '/../var/db');
}

function db_disconnect(&$connection)
{
    $connection = null;
}

function check_auth($email, $pass) {
    $connection = db_connect();
    $statement = $connection->prepare('SELECT COUNT() FROM auth where email = ? and pass = ?');
    $statement->execute([$email, $pass]);
    $auth = $statement->fetchAll(PDO::FETCH_ASSOC);
    db_disconnect($connection);
    return $auth[0]['COUNT()'];
}

function get_all_posts()
{
    $connection = db_connect();
    $statement = $connection->query('SELECT * FROM post ORDER BY id DESC');
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    db_disconnect($connection);
    return $posts;
}

function get_post($id)
{
    $connection = db_connect();
    $statement = $connection->query('SELECT * FROM post WHERE id=? LIMIT 1');
    $statement->execute([$id]);

    $post = $statement->fetch(PDO::FETCH_ASSOC);

    db_disconnect($connection);

    return $post;
}

function create_post($title, $author, $body)
{
    $connection = db_connect();
    $qry = $connection->prepare(
        'INSERT INTO post (title, author, body) VALUES (?, ?, ?)'
    );

    $qry->execute([$title, $author, $body]);

    db_disconnect($connection);
}

function update_post($id, $title_new, $author, $body_new) {
    $connection = db_connect();
    $qry = $connection->prepare(
        'UPDATE post
                SET title = ?, author = ?, body = ?
                WHERE id = ?'
    );

    $qry->execute([$title_new, $author, $body_new, $id]);

    db_disconnect($connection);
}


function create_comment($comment, $author, $id_post)
{
    $connection = db_connect();
    $qry = $connection->prepare(
        'INSERT INTO comment (comment, author, id_post) VALUES (?, ?, ?)'
    );

    $qry->execute([$comment, $author, $id_post]);

    db_disconnect($connection);
}

function get_all_commemts_post($id_post)
{
    $connection = db_connect();
    $statement = $connection->query('SELECT * FROM comment WHERE id_post=' . $id_post . ' ORDER BY id DESC');
    $commemts = $statement->fetchAll(PDO::FETCH_ASSOC);
    db_disconnect($connection);
    return $commemts;
}
