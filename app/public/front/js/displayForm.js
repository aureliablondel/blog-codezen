// Affichage du formulaire caché pour poster un commentaire

let btnConnect = document.getElementById('btn-connect');
let form = document.getElementById('form-connect');

btnConnect.addEventListener('click', (event)=>{
    if(form.style.display == 'block'){
        form.style.display = 'none';
    }else{
        form.style.display = 'block';
    }
});
