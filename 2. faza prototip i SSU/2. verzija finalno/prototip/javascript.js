$(document).ready(function(){
    const navSlide =()=>{
    const menu=document.querySelector('.hidden-menu');
    const nav=document.querySelector('.nav-links');
    const navLinks=document.querySelectorAll('.nav-links li');

    menu.addEventListener('click', ()=>{
        nav.classList.toggle('nav-active');

        navLinks.forEach((link,index)=>{
            if(link.style.animation){
                link.style.animation='';
            }
            else{
                link.style.animation=`navLinkFade 0.5s ease forwards ${index/7+0.3}s`;
            }
        });

        menu.classList.toggle('toggle');
    });

    
}

navSlide();
})

function registrujse(){
    var t='';
    var obj = document.getElementsByClassName("obavjestenje");
    if(obj[0])obj[0].remove();
    var u=document.registracija.username.value;
    var x1=document.registracija.password.value;
    var x2=document.registracija.passagain.value;
    var name=document.registracija.name.value;
    var lname=document.registracija.lastname.value;
    var regmail=/^\w+@\w+.com$/;
    var regbroj=/^(\+){0,1}\d+$/;
    z=document.registracija.mejl.value;
    b=document.registracija.broj.value;
    var node=document.createElement('div');
    node.setAttribute('class','obavjestenje');
    if(u==''){
      t=document.createTextNode("Unesite korisničko ime.");
    }
    else if(x1==''){
      t=document.createTextNode("Unesite lozinku.");
    }
    else if(x2==''){
      t=document.createTextNode("Unesite ponovo lozinku.");
    }
    else if(x1!=x2){
      t=document.createTextNode('Pogrešno unesena lozinka.');
    }
    else if(x1!=x2){
      t=document.createTextNode('Pogrešno unesena lozinka.');
    }
    else if(name==''){
      t=document.createTextNode('Unesite ime.');
    }
    else if(lname==''){
      t=document.createTextNode('Unesite prezime');
    }
    else if(!(regmail.test(z))){
      t=document.createTextNode('Pogrešno unesen email.')
    }
    else if(!(regbroj.test(b))){
      t=document.createTextNode('Pogrešno unesen broj.')
    }
    else if(x1==x2){
      localStorage.setItem(u,x1);
      t=document.createTextNode("Uspešno registrovan korisnik: "+u);
      node.setAttribute('class','obavjestenje uspjesno');
    }
    if(t!=''){
      node.appendChild(t);
      sekcija=document.getElementById('forma');
      sekcija.appendChild(node);
    }
}

function logujse(){
  var t='';
  var obj = document.getElementsByClassName("obavjestenje");
  if(obj[0])obj[0].remove();
  var x=document.logovanje.username.value;
  var y=document.logovanje.password.value;
  var node=document.createElement('div');
  node.setAttribute('class','obavjestenje');
  if(x==''){
    t=document.createTextNode("Unesite korisničko ime.");
  }
  else if(y==''){
    t=document.createTextNode("Unesite lozinku.");
  }
  else if(!(localStorage.getItem(x))){
    t=document.createTextNode('Dato korisničko ime ne postoji.');
  }
  else if(localStorage.getItem(x)==y){
    localStorage.setItem('nalog',x);
    nalog=localStorage.getItem('nalog');
    t=document.createTextNode("Uspešno ulogovan korisnik: "+nalog);
    node.setAttribute('class','obavjestenje uspjesno');
  }
  else{
    t=document.createTextNode('Pogrešno unesena lozinka.');
  }
  if(t!=''){
    node.appendChild(t);
    sekcija=document.getElementById('forma');
    sekcija.appendChild(node);
  }
  else{
    window.location.replace("index.html");
  }
}

function logout(){
  localStorage.removeItem('nalog');
  nalog=localStorage.getItem('nalog');
}

function ukloni(obj){
  obj.parentElement.remove();
}
