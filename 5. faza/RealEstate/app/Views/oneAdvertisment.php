<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/styleAds.css">
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
     
      
      <div class="logo"><h4><a href='/Home'>Success</a></h4></div>
        <ul class="nav-links">
            <li><a href='/Home'>Početna stranica</a></li>
            <li><a href='search'>Pretraga</a></li>
            <li><a href='Ads'>Oglasi</a></li>
            <?php             
            if ($User==null) {
            echo"<li><a href='login' class='login'>Prijavite se</a href></li>";
            echo "<li><a href='register' class='button register'>Registrujte se</a></a href></li>";           
            }
            else if ($User['Type']=='registered'){                   
                   echo"<li><a href='/Registereduser' class='login'>Moj profil</a href></li>";
            echo "<li><a href='/Registereduser/logout' class='button register'>Odjavi se</a></a href></li>";
                }
                else if ($User['Type']=='agency'){
                   echo"<li><a href='/Agency' class='login'>Moj profil</a href></li>";
                   echo"<li><a href='/Agency/logout' class='button register'>Odjavi se</a></a href></li>";
                }
                else if ($User['Type']=='privileged'){
                    echo "<li><a href='/Privilegeduser' id='myProf' class='login'>Moj profil</a></li>";
                    echo "<li><a href='/Privilegeduser/logout'class='button register'>Odjavi se</a></li>";
                }
                else if ($User['Type']=='admin'){
                    echo "<li><a href='/Admin' id='myProf'class='login'>Moj profil</a></li>";
                    echo "<li><a href='/Admin/logout'class='button register'>Odjavi se</a></li>";
                }
            ?>
        </ul>
  
       <div class="hidden-menu" style="margin:0px !important; padding:0 !important;">
           <div class="line1"></div>
           <div class="line2"></div>
           <div class="line3"></div>
       </div>
   </nav>
 
    <div class="containter">
     <main style="margin-top:0% !important;">
    
       <section class="glass">
           <div class="row" style="margin-top:4%;">
               <div class="col">
        <h2 style="color:black;margin-left: 8%;"><?php echo $ad['Topic']; ?></h2>
        </div>
        <div class="col text-right">
            <form method='post' action='favorite'>
            <button type='submit' class='btn btn-primary fav omiljen'>
                <?php 
                $temp=new App\Models\FavoriteModel();
                $session=session();
               $user=$session->get('User');
             if ($user==null)
             {
                 echo "Dodaj u omiljene";
             }
             else if($temp->where('IdU',$user['Id'])->where('IdAd',$user['Temp'])->find()){
                    echo "Izbaci iz omiljenih";
                }
            else{
                echo "Dodaj u omiljene";
            }
               ?>
            </button>
            </form>
        </div>
          </div>
           <div class="row">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 50%; margin-left:4%">
        <ol class="carousel-indicators">
            <?php $j=0;
        foreach ($pictures as $pic){
        if ($j==0){
            echo'<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';           
        }
        else {
            echo'<li data-target="#carouselExampleIndicators" data-slide-to="$j"></li>';
        }
        $j=$j+1; } ?>         
        </ol>
        <div class="carousel-inner">
            <?php $i=0;
            if (sizeof($pictures)==0){
                echo "<div class='carousel-item active'><img class='d-block w-100' src='/assets/images/noImage5.png'></div>";
            
            }
            foreach($pictures as $image){
                if ($i==0){?>
                <div class="carousel-item active" >
                    <img class="img-fluid d-block w-100"style="border-radius: 1%;" src="/assets/userImages/Advertisement<?php echo $ad['Id'].'/'.$image['filename'];?>">
                </div>             
               <?php $i=1;}
             else { ?>
                <div class="carousel-item">
                <img class="d-block w-100" src="/assets/userImages/Advertisement<?php echo $ad['Id'].'/'.$image['filename'];?>"></div>   
                            <?php }}?>
                  </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
 </div>
               <div class="col-xl-5 col-sm-6" style="padding-right:0 !important;">
            <table class="table table-light table-striped" style="border-radius: 1%;height: 100%;">
                <tr>
                  <th>Cena</th>
                  <td><?php echo $ad['Price'];?></td>
                </tr>
                <tr>
                  <th>Kvadratura</th>
                  <td><?php echo $ad['Size'];?></td>
                </tr>
                <tr>
                  <th>Tip nekretnine</th>
                  <td><?php echo $ad['RealEstateType'];?></td>
                </tr>
                <tr>
                  <th>Lokacija</th>
                  <td><?php echo $place['City'].','.$place['Name']; ?></td>
                </tr>
                <tr>
                  <th>Broj telefona</th>
                  <td><?php echo $owner['Phone']; ?>
                </td>
                </tr>
                <tr>
                  <th>Email adresa</th>
                  <td> <?php echo $owner['Email']; ?></td>
                </tr>
            </table>
          </div>
          </div>
            <div class="row gutters-sm" style="margin-left: 2%;margin-right: 2%; padding-top: 1%; ">
                <div class="col-md-12 ">
                    <div class="card">
                    <div class="card-body" >
               <?php $temp=new App\Models\TagModel();             
               foreach($tags as $tag){                   
                   $nameTag=$temp->where('IdTag',$tag['IdTag'])->find();
                   $sql="select * from tags where IdTag=".$tag['IdTag'];
                   $db = \Config\Database::connect();
                   $values=$db->query($sql);
                   foreach ($values->getResult() as $val){
                   echo '<input type="checkbox" disabled/>&nbsp;&nbsp;'.$val->Name.'&nbsp;&nbsp;';                 
                   }
               } 
               ?>
               
            </div>
              </div>
                </div>
            </div>
          <div class="row gutters-sm" style="margin-left: 2%;margin-right: 2%; margin-top: 3px;">
            <div class="col-md-12 ">
              <div class="card">
                <div id='ocena_polje' class="card-body">
                    <div class="ograda_opis">
                      <h4><?php echo $ad['Topic']; ?></h4>
                      
                      <p><?php echo $ad['Description']; ?></p>
                      </div>
                    <?php 
                    $ads=new App\Models\adModel();
                    $reg=new App\Models\PrivilegedUserModel();
                    $session=session();
                    $user=$session->get('User');
                    $advert=$ads->find($user['Temp']);
                    if ($user!=null)
                    if($user['Id']!=$advert['IdOwner'] && $reg->find($advert['IdOwner'])==null){
                    echo"
                    <form method='POST' action='ocena'>
                        <div id='radios'>
                                <label for='jedan' class='material-icons'>
                                    <input type='radio' name='ocjena' id='jedan' value='1' checked/>
                                    <span>1</span>
                                </label>								
                                <label for='dva' class='material-icons'>
                                    <input type='radio' name='ocjena' id='dva' value='2' />
                                    <span>2</span>
                                </label>
                                <label for='tri' class='material-icons'>
                                    <input type='radio' name='ocjena' id='tri' value='3' />
                                    <span>3</span>
                                </label>
                                <label for='cetiri' class='material-icons'>
                                    <input type='radio' name='ocjena' id='cetiri' value='4' />
                                    <span>4</span>
                                </label>
                                <label for='petak' class='material-icons'>
                                    <input type='radio' name='ocjena' id='petak' value='5' />
                                    <span>5</span>
                                </label>
                        </div>
                        <button type='submit' class='btn btn-primary fav oceni'>Oceni Agenciju</button>
                    </form> ";}
                            ?>
                    </div>
                  <?php
                  $marks=new App\Models\MarkModel();
                  $session=session();
                  $user=$session->get('User');
                  
                  $mark=$marks->where('IdK',$user['Id'])->where('IdA',$owner['Id'])->find();
                  if($mark!=null){
                      foreach($mark as $result){
                      echo "<div class='ograda'>
                            <p>Ocenili ste agenciju ocenom ". $result['Number'] .".</p>
                  </div>";}}
                  ?>
                  </div>
                </div>
              </div>
            <?php
            $zabrana=new App\Models\ProhibitionUserModel(); 
            $session=session();
            $user=$session->get('User');
            if(!($zabrana->where('IdA',2)->where('IdU',$user['Id'])->find())){
            echo "
           </br>
            <div class='row gutters-sm' style='margin-left: 2%; margin-right:2% ;'>
             <div class='col-md-12 '>
              <div class='card'>
                <div class='card-body'>
                    </br>
                    <div class='row gutters-sm' style='margin-left: 2%; margin-right:2% ;'>
                    <div class='col-md-12 '>
                    <div class='card'>
                    <div class='card-body'>
                    <form method='POST' action='comment'>
                    <input type='hidden' name='time' value='".date('Y-m-d H:i:s')."'>
                    <textarea name='message' style='resize:none' rows='3' cols='80'></textarea><br>
                    <button type='submit' class='btn btn-primary fav' name='commentSubmit'>Postavi komentar</button>
                </form>
                
                </div>
                  </div>
                </div>
            </div>
                </div>
                  </div>
                </div>
             </div>";}
            ?>
           </br>
              <div class="row gutters-sm" style="margin-left: 2%; margin-right:2% ;">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-body">
                        <h1 class="izmena-naslov">Komentari</h1> 
                        <?php
        
    use App\Models\CommentModel;
    use App\Models\UserModel;
        $comment= new CommentModel();
        $result=$comment->where('IdAd',$ad['Id'])->findAll();
        $user=new UserModel();
        foreach ($result as $row) {
            $data=$user->find($row['IdK']);
            echo" <div class='media ograda'>
                <img src='/assets/images/avatar.png' alt='avatar' class='mr-3 mt-3 rounded-circle' style='width:60px;'>
                <div class='media-body'>
                 <h4>".$data['Username']. "<small><i> &nbsp; &nbsp;Objavljeno ".$row['Time']."</i></small></h4>
                    <p>".$row['Description']."</p>
                </div>
            </div>";

        }
        ?>
                    </div>
                  </div>
                </div>
              </div>
       </section>
     </main>
   </div>
 </body>
</html>