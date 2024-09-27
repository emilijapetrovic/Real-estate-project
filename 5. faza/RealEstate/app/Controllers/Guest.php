<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RegisteredUserModel;
use App\Models\PrivilegedUserModel;
use App\Models\AgencyModel;
use App\Models\AdminModel;
use App\Models\adModel;
use App\Models\CommentModel;
use App\Models\MarkModel;
use App\Models\FavoriteModel;
define('MAXINT','99999999999999999999999999');
class Guest extends BaseController
{
	public function index()
	{
                $user=$this->session->get('User');

		echo view('index.php',['User'=>$user]);
	}
       
        
        public function register(){
                       
            helper(['form']);
            
            if ($this->request->getMethod()=='post'){
            //validation for user                     
                $user=new UserModel();  
                
                $values=[
                    'Username'=>$this->request->getVar('username'),
                    'Password'=>$this->request->getVar('password'),
                    'Email'=>$this->request->getVar('email'),
                    'PasswordAgain'=>$this->request->getVar('passagain'),
                    'Phone'=>$this->request->getVar('phone')
                ];   
                
                $type=$_POST["type"];
                
                //add user
                if($user->validate($values)==false){
                return view('register', ['errors' => $user->errors()]);
                }
                
                //Admin is prohibited name for username              
                else if ($this->request->getVar('Username')=='Admin'){
                    $errors=['username' => 'Uneto korisnicko ime je zauzeto'];
                    return view('register',['errors'=>$errors]);
                }
                else if($type=="regular"){
                    $validation =  \Config\Services::validation();
                    $phoneNumber=$_POST['phone'];
                if ($phoneNumber!='')
                {
                    $validation->setRules([
                        'Phone'=> 'regex_match[/^06[\d]{7,8}$/]'],[
                            'Phone'=>[
                                'regex_match'=>'Telefon mora biti u formatu 06x xxx xxx(x)'
                            ]
                        ]);
                    if($validation->run(['Phone'=>$_POST['phone']])==false){
                        echo view('register.php',['User'=>$user,
                    'errors'=>$validation->getErrors()]);
                        return;
                    }
                }
                }
                
               //id will be changed after insert in user table
                $id=-1;
                
                
              //value for insert in other  table
               $userOtherTable=null;
               
               
              //check if regular privileged or agency
                    if ($type=="regular"){
                    $data=[
                        'Id'=>$id,
                        'Name'=>$this->request->getVar('name'),
                        'Surname'=>$this->request->getVar('surname')
                    ];
                $userOtherTable=new RegisteredUserModel();
                }
    
                else if ($type=="privileged"){
                    $data=[
                        'Id'=>$id,
                        'Name'=>$this->request->getVar('name'),
                        'Surname'=>$this->request->getVar('surname'),
                        'Phone'=>$this->request->getVar('phone')
                    ];
                $userOtherTable=new PrivilegedUserModel();
                }
                       
                else {
                    $v=0;
                    $data=[
                        'Id'=>$id,
                        'Name'=>$this->request->getVar('nameAgency'),
                        'Phone'=>$this->request->getVar('phone'),
                        'AverageMark'=>$v
                    ];
                $userOtherTable=new AgencyModel();
                }
                
                                
                if ($userOtherTable->validate($data)==false)
                    return view('register', ['errors' => $userOtherTable->errors()]);

                
                //values are correct and can be inserted
                $user->save($values);
                $data['Id']=$user->getInsertID();
                $userOtherTable->save($data);
      
		return redirect()->to('login');
            
              }
            
            
            echo view('register.php');
        }
        
