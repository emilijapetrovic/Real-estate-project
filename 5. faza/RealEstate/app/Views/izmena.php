

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/styleIzmena.css">
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
            <?php if ($User['Type']=='registered'){                   
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
        <main>
        <section class="glass">
            <form method='POST' action=''>
            <div class='uredi'>
                <ul class='izmena'>
                    <h1 class='izmena-naslov'>Vaši podaci</h1>
                    <li>
                      <label class='izmena_label'>
                       <span class='izmena_span'>Korisničko ime</span>
                       <input class='izmena_input' value='<?php echo $User['Username'];?>' name="korime"/>
                      </label>
                    </li>
                    <li>
                      <label class='izmena_label'>
                       <span class='izmena_span'>Lozinka</span>
                       <input class='izmena_input' name="lozinka"/>
                      </label>
                    </li>
                    <?php 
                    if ($User['Type']!='agency'){
                    echo "<li>
                      <label class='izmena_label'>
                       <span class='izmena_span'>Ime</span>
                       <input class='izmena_input' value='".$User['Name'] ."'name='ime' />
                      </label>
                    </li>
                    <li>";
                        }
                    ?>
                    <?php 
                    if ($User['Type']!='agency'){
                    echo "<li>
                      <label class='izmena_label'>
                       <span class='izmena_span'>Prezime</span>
                       <input class='izmena_input' value='".$User['Surname'] ."' name='prezime'/>
                      </label>
                    </li>
                    <li>";
                        }
                    ?>
                    <li>
                      <label class='izmena_label'>
                       <span class='izmena_span'>Email</span>
                       <input class='izmena_input' value='<?php echo $User['Email'];?>' name="email"/>
                      </label>
                    </li>
                    <li>
                      <label class='izmena_label'>
                       <span class='izmena_span'>Kontakt telefon</span>
                       <input class='izmena_input' value='<?php echo $User['Phone'];?>' name="tel"/>
                      </label>
                    </li>
                    <?php 
                    if ($User['Type']=='agency'){
                    echo "<li>
                      <label class='izmena_label'>
                       <span class='izmena_span'>Naziv agencije</span>
                       <input class='izmena_input' value='".$User['Name'] ."'name='agencija'/>
                      </label>
                    </li>
                    ";
                        }
                    ?>
                    <?php if (! empty($errors)) : ?>
                <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
                </div>
                <?php endif ?>
                    <button type='submit' onclick='info()' class='izmeni_dugme'>Sačuvaj izmene</button>
                </ul>
            </div>
            </form>
        </section>
        <div class="circle1"></div>
        <div class="circle2"></div>
        </main>
    </div>
</body>
</html>