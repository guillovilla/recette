<?php
class Timbre extends CRUD {
    protected $table = 'timbre';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'description', 'annee', 'enchere_id', 'categorie_id', 'pays_id'];
}
?>