        public function login(){
        
            helper(['form']);
        
            if ($this->request->getMethod()=='post'){
   
			$model = new UserModel();                        
			$user = $model->where('username', $this->request->getVar('username'))->first();
                                                 
                            if ($user==null){
                                
                                //check if admin wants to login
                                $adminModel=new AdminModel();
                                $admin=$adminModel->where('Username',$this->request->getVar('username'))->first();
                                
                                if ($admin==null)
                                {                          
                                $errors=['usernameLogin' => 'Uneti korisnik ne postoji'];
                                return view('login', ['errors' => $errors]);
                                }
                                
                                else if ($admin['Password']==$this->request->getVar('password')){
                                    $validationData=[
                                        'Id'=>$admin['Id'],
                                        'Username'=>$admin['Username'],
                                        'Type'=>'admin',
                                        'Temp'=>''
                                    ];
                                    $this->session->set('User',$validationData);
                                    return redirect()->to(site_url('Admin'));
                                }
                                else {
                                    $errors=['passwordLogin' => 'Uneta je pogresna sifra'];
                                    return view('login', ['errors' => $errors]);
                                }                              
                            }                          
                            if ($user['Password']!=$this->request->getVar('password'))
                            {
                                $errors=['passwordLogin' => 'Pogresna sifra'];
                                return view('login', ['errors' => $errors]);
                            }
                            
                                //check user type
                                $agency=new AgencyModel();
                                $isAgency=$agency->where('Id',$user['Id'])->first();
                                
                                $registered=new RegisteredUserModel();
                                $isRegistered=$registered->where('Id',$user['Id'])->first();
                                
                                $privileged=new PrivilegedUserModel();
                                $isPrivileged=$privileged->where('Id',$user['Id'])->first();
                                
                                
                                $validationData=[];
                        
                        if($isRegistered!=null){
                             $validationData=[
                                'Id'=>$user['Id'],
                                'Name'=>$isRegistered['Name'],
                                'Surname'=>$isRegistered['Surname'],
                                'Phone'=>$user['Phone'],
                                'Email'=>$user['Email'],
                                'Username'=>$user['Username'],
                                'Type'=>'registered',
                                'Temp'=>''
                            ];
                         
                        $this->session->set('User',$validationData);
                        return redirect()->to(site_url('Registereduser'));
                        }       
                                                                                      
                        else if ($isPrivileged!=null)
                        {
                            $validationData=[
                                'Id'=>$user['Id'],
                                'Name'=>$isPrivileged['Name'],
                                'Surname'=>$isPrivileged['Surname'],
                                'Phone'=>$user['Phone'],
                                'Email'=>$user['Email'],
                                'Username'=>$user['Username'],
                                'Type'=>'privileged',
                                'Temp'=>''
                            ];
      
                        $this->session->set('User',$validationData);
                        return redirect()->to(site_url('Privilegeduser'));
                        }
                        
                        else if ($isAgency!=null){
                            $validationData=[
                                'Id'=>$user['Id'],
                                'Name'=>$isAgency['Name'],
                                'Phone'=>$user['Phone'],
                                'Email'=>$user['Email'],
                                'Username'=>$user['Username'],
                                'AverageMark' => $isAgency['AverageMark'],
                                'Type'=>'agency',
                                'Temp'=>''
                            ];
                        }
                                              
			$this->session->set('User',$validationData);
                        return redirect()->to(site_url('Agency'));
                        
            }
             echo view('login.php');  
        }

