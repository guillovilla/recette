<?php
class Favori extends CRUD {
    protected $table = 'favori';
    protected $primaryKey = 'id';
    protected $fillable = ['enchere_id', 'user_id'];

    public function favoriId($enchere_id, $user_id){
        $sql = "SELECT id
                FROM favori
                WHERE user_id = $user_id AND enchere_id = $enchere_id
                ";
        
        $stmt = $this->query($sql);
        if ($stmt !== false) {
            $favoriId = $stmt->fetch();
            return $favoriId;
        } else {
            return null;
        }
    }
}
?>