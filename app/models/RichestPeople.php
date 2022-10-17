<?php
  class Country {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getRich() {
      $this->db->query("SELECT * FROM `country`;");

      $result = $this->db->resultSet();

      return $result;
    }

    public function getSingleRich($id){
      $this->db->query("SELECT * FROM country WHERE id = :id");
      $this->db->bind(':id', $id, PDO::PARAM_INT);
      return $this->db->single();
    }

    public function deleteCountry($id){
      $this->db->query("DELETE FROM country WHERE id = :id");
      $this->db->bind("id", $id, PDO::PARAM_INT);
      return $this->db->execute();
    }

    public function createCountry($post){
      $this->db->query("INSERT INTO country(id, name, capitalCity, continent, population) 
                        VALUES(:id, :name, :capitalCity, :continent, :population)");

      $this->db->bind(':id', NULL , PDO::PARAM_INT);
      $this->db->bind(':name', $post["name"], PDO::PARAM_STR);
      $this->db->bind(':capitalCity', $post["capitalCity"], PDO::PARAM_STR);
      $this->db->bind(':continent', $post["continent"], PDO::PARAM_STR);
      $this->db->bind(':population', $post["population"], PDO::PARAM_INT);

      return $this->db->execute();
    }
  }

?>