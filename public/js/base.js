let subs = document.getElementsByClassName('submenu');
let cl = document.getElementsByClassName('clicklistener');

function reset() {
    for (var i = 0; i < subs.length; i++) {
        subs[i].style.display = 'none';
    }
}

document.addEventListener("click", e => {
    reset();
});

for (var i = 0; i < cl.length; i++) {
    // encapsulation dans une fonction pour empêcher les problèmes d'asynchronicité
    (function (index) { 
        cl[index].addEventListener("click", e => {
            //timeout de 0s pour forcer l'eventlistener document à passer en premier
            setTimeout(() => { 
                subs[index].style.display = 'block';
            }, 0);
        });
    })(i);
}
reset();
