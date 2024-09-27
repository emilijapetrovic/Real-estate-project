<?php namespace App\Models;

use CodeIgniter\Model;
class MarkModel extends Model
{
    protected $table         = 'mark';
    protected $allowedFields = [
        'IdK','IdA','Number'
    ];
}