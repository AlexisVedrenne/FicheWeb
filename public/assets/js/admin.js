function sleep(miliseconds) {
    var currentTime = new Date().getTime();

    while (currentTime + miliseconds >= new Date().getTime()) {}
}

function users(id) {
    pseudo = document.getElementById("inPseudo-" + id);
    email = document.getElementById("inEmail-" + id);
    role = document.getElementById("slRole-" + id);
    btn = document.getElementById("btnModif-" + id);
    if (pseudo.getAttribute("readonly") != null) {
        pseudo.removeAttribute("readonly");
        email.removeAttribute("readonly");
        role.removeAttribute("disabled");
        btn.setAttribute("hidden", true);
        document.getElementById("btnValid-" + id).removeAttribute("hidden");
    }
}