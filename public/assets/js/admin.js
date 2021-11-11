
// Cette fonction permet de deverouiller la modification des users dans admin
function users(id) {
    //récupération des élément html
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

    //Test pour savoir si les element son activer ou pas
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