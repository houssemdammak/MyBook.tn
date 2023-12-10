<?php
require_once 'Model.php';
class ModelSession extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'users');
    }
    

}