<form method="post">
    <div>
        <label>
            <span>Оставить комментарий</span>
            <textarea name="comment"><?= $comment ?></textarea>
<?php
if (isset($error['comment'])) {
    ?>
    <span style="color: #660000"><?= $error['comment'] ?></span>
    <?php
}
?>
</label>
</div>
<input name="author" type="hidden" value="admin">
<div>
    <input type="submit" value="Отправить">
</div>
</form>
