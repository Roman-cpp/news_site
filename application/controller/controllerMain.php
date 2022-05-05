<?php
namespace Application\Controller;
use Application\models\DbTableNews;

class ControllerMain
{
    public function Draw()  : void
    {
        DbTableNews::DataTableNews();

        $main_page = file_get_contents('application/views/main_page/main.html');

        //news feed formation
        $list_news = '';
        for($i = 0; $i < count(DbTableNews::$table_rows); $i++)
        {
            $template_news = file_get_contents('application/views/main_page/template_news_outline.html');

            $template_news = str_replace('{url_img}', DbTableNews::$table_rows[$i][1], $template_news);
            $template_news = str_replace('{title}', DbTableNews::$table_rows[$i][2], $template_news);
            $template_news = str_replace('{text}', DbTableNews::$table_rows[$i][3], $template_news);

            $list_news = $list_news . $template_news;
        }

        echo $this->Render($main_page, ['content' => $list_news]);
    }

    private function Render($tmpl, array $params = []): string
    {
        ob_start();
        extract($params);
        eval('?>' . $tmpl . '<?php');
        return ob_get_clean();
    }
}