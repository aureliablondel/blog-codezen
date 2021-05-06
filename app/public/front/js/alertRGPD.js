// Afficher une fenêtre d'alerte quand la case de politique de confidentialité n'est pas cochée dans le formulaire d'inscription

let checkbox = document.getElementById('test');
let btn = document.querySelector('.btn-submit');

btn.addEventListener('click', (event)=>{
    if(checkbox.checked === false){
        window.alert('Vous devez accepter la politique de confidentialité pour vous inscrire.');
}
})