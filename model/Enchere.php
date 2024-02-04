<?php
class Enchere extends CRUD {
    protected $table = 'enchere';
    protected $primaryKey = 'id';
    protected $fillable = ['prix_depart', 'date_debut', 'date_fin', 'user_id', 'recommande'];

//------------------index---------------------//
    public function enchereIndex($etat = 'all') {
        // print_r($etat);
        $sql = "SELECT enchere.*, 
                timbre.id AS timbre_id, nom,
                recommande.enchere_id AS recommande_id
                FROM $this->table
                JOIN timbre ON enchere.id = timbre.enchere_id
                LEFT JOIN recommande ON enchere.id = recommande.enchere_id
                ";

        if ($etat == 'encours') {
            $sql .= " WHERE enchere.date_fin > NOW()";
        } elseif ($etat == 'passe') {
            $sql .= " WHERE enchere.date_fin <= NOW()";
        }

        $stmt = $this->prepare($sql);
        $stmt->execute();
        $encheres = $stmt->fetchAll();
        // print_r($encheres);
        // die();

        foreach ($encheres as &$enchere) {
            // $enchere['images'] = $this->getImages($enchere['id']);
            $enchere['firstImage'] = $this->getFirstImage($enchere['id']);
        }
        return $encheres;
    }

//------------------show---------------------//
    public function enchereShow($id){
        $sql = "SELECT enchere.*, 
                    recommande.enchere_id AS recommande_id,
                    timbre.id AS timbre_id,
		    favori.id AS favori_id,
                    timbre.nom, timbre.description, timbre.annee,
                    timbre.categorie_id, categorie.categorie, 
                    timbre.pays_id, pays.pays,
                    user.username, max_prix, 
                    GROUP_CONCAT(favori.user_id) AS favori_user_ids
                FROM $this->table
                LEFT JOIN recommande ON enchere.id = recommande.enchere_id
                JOIN timbre ON enchere.id = timbre.enchere_id
                JOIN categorie ON categorie.id = timbre.categorie_id
                JOIN pays ON pays.id = timbre.pays_id
                LEFT JOIN favori ON enchere.id = favori.enchere_id
                LEFT JOIN ( SELECT enchere_id, MAX(prix) AS max_prix
                    FROM mise GROUP BY enchere_id
                ) max_mise ON enchere.id = max_mise.enchere_id
                LEFT JOIN mise ON max_mise.enchere_id = mise.enchere_id AND max_mise.max_prix = mise.prix
                LEFT JOIN user ON mise.user_id = user.id
                WHERE enchere.id = $id
                GROUP BY enchere.id, recommande.id,
                    timbre.id, timbre.nom, timbre.description, timbre.annee,
                    timbre.categorie_id, categorie.categorie, 
                    timbre.pays_id, pays.pays,
                    user.username, max_prix
                ";

   	$stmt = $this->query($sql);
        $enchere = $stmt->fetch();
	//print_r($enchere);die;	

        $enchere['images'] = $this->getImages($id);
        $enchere['firstImage'] = $this->getFirstImage($id);  

        if (isset($enchere['favori_user_ids'])) {
            $enchere['favori_user_ids'] = explode(',', $enchere['favori_user_ids']);
        } else {
            $enchere['favori_user_ids'] = array(); 
        }
        //print_r($enchere);echo"<br><br>";die;

        return $enchere;
    }

    public function getImages($enchereId) {
        $sql = "SELECT image.filename
                FROM timbre
                JOIN image ON timbre.id = image.timbre_id
                WHERE timbre.enchere_id = :enchereId";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':enchereId', $enchereId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getFirstImage($enchereId) {
        $sql = "SELECT image.filename
                FROM timbre
                JOIN image ON timbre.id = image.timbre_id
                WHERE timbre.enchere_id = :enchereId
                LIMIT 1";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':enchereId', $enchereId);
        $stmt->execute();
        return $stmt->fetchColumn();  
    }

//------------------update---------------------//
    public function updateEnchere($id, $data) {
        try {
            $this->disableForeignKeyChecks();
    
            $setClauses = [];
            foreach ($data as $column => $value) {
                $setClauses[] = "$column = :$column";
            }
            $setClause = implode(', ', $setClauses);
    
            $sql = "UPDATE enchere
                    SET $setClause
                    WHERE id = :id";
    
            $data[':id'] = $id;
            $stmt = $this->prepare($sql);
            $stmt->execute($data);
    
            $this->enableForeignKeyChecks();
        } catch (Exception $e) {
            $this->enableForeignKeyChecks();
        }
    }
    
    private function disableForeignKeyChecks() {
        $sql = "SET foreign_key_checks = 0";
        $this->query($sql);
    }
    
    private function enableForeignKeyChecks() {
        $sql = "SET foreign_key_checks = 1";
        $this->query($sql);
    }

    //------------------delete---------------------//
    public function deleteEnchere($enchereId) {
        $this->deleteEnchereForeignKey($enchereId);

        return parent::delete($enchereId);
    }

    public function deleteEnchereForeignKey($enchereId) {
        try {
            $this->deleteEnchereFavori($enchereId);
            $this->deleteEnchereTimbre($enchereId);
        } catch (Exception $e) {

        }
    }

    public function deleteEnchereFavori($enchereId) {
        $sql = "DELETE FROM favori WHERE enchere_id = :enchereId";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':enchereId', $enchereId);
        $stmt->execute();
    }
    public function deleteEnchereTimbre($enchereId) {
        $sql = "DELETE FROM timbre WHERE enchere_id = :enchereId";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':enchereId', $enchereId);
        $stmt->execute();

        $this->deleteTimbreImages($enchereId);
    }
    public function deleteTimbreImages($enchereId) {
        $sql = "DELETE i FROM image i
                JOIN timbre t ON i.timbre_id = t.id
                WHERE t.enchere_id = :enchereId";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':enchereId', $enchereId);
        $stmt->execute();
    }
    public function deleteEnchereMise($enchereId) {
        $sql = "DELETE FROM mise WHERE enchere_id = :enchereId";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':enchereId', $enchereId);
        $stmt->execute();
    }
}
?>