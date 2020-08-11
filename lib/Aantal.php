<?php
class Aantal{
    
    private $db;
    private $count;
    
    public function __construct(){
        $this->db = new Database();    
    }
    
    public function GetAantal(){
        $results = $this->db->query("SELECT count(*) FROM `cadeau` WHERE bon in('voetbehandeling', 'voetreflex')");
        $this->count = $this->db->RowCount();
        return $results;
    }
    public function rowCountQuery()
    {
        return $this->count;
    }
}
?>
