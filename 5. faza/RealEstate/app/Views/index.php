<!-- Autor:Luka Juskovic 2017/0674-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/style.css"/>
    <script src='assets/javascript.js'></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    
    <title>Prototip</title>
</head>
<body class="Nova">
    <nav>
        <div class="logo"><h4><a  href='/Home'>Success</a></h4></div>
        <ul class="nav-links">
            <li><a href='/Home'>Početna stranica</a href></li>
            <li><a href='Guest/search'>Pretraga</a href></li>
            <li><a href='Guest/Ads'>Oglasi</a href></li>
            <?php             
            if ($User==null) {
            echo"<li><a href='Guest/login' class='login'>Prijavite se</a href></li>";
            echo "<li><a href='Guest/register' class='button register'>Registrujte se</a></a href></li>";           
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
                
        <div class="hidden-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
    <div class="containter">
        <main>

            <section class="glass">
                <div class='parent'>
                <span class='tekst1'>Najnovije ponude</span>
                </div>
                <div class='parent' id='par1'>
                    <div class='okvir-ponude'>
                        <div class='tekst2'>
                        <h2 class='naslov'>Rasprodaja stanova Beograd na vodi</h2>
                        <span class='tekst'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam facilis facere minus nostrum magni harum necessitatibus veritatis saepe! Praesentium est porro soluta. Asperiores possimus qui vitae in obcaecati laborum velit.</span>
                        </div>
                    <div class="zoom" id='ponuda'>
                        <img src="assets/images/beovoda.jpg" alt="Slika Beograda na vodi">
                    </div>
                    </div>
                    <div class='okvir-ponude'>
                        <div class='tekst2'>
                        <h2 class='naslov'>Rasprodaja stanova Beograd na vodi</h2>
                        <span class='tekst'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam facilis facere minus nostrum magni harum necessitatibus veritatis saepe! Praesentium est porro soluta. Asperiores possimus qui vitae in obcaecati laborum velit.</span>
                        </div>
                    <div class="zoom" id='ponuda'>
                        <img src="assets/images/beovoda.jpg" alt="Slika Beograda na vodi">
                    </div>
                    </div>
                </div>
                <div class='parent'>
                <span class='tekst1'>Kupovina i iznajmljivanje nekretnina na teritoriji celog Beograda!</span>
                </div>
                <div class='parent'>
                    <div class="zoom">
                        <img src="assets/images/hramSvetogSave.jpg" alt="Slika Beograda" style="width:100% !important;">
                        <div class='centered'>Vračar</div>
                    </div>
                    <div class="zoom">
                        <img src="assets/images/cukarica.jpg" alt="Slika Novog Sada">
                        <div class='centered'>Čukarica</div>
                    </div>
                    <div class="zoom">
                        <img src="assets/images/savskivenac.jpg" alt="Slika Backe Palanke">
                        <div class='centered'>Savski venac </div>
                    </div>
                    <div class="zoom">
                        <img src="assets/images/zemun.jpg" alt="Slika Prizrena">
                        <div class='centered'>Zemun</div>
                    </div>
                </div>
        </section>
        <div class="circle1"></div>
        <div class="circle2"></div>
        </main>
    </div>
</body>
</html>