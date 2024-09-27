<?php

namespace App\Controllers;
use App\Models\adModel;
use App\Models\TagModel;
use App\Models\hasTagModel;

class Registereduser extends BaseController
{
	public function index()
	{
                $user=$this->session->get('User');
                if ($user['Type']!='registered'){                   
                return redirect()->to(site_url('Home'));
                }
		echo view('RegisteredProfile',['user'=>$user]);
	}
            
        public function izmena(){
                    $data=[];
        helper(['form']);
        $user=$this->session->get('User');
        if($this->request->getMethod()=='post'){
            $data1=[
                    'Id'=>$user['Id'],
                    'Username'=>$_POST['korime'],
                    'Password'=>$_POST['lozinka'],
                    'Email'=>$_POST['email'],
                    'Phone'=>$_POST['tel'],
                    ];
            $data2=[
                'Id'=>$user['Id'],
                'Name'=>$_POST['ime'],
                'Surname'=>$_POST['prezime']
            ];
            $db = \Config\Database::connect();
            $validatonRule=[
        'Username'     => 'required|min_length[3]|max_length[20]',
        'Email'        => 'required|min_length[6]|max_length[50]|valid_email',
        'Name'     => 'required|min_length[3]|max_length[20]',
        'Surname'  => 'required|min_length[3]|max_length[20]'            
            ];
            $errorMessages=[
                'Username'=>[
                    'required'  =>'Korisničko ime je obavezno polje',
                    'min_length'=>'Korisničko ime mora imati bar 3 karaktera',
                    'max_length'=>'Korisničko ime ne može imati više od 20 karaktera',
                ],
             'Email' => [
             'required'  =>'Email je obavezno polje',
             'min_length'=>'Email mora imati bar 6 karaktera',
             'max_length'=>'Email ne može imati više od 50 karaktera',
             'valid_email'=>'Morate uneti validnu email adresu'
        ],
   
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
            $validation =  \Config\Services::validation();
            $validation->setRules($validatonRule,$errorMessages);
            $validData=$validation->run([
                'Username'=>$_POST['korime'],
                'Email'=>$_POST['email'],
                'Name'=>$_POST['ime'],
                'Surname'=>$_POST['prezime']
            ]);
            if ($validData==false){
                echo view('izmena.php',['User'=>$user,
                    'errors'=>$validation->getErrors()]);
                return;
            }
            else {
                $ime=$_POST['korime'];
                $email=$_POST['email'];
                $sqlUsername="Select * from user where Username='$ime' OR Email='$email'";
                if (sizeof($db->query($sqlUsername)->getResult())>1){
                    $errors=[
                        'Podaci'=>'Mejl ili korisnicko ime moraju biti jedinstveni'
                    ];
                    echo view('izmena.php',['User'=>$user,
                    'errors'=>$errors]);
                return;
                }
                
                
                
                //check phone number if exists
                $phoneNumber=$_POST['tel'];
                if ($phoneNumber!='')
                {
                    $validation->setRules([
                        'Phone'=> 'regex_match[/^06[\d]{7,8}$/]'],[
                            'Phone'=>[
                                'regex_match'=>'Telefon mora biti u formatu 06x xxx xxx(x)'
                            ]
                        ]);
                    if($validation->run(['Phone'=>$_POST['tel']])==false){
                        echo view('izmena.php',['User'=>$user,
                    'errors'=>$validation->getErrors()]);
                        return;
                    }
                }
                //check password if exists
                $pass=$_POST['lozinka'];
                if ($pass!=''){
                    $validation->setRules([
                            'Password'     => 'min_length[3]|max_length[20]'],[
                            'Password'=>[
                                'min_length'=>'Lozinka mora sadržati bar 3 karaktera',
                                'max_length'=>'Lozinka može sadržati najviše 20 karaktera',  
                            ]
                        ]);
                    if($validation->run(['Password'=>$_POST['lozinka']])==false){
                        echo view('izmena.php',['User'=>$user,
                    'errors'=>$validation->getErrors()]);
                        return;
                    }
                }
            }
                $noviuser=[
                    'Id'=>$user['Id'],
                    'Username'=>$_POST['korime'],
                    'Email'=>$_POST['email'],
                    'Phone'=>$_POST['tel'],
                    'Name'=>$_POST['ime'],
                    'Surname'=>$_POST['prezime'],
                    'Type'=>$user['Type'],
                    'Temp'=>''
                ];
                $user=$noviuser;
                $db = \Config\Database::connect();
                $id=$user['Id'];
                $username=$user['Username'];
                if ($_POST['lozinka']!='')
                $password=$data1['Password'];
                $email=$user['Email'];
                $phone=$user['Phone'];
                $name=$user['Name'];
                $surname=$user['Surname'];
                $poruka="Informacije su uspešno sačuvane.";
                $this->session->set('Poruka',$poruka);
                $this->session->markAsFlashdata('Poruka');
                if ($_POST['lozinka']!='')
                $sqlUpdate="Update user set Username='$username', Password='$password',Email='$email',Phone='$phone' where Id=$id";
                else $sqlUpdate="Update user set Username='$username', Email='$email',Phone='$phone' where Id=$id";
                $sqlUpdate2="Update registereduser set Name='$name', Surname='$surname' where Id=$id";
                $db->query($sqlUpdate);
                $db->query($sqlUpdate2);
                $this->session->set('User',$user);
                return redirect()->to(site_url('Registereduser'));
        }
                echo view('izmena.php',['User'=>$user]);
        }
        
        public function favorites(){
        $db = \Config\Database::connect();
        
        $user=$this->session->get('User');
        if ($user==null || $user['Type']!='registered'){
            return redirect()->to(site_url('Home'));
        }
        $sqlFavorites="Select * from advertisement where Id in (select IdAd from favorites where IdU=".$user['Id'].')';
        $favorites=$db->query($sqlFavorites);
        $numberOfRows=count($favorites->getResult());
        echo view('favorites.php',['User'=>$user,'values'=>$favorites,'numberOfRows'=>$numberOfRows]);
        }
        public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('Home'));
    }
    
}
