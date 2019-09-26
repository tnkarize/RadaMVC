<?php
include_once 'lib/Arrays/__arrays__.php';
class Track
{
    public $db;
    public $tb;
    public $attr;
    public $val;
    public $id;
    public $fn;
    public $pro;
    public function __construct($Track, $Database, $Table, $Attribute, $pid, $pro, $Value, $Function, $Warehouse)
    {
        if ($Track == 'Track')
        {
        $this->db = $Database;
        $this->tb = $Table;
        $this->attr = $Attribute;
        $this->val = $Value;
        $this->id = 300001;
        $this->pid = $pid;
        $this->pro = $pro;
        $this->ware = $Warehouse;
        if($Function == 'equalTo' || $Function == 'lessThan' || $Function == 'greaterThan')
        {
        $this->fn = $Function;
        }
        }
        else
        {
            exit();
        }
    }

    public function init($db, $pdb)
    {
        $array = new _array();
        $db->load_tables($db, $pdb);
        $check = $array->search_array($db->tb_list, 'trackings'.$this->db);
          if ($check != 'true')
        {
        $q = "CREATE TABLE trackings".$this->db." (
        id bigint(20) NOT NULL, 
        db VARCHAR(30) NOT NULL,
        tb VARCHAR(30) NOT NULL,
        Product_Id VARCHAR(256) NOT NULL PRIMARY KEY,
        product VARCHAR(30) NOT NULL,
        attr VARCHAR(50) NOT NULL,
        value VARCHAR(50) NOT NULL,
        function VARCHAR(50) NOT NULL,
        warehouse VARCHAR(50) NOT NULL
        )";
        $db->query($q, $pdb);
        $q1 = "INSERT INTO trackings".$this->db." (db, tb, Product_Id, attr, product, value, function, warehouse) 
        VALUES ('".$this->db."', '".$this->tb."', '".$this->attr."', '".$this->pid."', '".$this->pro."', '".$this->val."', '".$this->fn."', '".$this->ware."')";
            $db->query($q1, $pdb);
        }
        else if ($check == 'true')
        {
            $q = "INSERT INTO trackings".$this->db." (db, tb, Product_Id, attr, product, value, function, warehouse) 
        VALUES ('".$this->db."', '".$this->tb."', '".$this->attr."', '".$this->pid."', '".$this->pro."', '".$this->val."', '".$this->fn."', '".$this->ware."')";
            $db->query($q, $pdb);
        }
    }
    public function equalTo($v, $v1)
    {
        if ($v == $v1)
        return true;
        else
        return false;
    }
    public function greaterThan($v, $v1)
    {
        if ($v > $v1)
        return true;
        else
        return false;
    }
    public function lessThan($v, $v1)
    {
        if ($v < $v1)
        return true;
        else
        return false;
    }
    public function setTracking ($v, $v1)
    {
        if ($this->Function == 'equalTo')
        {
            $this->equalTo($v, $v1);
        }
        else if ($this->Function == 'greaterThan')
        {
            $this->greaterThan($v, $v1);
        }
        else if ($this->Function == 'lessThan')
        {
            $this->lessThan($v, $v1);
        }
    }
}
?>