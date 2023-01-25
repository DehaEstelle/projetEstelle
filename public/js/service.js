let services = document.querySelectorAll(".service");
// console.log(services);

let id = document.getElementById("id");
let service = document.getElementById("service");
// console.log(service);


document.addEventListener("DOMContentLoaded", function () {
    services.forEach(function (el) {                                 
        el.addEventListener("click", function(e) {
            e.preventDefault();
            let td = el.parentElement ;
            let previous = td.previousElementSibling ;
            let previous1 = previous.previousElementSibling ;
            id.value = previous1.textContent;
            console.log(id.value);
            service.value = previous.textContent;
        })
    })
})

