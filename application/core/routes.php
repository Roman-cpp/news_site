<?php
namespace Application\Core;
use Application\Controller\error;
use Application\Controller\UserData;
//use application\controller\news;

class Routes
{
    private int $counter = 0;

    public function routeProcessing(array $routes, array $url)
    {
        foreach ($routes as $key => $array) {
            if($url[$this->counter] == $key) {

                if($url[$this->counter + 1]) {
                    $this->counter++;
                    return $this->routeProcessing($array['child'], $url);
                } else {
                    $class = new $array['controller'];

                    $function = $array['method'];

                    //установка языка на котором будут показываться новости
                    $class->$function(UserData::userLanguage());

                    return 0;
                }
            }
        }
        print_r($url);
        (new error)->error404();
    }
}