<?php
namespace Application\Controller;
use Application\Models\Database;
use SimpleXMLElement;

/**
 * Класс UserData предназначен для работы с данными пользователей и настройками пользователей
 */
class UserData extends \Application\Core\Controller
{
    /** функции формирует данные для вывода статистики
     * @return void
     */
    public function showChart(): void
    {
        $dataDate = (new Database)
            ->select('date', 'COUNT(date)')
            ->from('user_data')
            ->groupBy('date')
            ->orderBy('date')
            ->perform();

        $dates = [];
        $volumes = [];
        foreach ($dataDate as $element) {
            $dates[] =  $element['date'];
            $volumes[] = $element['COUNT(date)'];
        }

        echo $this->render('site_visit_statistics', ['dates' => $dates, 'volumes' => $volumes]);
    }

    /** функция отслеживает посещения сайта
     * @return void
     */
    public static function addIpUserDatabase():void
    {
        $curl = curl_init('https://api.db-ip.com/v2/free/self');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $resultArray = json_decode($result, true);

        $a = $resultArray['ipAddress'];
        curl_close($curl);

        $asd = (new Database)
            ->select('COUNT(ip)')
            ->from('user_data')
            ->where("date = CURDATE() AND ip = '$a'")
            ->perform();

        if($asd[0]['COUNT(ip)'] == 0) {
            (new Database)
                ->insert('user_data', ['ip' => $a])
                ->perform();
        }
    }

    /** функция работает с Cookie для отображения новостей с указанным языком
     * @return string
     */
    public static function userLanguage(): string
    {
        $language = '';
        if (isset($_GET['language'])) {
            $language = $_GET['language'];
            setcookie('language', $language, time() + 604800);
        } else if (isset($_COOKIE['language'])) {
            $language = $_COOKIE['language'];
        } else {
            $language = 'ru';
            setcookie('language', $language, time() + 604800);
        }
        return $language;
    }
}