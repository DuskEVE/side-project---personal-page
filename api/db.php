<?php
session_start();
class myDB{
    private $host;
    private $charset;
    private $database;
    private $table;
    private $user;
    private $password;

    function __construct($host, $charset, $database, $user, $password, $table){
        $this->host = $host;
        $this->charset = $charset;
        $this->database = $database;
        $this->table = $table;
        $this->user = $user;
        $this->password = $password;
    }
    // 建構新的PDO物件來和資料庫互動
    function dbLogIn(){
        $dns = "mysql:host=$this->host;charset=$this->charset;dbname=$this->database";
        return new PDO($dns, $this->user, $this->password);
    }

    function switchUser($user, $password){
        $this->user = $user;
        $this->password = $password;
    }

    function switchDatabase($database){
        $this->database = $database;
    }

    function switchTable($table){
        $this->table = $table;
    }
    // 將目標關聯陣列轉換成符合SQL搜尋語法的字串
    function targetToString($target, $separator){
        $targetSet = [];
        foreach($target as $key=>$value){
            array_push($targetSet, "`$key`='$value'");
        }

        return implode($separator, $targetSet);
    }
    // 直接執行完整的sql語法
    function sql($sql){
        $pdo = $this->dbLogIn();
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // 搜尋並回傳符合條件的單筆資料
    function search($target){
        $pdo = $this->dbLogIn();
        $targetSet = $this->targetToString($target, "&&");
        $sql = "select * from `$this->table` where $targetSet";

        return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    // 搜尋並回傳符合條件的所有資料
    function searchAll($target=[], $option=""){
        $pdo = $this->dbLogIn();
        $sql = "select * from `$this->table`";
        if(count($target) != 0){
            $targetSet = $this->targetToString($target, "&&");
            $sql = "$sql where $targetSet";
        }
        if(strlen($option) > 0) $sql = $sql." $option";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // 新增或更新現有資料(透過輸入的陣列是否包含目標資料的id來辨別)
    function update($target){
        $pdo = $this->dbLogIn();
        $sql = "";

        if(isset($target['id'])){
            $id = $target['id'];
            unset($target['id']);
            $targetSet = $this->targetToString($target, ",");
            $sql = "update `$this->table` set $targetSet where `id`='$id'";
        }
        else{
            $cols = array_keys($target);
            $values = array_values($target);
            $sql = "insert into `$this->table`(`".implode("`,`", $cols)."`) values('".implode("','", $values)."')";
        }

        return $pdo->exec($sql);
    }
    // 刪除單筆指定的資料
    function delete($target){
        $pdo = $this->dbLogIn();
        $targetSet = $this->targetToString($target, "&&");
        $sql = "delete from `$this->table` where $targetSet";

        return $pdo->exec($sql);
    }
    // 回傳符合搜尋條件的資料筆數
    function count($target=[]){
        $pdo = $this->dbLogIn();
        $sql = "select count(*) from `$this->table`";
        if(count($target) != 0){
            $targetSet = $this->targetToString($target, "&&");
            $sql = "$sql where $targetSet";
        }

        $count = $pdo->query($sql)->fetch();
        return $count['count(*)'];
    }
}
// 宣告操作所有資料表所需的myDB物件
$User = new myDB('localhost', 'utf8', 'p01', 'root', '', 'p01_user');
$Banner = new myDB('localhost', 'utf8', 'p01', 'root', '', 'p01_banner');
$Type = new myDB('localhost', 'utf8', 'p01', 'root', '', 'p01_type');
$Gallery = new myDB('localhost', 'utf8', 'p01', 'root', '', 'p01_gallery');
$GalleryLike = new myDB('localhost', 'utf8', 'p01', 'root', '', 'p01_gallery_like');
$News = new myDB('localhost', 'utf8', 'p01', 'root', '', 'p01_news');

function getUrl($get){
    $targetSet = [];
    foreach($get as $key=>$value){
        array_push($targetSet, "$key=$value");
    }
    return "./index.php?".(join("&", $targetSet));
}
?>