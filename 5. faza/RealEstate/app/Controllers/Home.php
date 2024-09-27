<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
                $user=$this->session->get('User');
                if ($user==null)
		echo view('index.php',['User'=>null]);
                else {
                    //echo $user['Username'];
                    //return;
                    echo view ('index.php',['User'=>$user]);
                }
	}
}
