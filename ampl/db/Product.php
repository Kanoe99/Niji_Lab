<?php

namespace db;

class Product
{
    protected $table = "products";
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProductById($id)
    {
        $query = "SELECT * from `{$this->table}` where id = :id";
        $this->db->query($query, ['id' => $id]);

        return $this->db->find();
    }

    public function getAllProducts()
    {
        $query = "SELECT * from `{$this->table}`";
        $this->db->query($query);

        return $this->db->get();
    }
}
