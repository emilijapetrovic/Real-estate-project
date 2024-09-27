<!-- Autor:Emilija Petrovic 2017/0644-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/styleSearch.css">
    <script src='/assets/javascript.js'></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    
    <title>Prototip</title>
    
</head>
<body>
  <nav>
    <div class="logo"><h4><a href='/Home'>Success</a></h4></div>
     <ul class="nav-links">
            <li><a href='/Home'>Početna stranica</a href></li>
            <li><a href='search'>Pretraga</a href></li>
            <li><a href='Ads'>Oglasi</a href></li>
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
                    echo "<li><a href='/Privilegeduser' id='myProf' class='login'>Moj profil</div></a></li>";
                    echo "<li><a href='/Privilegeduser/logout' class='button register'>Odjavi se</div></a></li>";
                }
                else if ($User['Type']=='admin'){
                    echo "<li><a href='/Admin' id='myProf' class='login'>Moj profil</a></li>";
                    echo "<li><a href='/Admin/logout' class='button register'>Odjavi se</a></li>";
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
      <main>
      

      <section class="glassem">
      <br><br>
       
      <h3>Pretraga</h3>

        
           <br>
           <br>
           <form method="get">
          <div class="sr">
          <label style="padding-right: 4%;">
               Cena
            </label>

            od
            <input class="searchTextField" type='number' name='priceFrom'  autocomplete="off">
            do
            <input class="searchTextField" type='number' name='priceTo' autocomplete="off">              
            <br>
            <br>
            <br>
            <br>
          <label id="kolona2">
              Lokacija
          </label>
          <div class="dropdown" style="margin-left: 4%;">
            <button type="button" class="btn btn-primary dropdown-toggle dropbutton" onclick="btnToggle()">
            Izaberi lokaciju
            </button>
            <div id="Dropdown" class="dropdown-menu" style="width:125%;padding-left:1%; padding-right: 28%;">              
            <?php foreach($municipalities->getResult() as $temp){?>
                <div class="dropdown-item" style="margin-right:0%; padding-right: 0%;"><label>
              <input type="checkbox" name="<?php echo $temp->Id;?>" value="<?php echo $temp->Id;?>"> <?php echo $temp->City.', '.$temp->Name;?>
            </label>
        
             </div>
            <?php }?>
            </div>
            </div>
  
          <br>
          <br>
          <br>
          <br>
          <br>
 
          <label>
              Kvadratura
            </label>
            &nbsp;
            od
            <input class="searchTextField" type='number' name='sizeFrom' autocomplete="off">
            do
            <input class="searchTextField" type='number' name='sizeTo' autocomplete="off">   
          <br>
          <br>
          <br>
          <br>
          <label id="kolona22">
             Tip
            </label>

            <div class="dropdown" style="margin-left: 7%;">
              <button type="button" class="btn btn-primary dropbutton drType" onclick="btnToggleType()">
              Izaberi tip
              </button>
              <div id="DropdownType" class="dropdown-menu">               
                 <?php foreach($types->getResult() as $temp){?>
                <div class="dropdown-item" style="margin-right:0%; padding-right: 0%;"><label>
              <input type="checkbox" name="<?php echo $temp->Name.$temp->Id;?>" value="<?php echo $temp->Id;?>"> <?php echo $temp->Name;?>
            </label>
        
             </div>
            <?php }?>
             </div>
            </div>
        
          <br>
          <br>
          <br>
          <br>
          <br>
          <label>Usluga</label>
          <input id="prodaja" type="radio" name="purpose" value="prodaja" style="margin-left: 7%;" checked>
          <label for="prodaja">Prodaja</label>
          <input id="izdavanje" type="radio" name="purpose" value="izdavanje" style="margin-left: 18;">
          <label for="izdavanje">Izdavanje</label>
          <br>
          <br>
          <br>
          <br>
          <button class="btn btn-success searchButton" type="submit">Pretraga<img id="lupa" src="/assets/images/lupa.png" alt="Lupa"></button>
       
          </form>
      </section>
      <div class="circle1"></div>
      <div class="circle2"></div>
      </main>
    
  </div>
</body>
</html>
