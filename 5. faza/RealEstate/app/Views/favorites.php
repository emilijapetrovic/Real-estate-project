<!DOCTYPE html>
<html>
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
<body><form id="my_form" method="get" action="/Guest/Add">
    <nav>
     
      
      <div class="logo"><h4><a href='/Home'>Success</a></h4></div>
        <ul class="nav-links">
            <li><a href='/Home'>Početna stranica</a></li>
            <li><a href='/Guest/search'>Pretraga</a></li>
            <li><a href='/Guest/Ads'>Oglasi</a></li>
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
             <?php $cntAdvertisment=0;
             $numRows=count($values->getResult());
             if ($numRows==0){ ?>
            
             <div class="col col-sm-12 alert alert-danger text-center" style="padding-top:3%; font-size: 20pt;">Nema rezultata za datu pretragu</div>
          
             <?php }
             else {?>
                 <div class="col col-sm-12 alert alert-success text-center" style="padding-top:3%; font-size: 10pt;">Rezultati pretrage</div>
            <?php }
             foreach ($values->getResult() as $row){
                 $cntAdvertisment=$cntAdvertisment+1;
                $db = \Config\Database::connect();
                 $images=$db->query("Select * from image where IdAd=".$row->Id);
                 $image=null;
              
                 foreach($images->getResult() as $tempCnt){                 
                         $image=$tempCnt;
                     break;
                    }  
                 ?>
            <div class="row gutters-sm" style="margin-left: 2%; margin-right:2% ;padding-top: 2%;">
                <div class="col-md-12 ">
                                   
                  <div class="card">
                    <div class="card-body">                                             
                          <div class="row">
                          <div class="col-lg-4 col-sm-12 ">
                          <?php if ($image==null){?>
                              
                                  <img class="img-fluid" src="/assets/images/noImage5.png" style="width:100%; height: 100%;">
                                              
                          <?php } else {?>
                              <img class="img-fluid" src="/assets/userImages/Advertisement<?php echo $row->Id.'/'.$image->filename;?>">
                         
                           <?php }
                           ?>
        
                        </div>
                          <div class="col-lg-8 col-sm-12">

                          <table class="table table-light table-striped">
                            <tr>
                                <td><b><?php echo $row->Topic;?></b></td> 
                                <td class="text-right"><input class="btn btn-primary" type="submit" name="BId<?php echo $row->Id;?>" value="Pogledaj oglas"></td>
                            </tr>
                              <tr>
                                  <td>Kvadratura</td>
                                  <td class="text-right"><?php echo $row->Size;?></td>
                              </tr>
                              <tr>
                                  <td>Cena</td>
                                  <td class="text-right"><?php echo $row->Price;?></td>
                              </tr>
                              <tr>
                                  <td>Adresa</td>
                                  <td class="text-right"><?php echo $row->Address;?></td>
                              </tr>
                             
                          </table>
                        </div>
                           </div>          
                    </div>
                    </div>
                </div>
            </div>
            <?php }?>
 
         </section>
     </main>
     </div>
           </form>
     </body>
</html> 