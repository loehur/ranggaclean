<?php

class M_NoSQL
{
    private $db;

    public function __construct()
    {
        $this->db = NoSQL::getInstance();
    }

    //GET
    public function get($table)
    {
        $getAll = $this->db->retrieve($table);
        return json_decode($getAll, true);
    }

    public function get_where($table, $whereKey, $whereVal)
    {
        $return = array();
        $getAll = $this->get($table);
        foreach ($getAll as $a) {
            foreach ($a as $key => $val2) {
                if ($key == $whereKey && $val2 == $whereVal) {
                    return $return[$key] = $val2;
                }
            }
        }
        return $return;
    }
}
