<?php

namespace db;

class Group
{
    protected $table = "groups";
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getGroupById($id)
    {
        $query = "SELECT * from `{$this->table}` where id = :id";
        $this->db->query($query, ['id' => $id]);

        return $this->db->find();
    }

    public function getAllGroups()
    {
        $query = "SELECT * from `{$this->table}`";
        $this->db->query($query);

        return $this->db->get();
    }

    public function getAllGroupsOfLevel($level)
    {
        $query = "SELECT * from `{$this->table}` where id_parent = :level";
        $this->db->query($query, ['level' => $level]);

        return $this->db->get();
    }

    public function getNumberOfLevels()
    {
        $query_id_parent = "SELECT id_parent from `{$this->table}`";
        $id_parent = $this->db->query($query_id_parent)->get();

        $query_id = "SELECT id from `{$this->table}`";
        $id = $this->db->query($query_id)->get();


        for ($i = 0; $i < 2; $i++) {

        }

        $max = max($levels)['id_parent'];



        return $max;
    }
}
