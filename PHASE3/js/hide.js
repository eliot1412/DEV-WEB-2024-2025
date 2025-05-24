function hide(){
    img = document.getElementById('imgpassword');
    imgAtt = document.getElementById('imgpassword').getAttribute('src');
    mdp = document.getElementById('password');
    if(imgAtt=="show.jpg"){
        mdp.type='text';
        img.setAttribute('src','dontshow.jpg');
    }
    else{
        mdp.type='password';
        img.setAttribute('src','show.jpg');
    }

}