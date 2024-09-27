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
    <link rel="stylesheet" href="/assets/styleLogin.css">
    <script src='/assets/javascript.js'></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Prototip</title>
</head>
<body>
    <nav>
        <div class="logo"><h4><a  href='../index.html'>Success</a></h4></div>
        <ul class="nav-links">
            <li><a href='/Home'>Početna stranica</a href></li>
            <li><a href='search'>Pretraga</a href></li>
            <li><a href='Ads'>Oglasi</a href></li>
            <li><a href='login' class='login'>Prijavite se</a href></li>
            <li><a href='register' class='button register'>Registrujte se</a></li>    
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
            <form class='uredi' name='logovanje' id='forma'action="" method="post">
                <div class="imgcontainer">
                  <img src="/assets/images/avatar.png" alt="Avatar" class="avatar">
                </div>
              
                <div class='section'>
                  <input type='text' name='username' id='username' autocomplete="off" required value="<?= set_value('username')?>" >
                  <label for='username' class='label-name'>
                      <span class='content-name'>Korisničko ime</span>
                  </label>
                </div>
                <div class='section'>
                  <input type='password' name='password' id='password' autocomplete="off" required value="<?= set_value('password')?>" >
                  <label for='password' class='label-name'>
                      <span class='content-name'>Lozinka</span>
                  </label>
                </div>
                <?php if (! empty($errors)) : ?>
                <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
                </div>
                <?php endif ?>               
                
                <button type='submit'>Prijavite se</button>
              </form>
        </section>
        <div class="circle1"></div>
        <div class="circle2"></div>
        </main>
    </div>
</body>
</html>