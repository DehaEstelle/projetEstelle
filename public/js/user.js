let users = document.querySelectorAll(".user");

let id = document.getElementById("id2");

let firstname = document.getElementById("firstname");
let lastname = document.getElementById("lastname");
let email = document.getElementById("email");
let user_role = document.getElementById("role");
let service = document.getElementById("service");

document.addEventListener("DOMContentLoaded", function () {
    users.forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            let td = el.parentElement;
            let previous = td.previousElementSibling;
            let previous1 = previous.previousElementSibling;
            let previous2 = previous1.previousElementSibling;
            let previous3 = previous2.previousElementSibling;
            let previous4 = previous3.previousElementSibling;
            let previous5 = previous4.previousElementSibling;

            id.value = previous5.textContent;
            firstname.value = previous4.textContent;
            lastname.value = previous3.textContent;
            email.value = previous2.textContent;
    
            document.querySelectorAll('#role option').forEach(el => {
                el.removeAttribute('selected');
                if (el.textContent === previous1.textContent) 
                 el.selected="selected";
            });

            document.querySelectorAll('#service option').forEach(el => {
                el.removeAttribute('selected');
                if (el.textContent === previous.textContent) 
                 el.selected="selected";
            });
        })
    })
})