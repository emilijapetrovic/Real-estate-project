<?php namespace App\Models;

use CodeIgniter\Model;
class ProhibitionUserModel extends Model
{
    protected $table         = 'prohibition';
    protected $allowedFields = [
        'IdA','IdU'
    ];
    
}