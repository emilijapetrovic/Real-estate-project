<?php

namespace App\Controllers;
use App\Models\adModel;
use App\Models\TagModel;
use App\Models\hasTagModel;
class Agency extends BaseController
{
	public function index()
	{
                $user=$this->session->get('User');
                if ($user['Type']!='agency'){                   
                return redirect()->to(site_url('Home'));
                }
                $user=$this->session->get('User');
		echo view('AgencyProfile',['user'=>$user]);
	}
        
        public function addAdvertisement(){
            $data=[];           
            helper(['form']);
            
            
             $user=$this->session->get('User');
                if ($user['Type']!='agency'){                   
                return redirect()->to(site_url('Home'));
                }
                
                else {
                    //check if adding advertisements is prohibited
                    
                    $sql="Select * from prohibition where IdA=1 And IdU=".$user['Id'];
                    $db = \Config\Database::connect();
                    $p=$db->query($sql);
                    if (sizeof($p->getResult())>0){
                        $message="Zabranjeno dodavanje oglasa!";
                        echo "<script>alert('$message');"
                                . "window.location='/Agency'</script>";
                    }
                }
              
            if ($this->request->getMethod()=='post'){
            //validation for user

                $poruka2="Uspešno dodat oglas.";
                $this->session->set('porukadodavanje', $poruka2);
                
                $advertisment=new adModel();
		//$id=$user->getInsertID();
                
                $type1=$_POST["tipNekretnine"];
                $type2=$_POST["vrstaUsluge"];
               
                $mesto = $_POST['Beograd'];  
       
              
               $owner=$this->session->get('User');
               

                $values=[
                    'IdOwner'=>$owner['Id'],
                    'Price'=>$this->request->getVar('cena'),
					'Topic'=>$this->request->getVar('naslov'),
					'Size'=>$this->request->getVar('kvadratura'),
					'Address'=>$this->request->getVar('adresa'),
					'IdPlace'=> $mesto,
					'Description'=>$this->request->getVar('komentar'),
                                        'Purpose'=>$type2,
                                        'RealEstateType'=>$type1
					
                ];   
                //add user
                            $advertisment->save($values);               
                            $idad= $advertisment->getInsertID();
                            if(!empty($_POST['check_list']))
                            {
                                foreach($_POST['check_list'] as $check)
                               {
                                     $model=new TagModel();
                                     $red=$model->where('Name',$check)->first();
                                     $idtag=$red['IdTag'];
                   
                                     $values=['IdAd'=>$idad, 'IdTag'=>$idtag];
                                     $model1=new hasTagModel();
                                     $model1->save($values);
                                }
                                }
                                
                                
		return redirect()->to('upload');
            
            
            
            //validation for 
            
              }
            
            
            echo view('addAdvertisement.php',['User'=>$user]);
          
        }
               
        public function upload()
       {
                $user=$this->session->get('User');
                if ($user['Type']!='agency'){                   
                return redirect()->to(site_url('Home'));
                }
                 else {
                    //check if adding advertisements is prohibited
                    
                    $sql="Select * from prohibition where IdA=1 And IdU=".$user['Id'];
                    $db = \Config\Database::connect();
                    $p=$db->query($sql);
                    if (sizeof($p->getResult())>0){
                        $message="Zabranjeno dodavanje slika!";
                        echo "<script>alert('$message');"
                                . "window.location='/Agency'</script>";
                    }
                }
                
         // If upload button is clicked ...
        if (isset($_POST['upload'])) {
      
            $msg = "";
    $db = mysqli_connect("localhost", "root", "", "realestate");        
    $sql = "SELECT Id 
    FROM advertisement 
    WHERE Id=(
    SELECT max(Id) FROM advertisement
    )";
    
           $result=mysqli_query($db, $sql);
           $niz= mysqli_fetch_array($result);
           $id=$niz["Id"];               
  
            
    $pathToFolder="assets/userImages/Advertisement".$id;
    
    
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
     
    if (!file_exists($pathToFolder))
         mkdir($pathToFolder);

        $folder=$pathToFolder."/".$filename;         
 
        $sql = "INSERT INTO image (filename,IdAd) VALUES ('$filename', '$id')";
        
        // Execute query
        mysqli_query($db, $sql);
  
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
 
 
		//return redirect()->to('/');
 
            //validation for             
              }
            
             echo view('addPicture.php',['user'=>$user]);
          
      
  }