        public function search(){
            $db = \Config\Database::connect();
            $user=$this->session->get('User');
            if ($this->request->getMethod()=="get" && isset($_GET['priceFrom'])){
                
                $priceFrom=$_GET['priceFrom'];
                $priceTo=$_GET['priceTo'];
                $sizeFrom=$_GET['sizeFrom'];
                $sizeTo=$_GET['sizeTo'];
                if ($priceTo==0){
                    $priceTo=MAXINT;
                }
                if ($sizeTo==0){
                    $sizeTo=MAXINT;
                }
           
                //get advertisments based on size and price
                $sql="(Select Id from advertisement where Price>='$priceFrom' and Price<='$priceTo' and Size>='$sizeFrom' and Size<='$sizeTo')";
                $purpose=$_GET['purpose'];
                //get advertisments based on place
                $sqlLocation="(Select Id from municipality";
                $GetAllPlaces="Select * from municipality";
                $places=$db->query($GetAllPlaces);
                $rememberPlaces="";
                $j=0;
                foreach ($places->getResult() as $place){
                    if (isset($_GET[$place->Id])){
                        if ($j==0){
                             $rememberPlaces=" WHERE ";
                             $j=$j+1;
                        }
                        else {
                            $rememberPlaces.=" OR ";
                        }
                        $rememberPlaces.="Id=".$place->Id;                        
                    }
                }
                $sqlLocation.=$rememberPlaces.")";
           
                
                //get advertisments based on size and price
                $sqlFindType="(Select Name from realestatetype";
                $GetAllTypes="Select * from realestatetype";               
                $typesQ=$db->query($GetAllTypes);
                $rememberTypes="";
                $j=0;
                foreach($typesQ->getResult() as $type){
                    if (isset ($_GET[$type->Name."".$type->Id])){
                        if ($j==0){
                             $rememberTypes=" WHERE ";
                             $j=$j+1;
                        }
                        else {
                            $rememberTypes.=" OR ";
                        }
                        $rememberTypes.="Id=".$type->Id;                                     
                    }
                }
                $sqlFindType.=$rememberTypes.")";
                //echo $rememberTypes;
                $sqlType="Select * from advertisement where Id In ".$sql."AND IdPlace In".$sqlLocation."AND RealEstateType In".$sqlFindType."AND Purpose='$purpose'";
                $values   = $db->query($sqlType);
                $numberOfRows=count($values->getResult());
                echo view('showAdvertisments',['values'=>$values,'numberOfRows'=>$numberOfRows,'User'=>$user]);
                return;
            }       

            $sqlMunicipalities="Select * from municipality";
            $municipalities=$db->query($sqlMunicipalities);
            $sqlTypes="Select * from realestatetype";
            $types=$db->query($sqlTypes);
            
            $user=$this->session->get('User');
            echo view('search',['municipalities'=>$municipalities,'types'=>$types,'User'=>$user]);
        }
        
