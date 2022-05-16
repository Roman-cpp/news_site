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
        <label class="signature" for="title">Название новости</label>
        <input class="line_text" type="text" id="title" name="title"/>
        <label class="signature" for="url_image">url картинки</label>
        <input class="line_text" type="text" id="url_image" name="url_image"/>
        <label class="signature" for="text">Описание новости</label>
        <textarea class="context_new" id="text" name="text"></textarea>
        <input class="button" type="submit">
    </div>
</form>
</body>
</html>