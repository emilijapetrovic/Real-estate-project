<!-- Autor:Luka Juskovic 2017/0674-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styleAdminUsers.css">
    <script src='/assets/javascript.js'></script>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Prototip</title>
</head>
<body>
    <nav>
        <div class="logo"><h4><a  href='/Home'>Success</a></h4></div>
        <ul class="nav-links">
            <li><a href='/Home'>Početna stranica</a></li>
            <li><a href='/Guest/search'>Pretraga</a></li>
            <li><a href='/Guest/Ads'>Oglasi</a></li>
            <li><a href='../Admin' class='login'>Moj profil</a></li>
            <li><a href='../Admin/logout' class='button register'>Odjavi se</a></li>    
        </ul>
                
        <div class="hidden-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
    <div class="containter">
        <main>
        <section class="glass">
            <div class='uredi'>
                <div class="imgcontainer">
                  <img src="/assets/images/admin.png" alt="Avatar" class="avatar">
                </div>
             
                <form style="width:100%;" method="post">
                    <ul class='lista'>
                    <h1 class='lista-naslov'>Agencije</h1>
                    <div class='box-container l'>
                        <input class='search'type='text' placeholder="Unesite korisnika">
                        <button class='polje'>Traži</button>
                    </div>
                <?php if (! empty($usersA)) : ?>
                <?php foreach ($usersA as $field => $data) : ?>
                      <li>
                        <span><?= $data['Name'] ?></span>
                        <div class="dropdown" style="margin-left: auto;">
                        <button type="button" value="Izaberi privilegije" class="dugme2 dropdown-toggle"  data-toggle="dropdown" style="width:100%;margin-left: 5px; margin-right: 5px;"/>
                        Izaberi privilegije</button>
                        <div class="dropdown-menu"> 
                            <?php 
                            $flag1=true;
                            $flag2=true;
                            
                            foreach ($prohibitions as $field => $proh){
                                if ($proh['IdU']==$data['Id'] && $proh['IdA']==1)
                                    $flag1=false;
                                else if ($proh['IdU']==$data['Id'] && $proh['IdA']==2)
                                    $flag2=false;
                            }
                            ?>
                            <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;"> <label>                                  
                                <input type="checkbox" name="commentA<?php echo $data['Id']; ?>" <?php echo ($flag2==1 ? 'checked' : '');?>>
                                &nbsp;Komentarisanje
                        </label></div>
                            <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;"> <label>
                                 <input type="checkbox" name="addA<?php echo $data['Id']; ?>" <?php echo ($flag1==1 ? 'checked' : '');?>>
                                 &nbsp;Dodavanje oglasa
                        </label></div>
                         <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;">
                             <input type="submit" name="actionAgency<?php echo $data['Id']; ?>" value="Promeni privilegije" class="adminButton dugme2" style="background-color: blue !important;"/>
                         </div>
                   
                        </div>
                        </div>
                        <input type="submit" name="actionAgency<?php echo $data['Id']; ?>" value="Ukloni korisnika" class="adminButton dugmeukloni">

                    </li>          
                <?php endforeach ?>
                <?php endif ?>                                   
                </ul>    
                    <br>
                <ul class='lista'>
                    <h1 class='lista-naslov'>Privilegovani korisnici</h1>
                    <div class='box-container l'>
                        <input class='search'type='text' placeholder="Unesite korisnika">
                        <button class='polje'>Traži</button>
                    </div>
                <?php if (! empty($usersP)) : ?>
                <?php foreach ($usersP as $field => $data) : ?>
                      <li>
                        <span><?= $data['Name']?> <?= $data['Surname'] ?>
                        </span>
         
                        <div class="dropdown" style="margin-left: auto;">
                        <button type="button" value="Izaberi privilegije" class="dugme2 dropdown-toggle"  data-toggle="dropdown" style="width:100%;margin-left: 5px; margin-right: 5px;"/>
                        Izaberi privilegije</button>
                            <div class="dropdown-menu" > 
                            <?php 
                            $flag1=true;
                            $flag2=true;
                            
                            foreach ($prohibitions as $field => $proh){
                                if ($proh['IdU']==$data['Id'] && $proh['IdA']==1)
                                    $flag1=false;
                                else if ($proh['IdU']==$data['Id'] && $proh['IdA']==2)
                                    $flag2=false;
                            }
                            ?>
                            <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;"> <label>                                  
                                <input type="checkbox" name="commentP<?php echo $data['Id']; ?>" <?php echo ($flag2==2 ? 'checked' : '');?>>&nbsp;Komentarisanje
                        </label></div>
                            <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;"> <label>
                                 <input  type="checkbox" name="addP<?php echo $data['Id']; ?>" <?php echo ($flag1==1 ? 'checked' : '');?>>&nbsp;Dodavanje oglasa
                        </label></div>
                         <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;">
                             <input type="submit" name="actionPrivileged<?php echo $data['Id']; ?>" value="Promeni privilegije" class="adminButton dugme2" style="background-color: blue !important;"/>
                         </div>
                   
                        </div>
                        </div>
                        
                        
                        
                        <input type="submit" name="actionPrivileged<?php echo $data['Id']; ?>" value="Ukloni korisnika" class="adminButton dugmeukloni">
                    </li>          
                <?php endforeach ?>
                <?php endif ?>                                   
                </ul> 
                    <br>
  
                    <form style="width:100%;" method="post">
                    <ul class='lista'>
                    <h1 class='lista-naslov'>Registrovani korisnici</h1>
                    <div class='box-container l'>
                        <input class='search'type='text' placeholder="Unesite korisnika">
                        <button class='polje'>Traži</button>
                    </div>
                <?php if (! empty($usersR)) : ?>
                <?php foreach ($usersR as $field => $data) : ?>
                      <li>
                        <span><?= $data['Name']?> <?= $data['Surname'] ?>
                        </span>
                        <div class="dropdown" style="margin-left: auto;">
                        <button type="button" value="Izaberi privilegije" class="dugme2 dropdown-toggle"  data-toggle="dropdown" style="width:100%;margin-left: 5px; margin-right: 5px;"/>
                        Izaberi privilegije</button>
                        <div class="dropdown-menu"> 
                            <?php 
                            $flag1=true;
                            $flag2=true;
                            
                            foreach ($prohibitions as $field => $proh){
                                if ($proh['IdU']==$data['Id'] && $proh['IdA']==1)
                                    $flag1=false;
                                else if ($proh['IdU']==$data['Id'] && $proh['IdA']==2)
                                    $flag2=false;
                            }
                            ?>
                            <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;"> <label>                                  
                                <input type="checkbox" name="commentR<?php echo $data['Id']; ?>" <?php echo ($flag2==1 ? 'checked' : '');?>>&nbsp;Komentarisanje
                        </label></div>
                            <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;"> <label>
                                 <input type="hidden" name="addR<?php echo $data['Id']; ?>" <?php echo ($flag1==1 ? 'checked' : '');?>>&nbsp;<!-- Dodavanje oglasa-->
                        </label></div>
                         <div class="dropdown-item" style="padding-left:3px; padding-right: 10px;">
                             <input type="submit" name="actionRegistered<?php echo $data['Id']; ?>" value="Promeni privilegije" class="adminButton dugme2" style="background-color: blue !important;"/>
                         </div>           
                        </div>
                        </div>
       
                        <input type="submit" name="actionRegistered<?php echo $data['Id']; ?>" value="Ukloni korisnika" class="adminButton dugmeukloni">
                    </li>          
                <?php endforeach ?>
                <?php endif ?>                                   
                </ul>  
                </form>
            </div>
        </section>
        <div class="circle1"></div>
        <div class="circle2"></div>
        </main>
    </div>
</body>
</html>