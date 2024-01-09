<?php

class myDB{
    private $host;
    private $charset;
    private $database;
    private $table;
    private $user;
    private $password;

    function __construct($host, $charset, $database, $table, $user, $password){
        $this->host = $host;
        $this->charset = $charset;
        $this->database = $database;
        $this->table = $table;
        $this->user = $user;
        $this->password = $password;
    }

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

    function targetToString($target, $separator){
        $targetSet = [];
        foreach($target as $key=>$value){
            array_push($targetSet, "`$key`='$value'");
        }

        return implode($separator, $targetSet);
    }

    function sql($sql){
        $pdo = $this->dbLogIn();
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function search($target){
        $pdo = $this->dbLogIn();
        $targetSet = $this->targetToString($target, "&&");
        $sql = "select * from `$this->table` where $targetSet";

        return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

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
        echo $sql;
        return $pdo->exec($sql);
    }

    function delete($target){
        $pdo = $this->dbLogIn();
        $sql = "delete from `$this->table` where `id`='{$target['id']}'";

        return $pdo->exec($sql);
    }

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

?>