<?php
class Image extends CRUD {
    protected $table = 'image';
    protected $primaryKey = 'id';
    protected $fillable = ['filename', 'timbre_id'];
}
?>