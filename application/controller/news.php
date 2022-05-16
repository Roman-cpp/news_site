<?php
namespace Application\Controller;

use Application\Models\Database;

class News extends \Application\Core\Controller
{
    public function showNews()
    {
        $data = (new Database)
            ->select('url_image', 'title', 'text')
            ->from('news')
            ->perform();

        echo $this->render('list_news', ['news' => $data]);
    }


    public function addNews()
    {
        if(isset($_POST['url_image']) or isset($_POST['title']) or isset($_POST['text'])) {
            (new Database)
                ->insert('news', ['url_image' => $_POST['url_image'], 'title' => $_POST['title'], 'text' => $_POST['text']])
                ->perform();
        }

        echo $this->render('add_news');
    }


    public function editNews()
    {
        if(isset($_POST['isDelete'])) {
            (new Database)
                ->delete('news')
                ->where('id = ' . $_POST['id'])
                ->perform();

        } elseif(isset($_POST['url_image']) or isset($_POST['title']) or isset($_POST['text'])) {
            (new Database)
                ->update('news')
                ->set(['url_image' => $_POST['url_image'], 'title' => $_POST['title'], 'text' => $_POST['text']])
                ->where('id = ' . $_POST['id'])
                ->perform();
        }

        $data = (new Database)
            ->select('id', 'url_image', 'title', 'text')
            ->from('news')
            ->perform();

        echo $this->render('edit_news', ['news' => $data]);
    }
}