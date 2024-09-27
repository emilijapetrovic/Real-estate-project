<?php namespace App\Models;

use CodeIgniter\Model;
class AgencyModel extends Model
{
    protected $table     = 'agency';
    protected $allowedFields = [
        'Id', 'Name', 'AverageMark'
    ];
      protected $validationRules    = [
        'Name'     => 'required|min_length[3]|max_length[20]',
        'Phone'    => 'required|regex_match[/^06[\d]{7,8}$/]'
    ];
      protected $validationMessages = [
         'Name'     =>[
             'required'  =>'Ime je obavezno polje',
             'min_length'=>'Ime mora imati bar 3 karaktera',
             'max_length'=>'Ime ne može imati više od 20 karaktera',
             ],
         'Phone'        =>[
             'required'  =>'Broj telefona je obavezno polje',
             'regex_match'=>'Telefon mora biti u formatu 06x xxx xxx(x)'
         ]
    ];
}