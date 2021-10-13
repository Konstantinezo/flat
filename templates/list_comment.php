<h2>Комментарии:</h2>
<?php
foreach ($comments as $comment) {
    ?>
    <div><?= $comment['author'] ?></div>
    <article class="comment"><?= $comment['comment'] ?></article>
    <?php
}
?>

