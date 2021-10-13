<!DOCTYPE html>
<html>
<head>
    <title><?= $post['title'] ?></title>
    <style>
        label span {
            display: block;
        }
        input {
            width: 25%;
            min-width: 400px;
        }

        textarea {
            width: 50%;
            height: 100px;
            min-width: 500px;
        }

        form {
            margin-top: 50px;
        }

        .comment {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<h1><?= $post['title'] ?></h1>
<div><?= $post['author'] ?></div>
<article><?= $post['body'] ?></article>
</body>
</html>
