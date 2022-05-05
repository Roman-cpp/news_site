<?php

namespace Application\Controller;
use Application\Models\DbTableNews;

class ControllerEditNews
{
    public function Draw() : void
    {
        $this->Events();

        DbTableNews::DataTableNews();
        $edit_news_page = file_get_contents('application/views/edit_news_page/edit_news.html');

        $list_news = '';
        for($i = 0; $i < count(DbTableNews::$table_rows); $i++)
        {
            $template_news = file_get_contents('application/views/edit_news_page/template_news_outline.html');

            $template_news = str_replace('{id}', DbTableNews::$table_rows[$i][0], $template_news);
            $template_news = str_replace('{url_img}', DbTableNews::$table_rows[$i][1], $template_news);
            $template_news = str_replace('{title}', DbTableNews::$table_rows[$i][2], $template_news);
            $template_news = str_replace('{text}', DbTableNews::$table_rows[$i][3], $template_news);

            $list_news = $list_news . $template_news;
        }
        echo $this->Render($edit_news_page, ['content' => $list_news]);
    }

    private function Events()
    {
        //delete news by id
        if (isset($_POST['isDelete']))
            DbTableNews::DeleteRowTableNews($_POST['id']);

        //update news
        elseif (isset($_POST['title']))
            DbTableNews::UpdateTableNews($_POST['id'], $_POST['title'], $_POST['text'], $_POST['url_image']);
    }

    private function Render($tmpl, array $params = []): string
    {
        ob_start();
        extract($params);
        eval('?>' . $tmpl . '<?php');
        return ob_get_clean();
    }
}