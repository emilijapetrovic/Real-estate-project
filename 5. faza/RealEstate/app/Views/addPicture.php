<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/styleOglas.css">
    <script src='/assets/javascript.js'></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Prototip</title>
</head>
<body>
    <nav>
     
      
      <div class="logo"><h4><a href='/Home'>Success</a></h4></div>
        <ul class="nav-links">
            <li><a href='/Home'>Početna stranica</a></li>
            <li><a href='/Guest/search'>Pretraga</a></li>
            <li><a href='/Guest/Ads'>Oglasi</a></li>
            <?php if ($user['Type']=='registered'){                   
                   echo"<li><a href='/Registereduser' class='login'>Moj profil</a href></li>";
            echo "<li><a href='/Registereduser/logout' class='button register'>Odjavi se</a></a href></li>";
                }
                else if ($user['Type']=='agency'){
                   echo"<li><a href='/Agency' class='login'>Moj profil</a href></li>";
                   echo"<li><a href='/Agency/logout' class='button register'>Odjavi se</a></a href></li>";
                }
                else if ($user['Type']=='privileged'){
                    echo "<li><a href='/Privilegeduser' id='myProf' class='login'>Moj profil</a></li>";
                    echo "<li><a href='/Privilegeduser/logout'class='button register'>Odjavi se</a></li>";
                }
                else if ($user['Type']=='admin'){
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
    <div id="containter">
        <main>
        <section class="glass">

              <h2 style="font-family: 'Poppins', sans-serif; text-align: center;">Dodajte slike za dati oglas</h2>

            <div class="addPicture1">

                <form method="POST"
                action=""
                enctype="multipart/form-data">

                 <input type="file" style="margin-left: 45%;"name="uploadfile" value="Dodaj Sliku" />
                <br>

                <button type='submit' name="upload" class="btn-lg btn btn-success" >Dodaj sliku </button>
                <?php 
                $session=session();
                if($session->get('porukaoglas')!=null)$session->markAsFlashdata('porukaoglas');
                if($session->get('porukadodavanje')!=null)$session->markAsFlashdata('porukadodavanje');
                if ($user['Type']=='privileged'){
                    echo '<a href="/Privilegeduser"><button type="button" onclick="oglas()" class="btn btn-lg btn-info" >Završi</button></a>';                  
                }
                else if ($user['Type']=='agency'){
                 echo '<a href="/Agency"><button type="button" onclick="oglas()" class="btn btn-lg btn-info" >Završi</button></a>';
                }
                else if ($user['Type']=='registered'){
                    echo '<a href="/Registereduser"><button type="button" onclick="oglas()" class="btn btn-lg btn-info" >Završi</button></a>';
                }
                ?>
                

            </div>
            <div class="addPicture2">
            <img src="/assets/images/slikaZaProjekat1.jpg" style="width:50%"  >
            </div>

        </form>
        </section>
        <div class="circle1"></div>
        <div class="circle2"></div>
        </main>
    </div>
</body>
</html>