	public function updateAdvertisement(){
                 $user=$this->session->get('User');
                 if ($user['Type']!='agency'){                   
                return redirect()->to(site_url('Home'));
                }
                 else {
                    //check if adding advertisements is prohibited                   
                    $sql="Select * from prohibition where IdA=1 And IdU=".$user['Id'];
                    $db = \Config\Database::connect();
                    $p=$db->query($sql);
                    if (sizeof($p->getResult())>0){
                        $message="Zabranjeno azuriranje oglasa!";
                        echo "<script>alert('$message');"
                                . "window.location='/Agency'</script>";
                    }
                }
$updateId=$user['Temp'];
$id=$user['Temp'];
$advertisment=new adModel();
$data=$advertisment->find($id);
       
       
        
 $price = $data['Price'];
 $size=$data['Size'];
 $topic=$data['Topic'];
 $address=$data['Address'];
 $idplace=$data['IdPlace'];
 $description=$data['Description'];
 $purpose=$data['Purpose'];
 $type=$data['RealEstateType'];
 
 /*
 
 $mysqli_connection = new mysqli("localhost", "root", "", "realestate");
$result = $mysqli_connection->query("SELECT IdTag FROM hastag where IdAd='2'");
$mysqli_connection->close();
 */
 

$db = mysqli_connect("localhost", "root", "", "realestate");
// Check connection
                if ($db->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                    }

                    
                    
                    
                    $hastag=new hasTagModel();
                    
                  //  $sql="SELECT * FROM hastag where IdAd='2'";
                   // $resultt= mysqli_query($db, $sql);
 
                    $result = $hastag->where('IdAd', $updateId)
                   ->findAll();
                    
                    
           
            if ($this->request->getMethod()=='post' && ($_POST['tipNekretnine'])){
            //validation for user
           
                 $db = mysqli_connect("localhost", "root", "", "realestate");
// Check connection
                if ($db->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                    }
                
                $poruka2="Uspešno ažuriran oglas.";
                $this->session->set('porukaoglas', $poruka2);
                
                $idoglasa=$updateId;
            
                $advertisments=new adModel();
		
                
               $red=$advertisments->where('Id',$updateId)->first();
                
                $type1=$_POST["tipNekretnine"];
                $type2=$_POST["vrstaUsluge"];
               
                $mesto = $_POST['Beograd'];  
       
                
            

                
              
             
            
           if($this->request->getVar('cena')!=null)
           {
               $price=$this->request->getVar('cena');
                     
               $sql = "UPDATE advertisement SET 
                Price = '".$price."'
           
                  WHERE Id='$updateId'";
               mysqli_query($db, $sql);
               
           }
           
               if($this->request->getVar('naslov')!=null)
               {
                 $topic=$this->request->getVar('naslov');
                 
                  $sql = "UPDATE advertisement SET 
                Topic = '".$topic."' WHERE Id='$updateId'";
               mysqli_query($db, $sql);
               
               }
              if($this->request->getVar('kvadratura')!=null)
              {
                  $size=$this->request->getVar('kvadratura');
                 
                  $sql = "UPDATE advertisement SET 
                Size = '".$size."' WHERE Id='$updateId'";
               mysqli_query($db, $sql);
                  
              }
              if($this->request->getVar('adresa')!=null)
              {
                  $address=$this->request->getVar('adresa');
                 
                 $sql = "UPDATE advertisement SET 
                 Address = '".$address."' WHERE Id='$updateId'";
                 mysqli_query($db, $sql);
                  
              }
              
                if($this->request->getVar('komentar')!=null)
              {
                  $description=$this->request->getVar('komentar');
                 
                 $sql = "UPDATE advertisement SET 
                 Description = '".$description."' WHERE Id='$updateId'";
                 mysqli_query($db, $sql);
                  
              }
              
              
              
                 
                 $sql = "UPDATE advertisement SET 
                 IdPlace = '".$mesto."' WHERE Id='$updateId'";
                 mysqli_query($db, $sql);
                 
                 
                 
                 $sql = "UPDATE advertisement SET 
                 Purpose = '".$type2."' WHERE Id='$updateId'";
                 mysqli_query($db, $sql);
                 
                 
                 $sql = "UPDATE advertisement SET 
                 RealEstateType = '". $type1."' WHERE Id='$updateId'";
                 mysqli_query($db, $sql);
                 
                 
                 $sql="DELETE FROM hastag WHERE IdAd='$updateId' ";
                 
                
                  mysqli_query($db, $sql);
                 
              

                            $idad=$updateId;
                            if(!empty($_POST['check_list']))
                            {
                                foreach($_POST['check_list'] as $check)
                               {
                                     $model=new TagModel();
                                     $red=$model->where('Name',$check)->first();
                                     $idtag=$red['IdTag'];
                   
                                     $values=['IdAd'=>$idad, 'IdTag'=>$idtag];
                                     $model1=new hasTagModel();
                                     $model1->save($values);
                                }
                                }
      
		return redirect()->to('upload');
            
            
            
            //validation for 
            
              }
              
              
            
             return view('updateAdvertisement', ['price' => $price,
                'topic'=>$topic,
                'size'=>$size,
                'address'=>$address,
                'idplace'=>$idplace,
                'description'=>$description,
                'purpose'=>$purpose,
                 'result'=>$result,
                'type'=>$type,
                 'User'=>$user]);
            echo view('updateAdvertisement.php',['User'=>$user]);
              
        }
   
