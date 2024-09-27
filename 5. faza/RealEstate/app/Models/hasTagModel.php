<?php namespace App\Models;

use CodeIgniter\Model;
class hasTagModel extends Model
{
    protected $table       = 'hastag';
    protected $allowedFields = [
         'IdAd', 'IdTag'
    ];
}