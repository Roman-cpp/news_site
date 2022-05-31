<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новости</title>
    <link rel="stylesheet" href="/CSS/main_page_styles.css">
</head>
<body>
<div class="side_navigation">
    <a href="news/add_news">Добавить новость</a>
    <a href="news/edit_news">Редактировать новости</a>
    <a href="\visit_statistics">Посещаемость сайта</a>
</div>


<select onchange="window.location='http://localhost/news?language=' + value">
    <option >Выбрать язык</option>
    <option value="en">en</option>
    <option value="ru">ru</option>
</select>


<?php
foreach ($news as $element): ?>
    <div class="news">
    <div>
        <img class="img_news" alt="" src="<?=$element['url_img'];?>">
    </div>
    <div class="title">
        <?=$element['name'];?>
    </div>
    <div class="paragraph">
        <?=$element['content'] . ' ' . $element['date'];?>
    </div>
</div>

<?php endforeach ?>
</body>
</html>
