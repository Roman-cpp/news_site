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
</div>
<?php
foreach ($news as $element): ?>
    <div class="news">
    <div>
        <img class="img_news" alt="" src="<?=$element['url_image'];?>">
    </div>
    <div class="title">
        <?=$element['title'];?>
    </div>
    <div class="paragraph">
        <?=$element['text'];?>
    </div>
</div>

<?php endforeach ?>
</body>
</html>
