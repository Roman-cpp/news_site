<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>add news</title>
    <link rel="stylesheet" href="/CSS/add_news_page_styles.css">
</head>
<body>
<div class="side_navigation">
    <a href="/news">Страница новостей</a>
</div>
<form action="add_news" method="post">
    <div class="news">
        <label class="signature" for="name">Название новости</label>
        <input class="line_text" type="text" id="name" name="name"/>
        <label class="signature" for="url_img">url картинки</label>
        <input class="line_text" type="text" id="url_img" name="url_img"/>
        <label class="signature" for="content">Описание новости</label>
        <textarea class="context_new" id="content" name="content"></textarea>
        <label class="signature" for="language">Язык</label>
        <input class="line_text" type="text" id="language" name="language"/>
        <label class="signature" for="id">id не обезательно</label>
        <input class="line_text" type="text" id="id" name="id"/>
        <input class="button" type="submit">
    </div>
</form>
</body>
</html>