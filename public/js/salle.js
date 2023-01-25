let salles = document.querySelectorAll(".salle");

let id1 = document.getElementById("id1");
let salle = document.getElementById("salle");


document.addEventListener("DOMContentLoaded", function () {
    salles.forEach(function (el) {                                 
        el.addEventListener("click", function(e) {
            e.preventDefault();
            let td = el.parentElement ;
            let previous = td.previousElementSibling ;
            let previous1 = previous.previousElementSibling ;
            id1.value = previous1.textContent;
            console.log(id1.value);
            salle.value = previous.textContent;
        })
    })
})