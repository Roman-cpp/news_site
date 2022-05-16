<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новости</title>
    <link rel="stylesheet" href="/CSS/edit_news_page_styles.css">
</head>
<body>
<div class="side_navigation">
    <a href="/news">Страница новостей</a>
</div>
<?php
foreach ($news as $element): ?>
    <form action="edit_news" method="post">
        <div class="news">
            <input class="box_text" type="text"  id="id" name="id" value="<?= $element['id'] ?>"/>
            <label class="signature" for="title">Название новости</label>
            <input class="line_text" type="text" id="title" name="title" value="<?= $element['title'] ?>"/>
            <label class="signature" for="url_image">url картинки</label>
            <input class="line_text" type="text" id="url_image" name="url_image" value="<?= $element['url_image'] ?>"/>
            <label class="signature" for="text">Описание новости</label>
            <textarea class="context_new" id="text" name="text"> <?= $element['text'] ?> </textarea>
            <input class="button" type="submit">
            <label for="isDelete">Удалить</label>
            <input type="checkbox" id="isDelete" name="isDelete">
        </div>
    </form>
<?php endforeach ?>
</body>
</html>
