<?php
namespace Application\Controller;
use Application\Models\Database;

class News extends \Application\Core\Controller
{
    public function showNews(string $language):void
    {
        UserData::addIpUserDatabase();

        $data = (new Database)
            ->select('n.url_img', 'c.name', 'c.content', 'n.date')
            ->from('news as n')
            ->join('RIGHT', 'content_news as c', 'n.id = c.id_news')
            ->where("c.language_code = '$language'")
            ->perform();

        echo $this->render('list_news', ['news' => $data]);
    }


    public function addNews():void
    {
        if(isset($_POST['id']) and $_POST['id'] != '') {
            echo '*----';
                (new Database)
                    ->insert('content_news', ['id_news' => $_POST['id'], 'name' => $_POST['name'], 'content' => $_POST['content'], 'language_code' => $_POST['language']])
                    ->perform();
        }
        else if(isset($_POST['url_img']) or isset($_POST['content']) or isset($_POST['text']) or isset($_POST['language'])) {
            (new Database)
                ->insert('news',['url_img' => $_POST['url_img']] )
                ->perform();
            $id = (new Database)
                ->select('MAX(id)')
                ->from('news')
                ->perform();

            (new Database)
                ->insert('content_news', ['id_news' => $id[0]['MAX(id)'], 'name' => $_POST['name'], 'content' => $_POST['content'], 'language_code' => $_POST['language']])
                ->perform();
        }

        echo $this->render('add_news');
    }


    public function editNews():void
    {
        if(isset($_POST['isDelete'])) {
            (new Database)
                ->delete('news')
                ->where('id = ' . $_POST['id'])
                ->perform();

        } elseif(isset($_POST['url_img']) or isset($_POST['name']) or isset($_POST['content']) or isset($_POST['language'])) {
            (new Database)
                ->update('news as n, content_news as c')
                ->set(['n.url_img' => $_POST['url_img'], 'c.name' => $_POST['name'], 'c.content' => $_POST['content'], 'c.language_code' => $_POST['language']])
                ->where('n.id = ' . $_POST['id']. ' AND n.id = c.id_news;')
                ->perform();
        }

        $data = (new Database)
            ->select('n.id', 'n.url_img' ,'c.name', 'c.content', 'c.language_code')
            ->from('content_news as c')
            ->join('RIGHT', 'news as n', 'n.id = c.id_news')
            ->perform();

        echo $this->render('edit_news', ['news' => $data]);
    }
}