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
            <label class="signature" for="name">Название новости</label>
            <input class="line_text" type="text" id="name" name="name" value="<?= $element['name'] ?>"/>
            <label class="signature" for="url_img">url картинки</label>
            <input class="line_text" type="text" id="url_img" name="url_img" value="<?= $element['url_img'] ?>"/>
            <label class="signature" for="language">язык</label>
            <input class="line_text" type="text" id="language" name="language" value="<?= $element['language_code'] ?>"/>
            <label class="signature" for="content">Описание новости</label>
            <textarea class="context_new" id="content" name="content"> <?= $element['content'] ?> </textarea>
            <input class="button" type="submit">
            <label for="isDelete">Удалить</label>
            <input type="checkbox" id="isDelete" name="isDelete">
        </div>
    </form>
<?php endforeach ?>
</body>
</html>
