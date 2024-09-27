<?php namespace App\Models;

use CodeIgniter\Model;
class UserModel extends Model
{
    protected $table         = 'user';
    protected $allowedFields = [
        'Username', 'Password', 'Email','Phone'
    ];
    
            protected $validationRules    = [
        'Username'     => 'required|min_length[3]|max_length[20]|is_unique[user.Username]',
        'Email'        => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.Email]',
        'Password'     => 'required|min_length[3]|max_length[20]',
        'PasswordAgain'=> 'required_with[Password]|matches[Password]',
        //'Phone'        => 'regex_match[/^06[\d]{7,8}$/]'
    ];
     protected $validationMessages = [
         'Username'     =>[
             'required'  =>'Korisničko ime je obavezno polje',
             'min_length'=>'Korisničko ime mora imati bar 3 karaktera',
             'max_length'=>'Korisničko ime ne može imati više od 20 karaktera',
             'is_unique' =>'Korisničko ime vec postoji'
             ],
        'Email'        => [
             'required'  =>'Email je obavezno polje',
             'min_length'=>'Email mora imati bar 6 karaktera',
             'max_length'=>'Email ne može imati više od 50 karaktera',
             'is_unique' =>'Uneti mejl vec postoji',
             'valid_email'=>'Morate uneti validnu email adresu'
        ],
         
         'Password'=>[
             'required'  =>'Lozinka je obavezno polje',
             'min_length'=>'Lozinka mora sadržati bar 3 karaktera',
             'max_length'=>'Lozinka može sadržati najviše 20 karaktera',  
         ],
         'PasswordAgain'=>[
             'required_with'=>'Povrda lozinke je obavezna',
             'matches'   =>'Lozinke moraju da se poklapaju'
         ],
         'Phone'        =>[
             'required'  =>'Broj telefona je obavezno polje',
             'regex_match'=>'Neispravan telefonski broj'
         ]
    ];
}