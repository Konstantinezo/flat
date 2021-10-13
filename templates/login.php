<!DOCTYPE html>
<html>
<head>
    <title>Авторизация в аккаунте</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        label span {
            display: block;
        }
        input {
            width: 25%;
            min-width: 400px;
        }

        textarea {
            width: 50%;
            height: 400px;
            min-width: 500px;
        }
    </style>
</head>
<body>
<form method="post">
    <div>
        <label>
            <span>Почта</span>
            <input name="email" type="text">
            <?php
            if (isset($error['email'])) {
                ?>
                <span style="color: #660000"><?= $error['email'] ?></span>
                <?php
            }
            ?>
        </label>
    </div>
    <div>
        <label>
            <span>Пароль</span>
            <input name="password" type="text">
            <?php
            if (isset($error['password'])) {
                ?>
                <span style="color: #660000"><?= $error['password'] ?></span>
                <?php
            }
            ?>
        </label>
    </div>
    <div>
        <input type="submit" value="Отправить">
    </div>
    <?php
    if (isset($error['auth'])) {
        ?>
        <span style="color: #660000"><?= $error['auth'] ?></span>
        <?php
    }
    ?>
</form>
</body>
</html>
