<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\RegisteredUserModel;
use App\Models\PrivilegedUserModel;
use App\Models\AgencyModel;
use \App\Models\ProhibitionUserModel;
class Admin extends BaseController
{

	public function index()
	{
                $user=$this->session->get('User');
                if ($user['Type']!='admin'){                   
                return redirect()->to(site_url('Home'));
                }
             echo view('admin.php');
	}
        
   
        public function users(){
            $userAdmin=$this->session->get('User');
                if ($userAdmin['Type']!='admin'){                   
                return redirect()->to(site_url('Home'));
                }
             if ($this->request->getMethod()=="post"){
                
                //check if agency is changed
                $dataA=new AgencyModel();
                $usersA=$dataA->findAll();
                foreach ($usersA as $user){
                    $fieldName='actionAgency'.$user['Id'];
                    if (isset($_POST[$fieldName]))
                    {
                        if ($_POST[$fieldName]=='Promeni privilegije')
                        {
                            if (isset($_POST['commentA'.$user['Id']]))
                        {
                            $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();
                            
                            $idU=$user['Id'];
                            $idA=2;
                            $del="Delete from prohibition where IdA=? AND IdU=?";
                            $db->query($del,[$idA,$idU]);
                            
                        }
                        else {
                            
                            $db = \Config\Database::connect();
                            $idU=$user['Id'];
                            $idA=2;
                                                  
                            $proh=new ProhibitionUserModel();
                            $sql="Select * from prohibition where IdA=? AND IdU=?";
                            $obj=$db->query($sql, [$idA,$idU])->getResult();
                            if ($obj==null)
                            {
                                $data=['IdA'=>$idA,'IdU'=>$idU];
                                $proh->save($data);
                            }
                         
                        }
                        if (isset($_POST['addA'.$user['Id']]))
                        {
                            $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();
                            
                            $idU=$user['Id'];
                            $idA=1;
                            $del="Delete from prohibition where IdA=? AND IdU=?";
                            $db->query($del,[$idA,$idU]);
                        }
                        else {
                            $db = \Config\Database::connect();
                            $idU=$user['Id'];
                            $idA=1;
                                                  
                            $proh=new ProhibitionUserModel();
                            $sql="Select * from prohibition where IdA=? AND IdU=?";
                            $obj=$db->query($sql, [$idA,$idU])->getResult();
                            if ($obj==null)
                            {
                                $data=['IdA'=>$idA,'IdU'=>$idU];
                                $proh->save($data);
                            }
                        }
                        }
                        else {
                    $id=$user['Id'];;
                    $agency=new AgencyModel();
                    $user=new UserModel();
                    $agency->delete($id);
                    $user->delete($id);
                    
                    $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();                          
                            $idU=$user['Id'];
                            $del="Delete from prohibition where IdU=?";
                            $db->query($del,[$idU]);
                        }
                    }   
                }
         
                
                $dataP=new PrivilegedUserModel();
                $usersP=$dataP->findAll();
                 foreach ($usersP as $user){
                    $fieldName='actionPrivileged'.$user['Id'];
                    if (isset($_POST[$fieldName]))
                    {
                        if ($_POST[$fieldName]=='Promeni privilegije')
                        {
                            if (isset($_POST['commentP'.$user['Id']]))
                        {
                            $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();
                            
                            $idU=$user['Id'];
                            $idA=2;
                            $del="Delete from prohibition where IdA=? AND IdU=?";
                            $db->query($del,[$idA,$idU]);
                            
                        }
                        else {
                            
                            $db = \Config\Database::connect();
                            $idU=$user['Id'];
                            $idA=2;
                                                  
                            $proh=new ProhibitionUserModel();
                            $sql="Select * from prohibition where IdA=? AND IdU=?";
                            $obj=$db->query($sql, [$idA,$idU])->getResult();
                            if ($obj==null)
                            {
                                $data=['IdA'=>$idA,'IdU'=>$idU];
                                $proh->save($data);
                            }
                         
                        }
                        if (isset($_POST['addP'.$user['Id']]))
                        {
                            $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();
                            
                            $idU=$user['Id'];
                            $idA=1;
                            $del="Delete from prohibition where IdA=? AND IdU=?";
                            $db->query($del,[$idA,$idU]);
                        }
                        else {
                            $db = \Config\Database::connect();
                            $idU=$user['Id'];
                            $idA=1;
                                                  
                            $proh=new ProhibitionUserModel();
                            $sql="Select * from prohibition where IdA=? AND IdU=?";
                            $obj=$db->query($sql, [$idA,$idU])->getResult();
                            if ($obj==null)
                            {
                                $data=['IdA'=>$idA,'IdU'=>$idU];
                                $proh->save($data);
                            }
                        }
                        }
                        else {
                    $id=$user['Id'];;
                    $privileged=new PrivilegedUserModel();
                    $user=new UserModel();
                    $privileged->delete($id);
                    $user->delete($id);
                    
                    $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();                          
                            
                            $del="Delete from prohibition where IdU=?";
                            $db->query($del,[$id]);
                        }
                    }   
                }
         
                
                $dataR=new RegisteredUserModel();
                $usersR=$dataR->findAll();
                foreach ($usersR as $user){
                    $fieldName='actionRegistered'.$user['Id'];
                    if (isset($_POST[$fieldName]))
                    {
                        if ($_POST[$fieldName]=='Promeni privilegije')
                        {
                            if (isset($_POST['commentR'.$user['Id']]))
                        {
                            $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();
                            
                            $idU=$user['Id'];
                            $idA=2;
                            $del="Delete from prohibition where IdA=? AND IdU=?";
                            $db->query($del,[$idA,$idU]);
                            
                        }
                        else {
                            
                            $db = \Config\Database::connect();
                            $idU=$user['Id'];
                            $idA=2;
                                                  
                            $proh=new ProhibitionUserModel();
                            $sql="Select * from prohibition where IdA=? AND IdU=?";
                            $obj=$db->query($sql, [$idA,$idU])->getResult();
                            if ($obj==null)
                            {
                                $data=['IdA'=>$idA,'IdU'=>$idU];
                                $proh->save($data);
                            }
                         
                        }
                        if (isset($_POST['addR'.$user['Id']]))
                        {
                            $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();
                            
                            $idU=$user['Id'];
                            $idA=1;
                            $del="Delete from prohibition where IdA=? AND IdU=?";
                            $db->query($del,[$idA,$idU]);
                        }
                        else {
                            $db = \Config\Database::connect();
                            $idU=$user['Id'];
                            $idA=1;
                                                  
                            $proh=new ProhibitionUserModel();
                            $sql="Select * from prohibition where IdA=? AND IdU=?";
                            $obj=$db->query($sql, [$idA,$idU])->getResult();
                            if ($obj==null)
                            {
                                $data=['IdA'=>$idA,'IdU'=>$idU];
                                $proh->save($data);
                            }
                        }
                        }
                        else {
                    $id=$user['Id'];;
                    $registered=new RegisteredUserModel();
                    $user=new UserModel();
                    $registered->delete($id);
                    $user->delete($id);
                    
                    $db = \Config\Database::connect();
                            $proh=new ProhibitionUserModel();
                            
                            $del="Delete from prohibition where IdU=?";
                            $db->query($del,[$id]);
                        }
                    }
                    
                   
                }
           
                }
            
         
            $dataR=new RegisteredUserModel();
            $dataP=new PrivilegedUserModel();
            $dataA=new AgencyModel();
            $proh=new ProhibitionUserModel();
            $prohibitions=$proh->findAll();
                        
            $usersR=$dataR->findAll();
            $usersP=$dataP->findAll();
            $usersA=$dataA->findAll();
            return view('adminUsers', 
				['usersR' => $usersR,
                'usersP'=>$usersP,
                'usersA'=>$usersA,
                'prohibitions'=>$prohibitions]);
            echo view('adminUsers.php');
             
             
             
        }
        
        public function advertisements(){
            $user=$this->session->get('User');
                if ($user['Type']!='admin'){                   
                return redirect()->to(site_url('Home'));
                }
                    $sql="select * from advertisement";
                    $db = \Config\Database::connect();
                    $values=$db->query($sql);
                    $numberOfRows=count($values->getResult());
                    echo view('adminAdvertisments',['values'=>$values,'numberOfRows'=>$numberOfRows]);
                  
        }
        
        public function delete(){
            if ($this->request->getMethod()=='post'){ 
            $ad=new \App\Models\adModel();
            $ads=$ad->findAll();
            foreach ($ads as $temp){
                if (isset($_POST['BId'.$temp['Id']])){    
                    
                    //delete images from folder
                    
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
                    
                }
            }
            }
         
           return redirect()->to(site_url('Admin/advertisements'));
        }
        
       public function logout(){
        $this->session->destroy();
        return redirect()->to("/../../index.html");
    }
}
