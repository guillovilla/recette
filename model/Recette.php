<?php

class Recette extends CRUD 
{
    protected $table = 'recete';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'description', 'ingrediants', 'preparation'];

}
?>