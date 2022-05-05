<?php

namespace Application\Controller;
use Application\models\DbTableNews;

class ControllerAddNews
{
    public function Draw()  : void
    {
        $this->Events();
        include'application/views/add_news_page/add_news.html';
    }

    private function Events()
    {
        //add news
        if(isset($_POST['title']))
            DbTableNews::InsertTableNews($_POST['title'], $_POST['text'], $_POST['url_image']);
    }
}