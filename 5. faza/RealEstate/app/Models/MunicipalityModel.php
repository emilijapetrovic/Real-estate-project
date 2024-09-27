<?php namespace App\Models;

use CodeIgniter\Model;
class MunicipalityModel extends Model
{
    protected $table       = 'municipality';
    protected $allowedFields = [
        'Id', 'Name', 'City'
    ];
}