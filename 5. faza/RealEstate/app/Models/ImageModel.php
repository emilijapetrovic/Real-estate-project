<?php namespace App\Models;

use CodeIgniter\Model;
class ImageModel extends Model
{
    protected $table       = 'image';
    protected $allowedFields = [
        'Id', 'filename', 'IdAd'
    ];
}