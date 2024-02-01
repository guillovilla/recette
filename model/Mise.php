<?php
class Mise extends CRUD {
    protected $table = 'mise';
    protected $primaryKey = 'id';
    protected $fillable = ['enchere_id', 'user_id', 'prix'];

    public function miseEnchere($id){
        $sql = "SELECT MAX(prix) AS prix
                FROM $this->table 
                JOIN enchere ON enchere.id = mise.enchere_id 
                JOIN user ON user.id = mise.user_id
                WHERE enchere_id = $id
                GROUP BY enchere_id
                ";
        $stmt = $this->query($sql);
        $miseEnchere = $stmt->fetch();
        // print_r($miseEnchere);die();
        return $miseEnchere;
    }
}
?>
