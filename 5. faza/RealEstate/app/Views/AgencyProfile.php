
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/assets/styleShowUser.css">
    <script src='/assets/javascript.js'></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Pregled profila</title>
    
</head>
<body>
    <nav>
        <div class="logo"><h4><a  href='/Home'>Success</a></h4></div>
        <ul class="nav-links">
            <li><a href='/Home'>Početna stranica</a></li>
            <li><a href='/Guest/search'>Pretraga</a></li>
            <li><a href='/Guest/Ads'>Oglasi</a></li>
            <li><a href='Agency' class='login'>Moj profil</a></li>
            <li><a href='Agency/logout' class='button register'>Odjavi se</a></li>    
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
   
    <div class="main-body">
    
        
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="/assets/images/avatar.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                    <h4> <?php echo $user['Username']?></h4>
                      <h5><i>Agencija za nekretnine</i></h5>
                      <p class="text-muted font-size-sm">Beograd, Palilula</p>
                      
                    </div>
                  </div>
                </div>
              </div>
   
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Naziv agencije</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $user['Name']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email adresa</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $user['Email']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Srednja ocena</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php 
                      $ads=new App\Models\AgencyModel();
                        $agencija=$ads->find($user['Id']);
                      echo $agencija['AverageMark'];
                              ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Broj telefona</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $user['Phone']?>
                    </div>
                  </div>
            
                 
                  
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="Agency/izmena" style="width: 100%; ">Izmeni podatke</a>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="Agency/advertisements" style="width: 100%; ">Pogledaj svoje oglase</a>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="Agency/addAdvertisement" style="width: 100%; ">Dodaj novi oglas</a>
                    </div>
                  </div>                
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " href="Agency/favorites" style="width: 100%;">Omiljeno</a>
                    </div>
                  </div>
                </div>
              </div>

      


            </div>
          </div>
        <?php
            $session=session();
            if(($session->get('porukadodavanje'))!=null){
                echo "<div class='row>
                    <div class='col-sm-12'>
                    <div class='potvrda ograda'>".$session->getFlashdata('porukadodavanje')."</div></div></div}";
            }
            ?>
            <?php
            $session=session();
            if(($session->get('porukaoglas'))!=null){
                echo "<div class='row>
                    <div class='col-sm-12'>
                    <div class='potvrda ograda'>".$session->getFlashdata('porukaoglas')."</div></div></div}";
            }
            ?>
            <?php
            $session=session();
            if(($session->get('Poruka'))!=null){
                echo "<div class='row>
                    <div class='col-sm-12'>
                    <div class='potvrda ograda'>".$session->getFlashdata('Poruka')."</div></div></div}";
            }
            ?>
        </div>
    </div>
</div>
 
        </main>
    </div>
</body>
</html>