          public function advertisements(){
            $user=$this->session->get('User');
                if ($user['Type']!='agency'){                   
                return redirect()->to(site_url('Home'));
                }
                    $sql="select * from advertisement where IdOwner=".$user['Id'];
                    $db = \Config\Database::connect();
                    $values=$db->query($sql);
                    $numberOfRows=count($values->getResult());
                    echo view('userAdvertisements',['values'=>$values,'numberOfRows'=>$numberOfRows,'User'=>$user]);
                  
        }
        
        public function changeAdvertisements() {
            $user=$this->session->get('User');
                if ($user['Type']!='agency'){                   
                return redirect()->to(site_url('Home'));
                }
                 else {
                    //check if adding advertisements is prohibited                   
                    $sql="Select * from prohibition where IdA=1 And IdU=".$user['Id'];
                    $db = \Config\Database::connect();
                    $p=$db->query($sql);
                    if (sizeof($p->getResult())>0){
                        $message="Zabranjeno azuriranje oglasa!";
                        echo "<script>alert('$message');"
                                . "window.location='/Privilegeduser'</script>";
                    }
                }
                if ($this->request->getMethod()=="post"){
            $ad=new \App\Models\adModel();
            $ads=$ad->where('IdOwner',$user['Id'])->findAll();
            foreach ($ads as $temp){
                if (isset($_POST['BDId'.$temp['Id']])){    
                    
                    //delete images from folder if exists                   
                    $dirname="assets/userImages/Advertisement".$temp['Id'];
                    if (file_exists($dirname)){
                    array_map('unlink', glob("$dirname/*.*"));
                    rmdir($dirname);
                    }
                    $ad->where('Id',$temp['Id'])->delete();      
                    $sqlforTags="Delete from hasTag where IdAd=".$temp['Id'];
                    $sqlForPictures="Delete from image where IdAd=".$temp['Id'];
                    $sqlComments="Delete from comment where IdAd=".$temp['Id'];
                    $sqlFavorites="Delete from favorites where IdAd=".$temp['Id'];
                    $db = \Config\Database::connect();
                    $db->query($sqlforTags);
                    $db->query($sqlFavorites);
                    $db->query($sqlForPictures);
                    $db->query($sqlComments);         
                    break;
                }
                else if (isset($_POST['BAId'.$temp['Id']])){
                    $user['Temp']=$temp['Id'];
                    $this->session->set('User',$user);
                    return redirect()->to(site_url('Agency/updateAdvertisement'));
                }
            }
            return redirect()->to(site_url('Agency/advertisements'));
                }
                
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
                'Name'=>$_POST['agencija'],
                'AverageMark' => $user['AverageMark'],
            ];
            $validatonRule=[
        'Username'     => 'required|min_length[3]|max_length[20]',
        'Email'        => 'required|min_length[6]|max_length[50]|valid_email',
        'Phone'        => 'required|regex_match[/^06[\d]{7,8}$/]',
        'Name'         => 'required|min_length[3]|max_length[20]'          
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
   
           'Phone'        =>[
             'required'  =>'Broj telefona je obavezno polje',
             'regex_match'=>'Broj je u formatu 06x xxx xxx(x)'
         ],
                'Name'=>[
                'required'  =>'Ime je obavezno polje',
                'min_length'=>'Korisničko ime mora imati bar 3 karaktera',
                'max_length'=>'Korisničko ime ne može imati više od 20 karaktera',
                ]
            ];
            $validation =  \Config\Services::validation();
            $validation->setRules($validatonRule,$errorMessages);
            $validData=$validation->run([
                'Username'=>$_POST['korime'],
                'Email'=>$_POST['email'],
                'Name'=>$_POST['agencija'],
                'Phone'=>$_POST['tel']
            ]);
            $db = \Config\Database::connect();
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
                    'Name'=>$_POST['agencija'],
                    'Type'=>$user['Type'],
                    'AverageMark' => $user['AverageMark'],
                    'Temp'=>''
                ];
                $user=$noviuser;
                $db = \Config\Database::connect();
                $id=$user['Id'];
                $username=$user['Username'];
                if($_POST['lozinka']!='')
                $password=$data1['Password'];
                $email=$user['Email'];
                $phone=$user['Phone'];
                $name=$user['Name'];
                $averageMark=$user['AverageMark'];
                $poruka="Informacije su uspešno sačuvane.";
                $this->session->set('Poruka',$poruka);
                $this->session->markAsFlashdata('Poruka');
                if ($_POST['lozinka']!='')
                $sqlUpdate="Update user set Username='$username', Password='$password',Email='$email',Phone='$phone' where Id=$id";
                else $sqlUpdate="Update user set Username='$username', Email='$email',Phone='$phone' where Id=$id";
                $sqlUpdate2="Update agency set Name='$name',AverageMark='$averageMark' where Id=$id";
                $db->query($sqlUpdate);
                $db->query($sqlUpdate2);
                $this->session->set('User',$user);
                return redirect()->to(site_url('Agency'));
            }
        
        echo view('izmena.php',['User'=>$user]);
}
                public function favorites(){
        $db = \Config\Database::connect();
        
        $user=$this->session->get('User');
        if ($user==null || $user['Type']!='agency'){
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
