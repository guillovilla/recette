<?php
class Contact extends CRUD {
    protected $table = 'contact';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'email', 'message'];
}
?>