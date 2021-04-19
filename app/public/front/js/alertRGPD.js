let checkbox = document.getElementById('test');
let btn = document.querySelector('.btn-submit');

btn.addEventListener('click', (event)=>{
    if(checkbox.checked === false){
        window.alert('cochez la case');
}
})