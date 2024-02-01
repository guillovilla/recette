<?php
class Recommande extends CRUD {
    protected $table = 'recommande';
    protected $primaryKey = 'id';
    protected $fillable = ['enchere_id'];
}
?>