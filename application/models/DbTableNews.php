<?php
namespace Application\Models;

class DbTableNews extends DatabaseConnection
{
    public static array $table_rows = [[],[]];

    public static function DataTableNews(): void
    {
        self::DbConnect();
        $sql_command = 'select * from news';
        $result = self::$db_connect->query($sql_command);

        $i = 0;
        if($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
            {
                self::$table_rows[$i][] = $row['id'];
                self::$table_rows[$i][] = $row['url_image'];
                self::$table_rows[$i][] = $row['title'];
                self::$table_rows[$i][] = $row['text'];
                $i++;
            }
    }
    public static function InsertTableNews($title, $text, $url_image): void
    {
        self::DbConnect();
        $sql_command = self::$db_connect->prepare('INSERT INTO news (title, text, url_image) VALUES (?, ?, ?)');
        $sql_command->bind_param('sss', $title, $text, $url_image);
        $sql_command->execute();
        $sql_command->close();
    }
    public static function UpdateTableNews($id, $title, $text, $url_image):void
    {
        self::DbConnect();
        $sql_command = self::$db_connect->prepare('UPDATE news SET title = ?,  text = ?, url_image = ? WHERE id= ?;');
        $sql_command->bind_param('sssi', $title, $text, $url_image, $id);
        $sql_command->execute();
        $sql_command->close();
    }
    public static function DeleteRowTableNews($id): void
    {
        self::DbConnect();
        $sql_command = self::$db_connect->prepare('DELETE FROM news WHERE id=?');
        $sql_command->bind_param('i', $id);
        $sql_command->execute();
        $sql_command->close();
    }
}