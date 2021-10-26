var nbContenue = 0;

function getMedia(nb) {
    return document.getElementById('media-' + nb);
}

function addMedia(nb, contenue) {
    div = document.getElementById('iRub-' + contenue).children["media-" + nb];
    div.appendChild(document.createElement("h5")).setAttribute("id", "hmd-" + nb);
    div.children["hmd-" + nb].innerText = "Media " + nb;
    div.appendChild(document.createElement('div')).setAttribute("id", "iType-" + nb);
    div.appendChild(document.createElement('div')).setAttribute("id", "iLien-" + nb);
    div.classList.add("row");
    lien = div.children["iLien-" + nb];
    type = div.children["iType-" + nb];
    lien.appendChild(document.createElement("input")).setAttribute("id", "lien-" + nb);
    type.appendChild(document.createElement("input")).setAttribute("id", "type-" + nb);
    ajtLien(lien.children["lien-" + nb], nb, contenue);
    ajtType(type.children["type-" + nb], nb, contenue);
    console.log(lien);
    console.log(type);

}

function ajtLien(input, nb, contenue) {
    input.setAttribute("name", "lien-" + nb + "-" + contenue);
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Ajoutez un lien ici...");
    input.classList.add("mb-2");
    input.classList.add("mt-2");
    input.classList.add("form-control");

}


function ajtAttrDiv() {
    document.getElementById('media-' + nbContenue).classList.add("row");
    document.getElementById('iLien-' + nbContenue).classList.add('col-sm-5');


}

function ajtType(input, nb, contenue) {
    input.setAttribute("name", "type-" + nb + "-" + contenue);
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Selectionez un type...");
    input.classList.add("form-control");
}



function getContenue() {
    return document.getElementById('contenue');
}


function addContenue(element) {
    nbContenue++;
    document.getElementById("nbContenue").value = nbContenue;
    //Création de la div qui va acceuillir le contenue 
    element.appendChild(document.createElement("div")).setAttribute("id", "contenue-" + nbContenue);
    //Récupération de notre div contenue-nb dans une variable
    div = document.getElementById("contenue-" + nbContenue);
    div.appendChild(document.createElement("div")).setAttribute("id", "ctnhead-" + nbContenue);
    div.children["ctnhead-" + nbContenue].classList.add("row");
    div.children["ctnhead-" + nbContenue].classList.add("col-12");
    div.children["ctnhead-" + nbContenue].appendChild(document.createElement("div")).setAttribute("id", "titre-" + nbContenue);
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].classList.add("col-3");
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].classList.add("offset-3");
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].classList.add("ml-5")
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].appendChild(document.createElement("button")).setAttribute("id", "btnMd-" + nbContenue);
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].children["btnMd-" + nbContenue].classList.add("btn");
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].children["btnMd-" + nbContenue].classList.add("btn-secondary");
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].children["btnMd-" + nbContenue].classList.add("mt-2");
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].children["btnMd-" + nbContenue].innerHTML = "<i class='bi bi-plus-circle-fill'></i>";
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].children["btnMd-" + nbContenue].setAttribute("type", "button");
    div.appendChild(document.createElement("input")).setAttribute("id", "nbMedia-" + nbContenue);
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].children["btnMd-" + nbContenue].setAttribute("value", "" + nbContenue);
    div.children["nbMedia-" + nbContenue].setAttribute("value", "0");
    div.children["nbMedia-" + nbContenue].setAttribute("hidden", "true");
    div.children["nbMedia-" + nbContenue].setAttribute("name", "nbMedia-" + nbContenue);
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].children["btnMd-" + nbContenue].addEventListener('click', function() {
        console.log(this);
        nbMedia = document.getElementById("nbMedia-" + this.value).value;
        nbMedia++;
        console.log(nbMedia);
        document.getElementById("nbMedia-" + this.value).value = nbMedia
        document.getElementById("contenue-" + this.value).children["iRub-" + this.value].appendChild(document.createElement("div")).setAttribute("id", "media-" + nbMedia);
        addMedia(nbMedia, this.value);
    });
    //Création d'une nouvelle div dans notre div contenue-nb

    div.children["ctnhead-" + nbContenue].appendChild(document.createElement("h5")).setAttribute("id", "hrub-" + nbContenue)
    div.children["ctnhead-" + nbContenue].children["hrub-" + nbContenue].innerText = "Contenue " + nbContenue;
    div.children["ctnhead-" + nbContenue].children["hrub-" + nbContenue].classList.add("col-5");
    div.children["ctnhead-" + nbContenue].children["hrub-" + nbContenue].classList.add("text-center");
    div.appendChild(document.createElement("div")).setAttribute("id", "iRub-" + nbContenue);
    //Création d'une nouvelle div dans notre div contenue-nb
    div.appendChild(document.createElement("div")).setAttribute("id", "iDes-" + nbContenue);

    //Récupération de la div iRub-nbcontenue que l'on vient de créer et ajout de notre élément input
    document.getElementById("iRub-" + nbContenue).appendChild(document.createElement("input")).setAttribute("id", "rub-" + nbContenue);
    //Récupération de la div iDes-nbcontenue que l'on vient de créer et ajout de notre élément textArea
    document.getElementById("iDes-" + nbContenue).appendChild(document.createElement("textarea")).setAttribute('id', "des-" + nbContenue);
}

function ajtAttrRub(input) {
    input.setAttribute("name", "rub-" + nbContenue);
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Entrez un titre à votre contenue...");
    input.classList.add("mb-2");
    input.classList.add("mt-2");
    input.classList.add("form-control");
}

function getRubrique(nb) {
    return document.getElementById("rub-" + nb);
}

function getDescription(nb) {
    return document.getElementById("des-" + nb);
}

function ajtAtrrDes(input) {
    input.setAttribute("name", "des-" + nbContenue);
    input.setAttribute("type", "text");
    input.setAttribute("rows", "15");
    input.setAttribute("placeholder", "Ajoutez ici une description...");
    input.classList.add("mb-2");
    input.classList.add("mt-2");
    input.classList.add("form-control");
}

function ajtAttrDiv() {
    document.getElementById("contenue-" + nbContenue).classList.add("row");
    document.getElementById("iRub-" + nbContenue).classList.add(["col-sm-5"]);
    document.getElementById("iDes-" + nbContenue).classList.add(["col-sm-7"]);

}


document.getElementById('btnCtn').addEventListener('click', function() {
    addContenue(getContenue());
    ajtAttrRub(getRubrique(nbContenue));
    ajtAtrrDes(getDescription(nbContenue));
    ajtAttrDiv();
    console.log(nbContenue);
});