// Affichage d'infos au passage de la souris sur les boutons permettant de poster un commentaire

let btnSignUp = document.querySelector('.btn-connect');
let btnOneComment = document.getElementById('btnOneComment');

btnSignUp.addEventListener('mouseenter', (event)=>{
    if(btnOneComment.style.display == 'block'){
        btnOneComment.style.display = 'none';
    }else{
        btnOneComment.style.display = 'block';
    }
});

btnSignUp.addEventListener('mouseout', (event)=>{
    if(btnOneComment.style.display == 'block'){
        btnOneComment.style.display = 'none';
    }else{
        btnOneComment.style.display = 'block';
    }
});

let btnTwoComment = document.getElementById('btnTwoComment');

btnConnect.addEventListener('mouseenter', (event)=>{
    if(btnTwoComment.style.display == 'block'){
        btnTwoComment.style.display = 'none';
    }else{
        btnTwoComment.style.display = 'block';
    }
});

btnConnect.addEventListener('mouseout', (event)=>{
    if(btnTwoComment.style.display == 'block'){
        btnTwoComment.style.display = 'none';
    }else{
        btnTwoComment.style.display = 'block';
    }
});
