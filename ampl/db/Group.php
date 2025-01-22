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
}
