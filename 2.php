<?php
/**
 * Created by PhpStorm.
 * User: tsybykov
 * Date: 19.02.19
 * Time: 15:27
 */

/*
 * Использовать PDO для удобства,уменьшить вероятность sql инъекций,так же для данного случая имеет смысл использовать IN чтобы сократить число обращений.

*/



ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once ('SingletonTrait.php');

class Db
{
    use \App\SingletonTrait;

    const OPTION = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    const PARAMS = [
    'host' => 'localhost',
    'dbname' => 'test_andromeda',
    'user' => 'admin',
    'password' => '12345678',
    'options' => self::OPTION
    ];

    public $table = 'account';
    protected $connection;
    protected $db_config;

    protected function init($data = null)
    {
        $this->db_config = self::PARAMS;
        $this->connection = $this->getConnection();
    }
    public function __destruct()
    {
        $this->connection = null;
    }
    protected function getConnection()
    {
        $this->db_name = $this->db_config['dbname'];
        $dsn = 'mysql:dbname='.$this->db_config['dbname'].';host='.$this->db_config['host'];
        $db = new \PDO($dsn,$this->db_config['user'],$this->db_config['password'],$this->db_config['options']);
        return  $db;
    }
    public function GetAccountById(string $id) :?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE `id` IN ({$id})";
        $resource = $this->getPdo($sql);
        $accounts = null;
        while ($row=$resource->fetch())
        {
            $accounts[]=$row;
        }
        return $accounts;
    }

    protected function getPdo($sql)
    {
        $result = $this->connection->prepare($sql);
        $result->execute();
        return $result;
    }
}

$accounts = null;
$params = $_GET['account_ids'] ?? null;

if($params){
    $accounts = Db::getInstance()->GetAccountById($params);
    if($accounts){
        foreach ($accounts as $account):?>
            <a href="/show_user.php?id=<?=$account['id']?>"><?=$account['fio']?></a><br>
        <?php endforeach;
    }
}