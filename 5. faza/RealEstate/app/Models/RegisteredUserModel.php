<?php namespace App\Models;

use CodeIgniter\Model;
class RegisteredUserModel extends Model
{
    protected $table         = 'registereduser';
    protected $allowedFields = [
        'Id','Name', 'Surname'
    ];
        protected $validationRules    = [
        'Name'     => 'required|min_length[3]|max_length[20]',
        'Surname'  => 'required|min_length[3]|max_length[20]',
    ];
      protected $validationMessages = [
         'Name'     =>[
             'required'  =>'Ime je obavezno polje',
             'min_length'=>'Ime mora imati bar 3 karaktera',
             'max_length'=>'Ime ne može imati više od 20 karaktera',
             ],
           'Surname'     =>[
             'required'  =>'Prezime je obavezno polje',
             'min_length'=>'Prezime mora imati bar 3 karaktera',
             'max_length'=>'Prezime ne može imati više od 20 karaktera',
             ]
    ];
}