        public function Ads(){
            //show all advertisements
                $db = \Config\Database::connect();
                $sqlType="Select * from advertisement";
                $values   = $db->query($sqlType);
                $numberOfRows=count($values->getResult());
            $user= $this->session->get('User');
            echo view('showAdvertisments',['values'=>$values,'numberOfRows'=>$numberOfRows,'User'=>$user]);
        }
        public function Add(){
            //show one advertisement
            $idsearchAdd=-1;
            $user=$this->session->get('User');
            if ($user!=null){
                $idsearchAdd=$user['Temp'];
            }
            
          
            $ad=new adModel();
            $ads=$ad->findAll();
            
            //check which advertisement is clicked
            foreach ($ads as $temp){
                if (isset($_GET['BId'.$temp['Id']])){
                    $own=new UserModel();
                    $owner=$own->find($temp['IdOwner']);
                    $pl=new \App\Models\MunicipalityModel();
                    $place=$pl->find($temp['IdPlace']);
                    $pics=new \App\Models\ImageModel();                  
                    $pictures=$pics->where('IdAd',$temp['Id'])->findAll();  
                    $tag=new \App\Models\hasTagModel();
                    $tags=$tag->where('IdAd',$temp['Id'])->findAll();
                    $user=$this->session->get('User');
                    if ($user!=null){
                        $user['Temp']=$temp['Id'];
                        $this->session->set('User',$user);
                    }

                    echo view('oneAdvertisment',['ad'=>$temp,'owner'=>$owner,'place'=>$place,'pictures'=>$pictures,'tags'=>$tags,'User'=>$user]);
                    return;
                }
            }   foreach ($ads as $temp){
                if (!isset($_GET['BId'.$temp['Id']]) && $temp['Id']==$idsearchAdd){
                    $own=new UserModel();
                    $owner=$own->find($temp['IdOwner']);
                    $pl=new \App\Models\MunicipalityModel();
                    $place=$pl->find($temp['IdPlace']);
                    $pics=new \App\Models\ImageModel();                  
                    $pictures=$pics->where('IdAd',$temp['Id'])->findAll();  
                    $tag=new \App\Models\hasTagModel();
                    $tags=$tag->where('IdAd',$temp['Id'])->findAll();
                    $user=$this->session->get('User');
                    if ($user!=null){
                        $user['Temp']=$temp['Id'];
                        $this->session->set('User',$user);
                    }
 
                    echo view('oneAdvertisment',['ad'=>$temp,'owner'=>$owner,'place'=>$place,'pictures'=>$pictures,'tags'=>$tags,'User'=>$user]);
                    return;
                }
            }
      
        }
       public function comment(){
             $user=$this->session->get('User');
             if ($user==null && $this->request->getMethod()=="post")
             {
                 $message="Korisnik mora biti ulogovan da bi komentarisao!";
                        echo "<script>alert('$message');"
                                . "window.location='/Guest/login'</script>";
                        
                         return;
             }
             else if ($user==null && $this->request->getMethod()!="post"){
                 return redirect()->to(site_url('Home'));
             }
            else if($this->request->getMethod()=='post'){
                $data=[
                        'IdK'=>$user['Id'],
                        'Time'=>$_POST['time'],
                        'IdAd'=>$user['Temp'],
                        'Description'=>$_POST['message']
                        ];
                $comment=new CommentModel();
                $comment->save($data);
                }
                return redirect()->to(site_url('Guest/Add'));
        }
        public function ocena(){
            $user=$this->session->get('User');
            if ($user==null)
             {
                 $message="Korisnik mora biti ulogovan da bi ocenjivao!";
                        echo "<script>alert('$message');"
                                . "window.location='/Guest/login'</script>";
                         return;
             }
            $ads=new adModel();
            $korisnici=new UserModel();
            $agency=new AgencyModel();
            if($this->request->getMethod()=='post'){
                $suma=0.0;
                $advert=$ads->find($user['Temp']);
                $agencija=$agency->find($advert['IdOwner']);
                $data=[];
                $data2=[];
                helper(['form']);
                $data=[
                        'IdK'=>$user['Id'],
                        'IdA'=>$advert['IdOwner'],
                        'Number'=>$_POST['ocjena']
                        ];
                $mark=new MarkModel();
                if($mark->where('IdK',$data['IdK'])->where('IdA',$data['IdA'])->find()){
                    $mark->replace($data);
                    $result=$mark->where('IdA',$data['IdA'])->findAll();
                    foreach ($result as $row){
                        $suma=$suma+$row['Number'];
                    }
                    $suma=$suma/count($result);
                    $data2=[
                        'Id'=>$agencija['Id'],
                        'Name'=>$agencija['Name'],
                        'AverageMark'=>$suma
                    ];
                    $agency->replace($data2);
                    return redirect()->to(site_url('Guest/Add'));
                }
                else{
                    $mark->save($data);
                    $result=$mark->where('IdA',$data['IdA'])->findAll();
                    foreach ($result as $row){
                        $suma=$suma+$row['Number'];
                        }
                    $suma=$suma/count($result);
                    $data2=[
                        'Id'=>$agencija['Id'],
                        'Name'=>$agencija['Name'],
                        'AverageMark'=>$suma
                    ];
                    $agency->replace($data2);
                    return redirect()->to(site_url('Guest/Add'));
                }
                }
        }
        public function favorite(){
            $user=$this->session->get('User');
            if ($user==null)
             {
                 $message="Korisnik mora biti ulogovan da bi dodavao u omiljene!";
                        echo "<script>alert('$message');"
                                . "window.location='/Guest/login'</script>";
                         return;
             }
            if($this->request->getMethod()=='post'){
                $data=[];
                helper(['form']);
                $data=[
                        'IdU'=>$user['Id'],
                        'IdAd'=>$user['Temp'],
                        ];
                $favorite=new FavoriteModel();
                if($favorite->where('IdU',$data['IdU'])->where('IdAd',$data['IdAd'])->find()){
                    $favorite->where('IdU',$data['IdU'])->where('IdAd',$data['IdAd'])->delete();
                    return redirect()->to(site_url('Guest/Add'));
                }
                else{
                    $favorite->save($data);
                    return redirect()->to(site_url('Guest/Add'));
                }
                }
        }
}


	

