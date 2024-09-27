<?php namespace App\Models;

use CodeIgniter\Model;
class ActivityModel extends Model
{
    protected $table         = 'activity';
    protected $allowedFields = [
        'Id', 'Name'
    ];
}