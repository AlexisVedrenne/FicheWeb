function sleep(miliseconds) {
    var currentTime = new Date().getTime();

    while (currentTime + miliseconds >= new Date().getTime()) {}
}

function users(id) {
    p="inPseudo-";
    i="idUser-";
    e="inEmail-";
    r="slRole-";
    b="btnModif-";
    bv="btnValid-";
    bv=bv+id;
    b=b+id;
    r=r+id;
    e=e+id;
    p=p+id;
    i=i+id;
    id=document.getElementById(i);
    pseudo = document.getElementById(p);
    console.log(id);
    console.log(pseudo);
    email = document.getElementById(e);
    console.log(email);
    role = document.getElementById(r);
    console.log(role);
    btn = document.getElementById(b);
    console.log(btn);
    if (pseudo.getAttribute("disabled") != null) {
        pseudo.removeAttribute("disabled");
        email.removeAttribute("disabled");
        role.removeAttribute("disabled");
        id.removeAttribute("disabled");
        id.setAttribute("readonly",true)
        btn.setAttribute("hidden", true);
        document.getElementById(bv).removeAttribute("hidden");
    }
}