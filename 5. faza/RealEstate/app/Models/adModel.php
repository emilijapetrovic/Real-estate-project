<?php namespace App\Models;

use CodeIgniter\Model;
class adModel extends Model
{
    protected $table       = 'advertisement';
    protected $allowedFields = [
        'IdOwner', 'Id', 'Time','Price','Topic','Size','Address','IdPlace','Description','Purpose','RealEstateType'
    ];
}