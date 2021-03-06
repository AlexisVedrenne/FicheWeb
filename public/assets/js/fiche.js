var nbContenue = 0;

function getMedia(nb) {
    return document.getElementById('media-' + nb);
}

/**
 * Fonction qui ajoute des médias dans un contenu
 * @param {*} nb 
 * @param {*} contenue 
 */
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
    type.appendChild(document.createElement("select")).setAttribute("id", "type-" + nb);
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

    pdf=document.createElement("option");
    pdf.value="PDF";
    pdf.text="PDF";
    image=document.createElement("option");
    image.value="Image";
    image.text="Image";
    video=document.createElement("option");
    video.value="Video";
    video.text="Video";
    input.setAttribute("name", "type-" + nb + "-" + contenue);
    input.add(image);
    input.add(video);
    input.add(pdf);
    input.classList.add("form-control");
}



function getContenue() {
    return document.getElementById('contenue');
}

/**
 * Fonction qui va crééer dynamiquement des contenu pour une fiche 
 * 
 * @param {*} element 
 */
function addContenue(element) {
    nbContenue++;
    document.getElementById("nbContenue").value = nbContenue;
    //Création de la div qui va acceuillir le contenue 
    element.appendChild(document.createElement("div")).setAttribute("id", "contenue-" + nbContenue);
    //Récupération de notre div contenue-nb dans une variable
    div = document.getElementById("contenue-" + nbContenue);
    div.appendChild(document.createElement("div")).setAttribute("id", "ctnhead-" + nbContenue); //création de la div ctnhead
    div.children["ctnhead-" + nbContenue].classList.add("row");
    div.children["ctnhead-" + nbContenue].classList.add("col-12");
    div.children["ctnhead-" + nbContenue].appendChild(document.createElement("div")).setAttribute("id", "titre-" + nbContenue);
    //Création et stylisation d'une nouvel div titre- dans la div ctnhead
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].classList.add("col-3");
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].classList.add("offset-3");
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].classList.add("ml-5")
    div.children["ctnhead-" + nbContenue].children["titre-" + nbContenue].appendChild(document.createElement("button")).setAttribute("id", "btnMd-" + nbContenue);
    //Création du bouton d'ajout des médias dans la div titre-
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

/**
 * Ajout des attribut à l'input rubrique
 * @param {*} input 
 */
function ajtAttrRub(input) {
    input.setAttribute("name", "rub-" + nbContenue);
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Entrez un titre à votre contenue...");
    input.classList.add("mb-2");
    input.classList.add("mt-2");
    input.classList.add("form-control");
}

/**
 * Récuperer la rubrique d'un contenu
 * 
 * @param {*} nb 
 * @returns 
 */
function getRubrique(nb) {
    return document.getElementById("rub-" + nb);
}


/**
 * Recuperer une description d'un contenu
 * 
 * @param {*} nb 
 * @returns 
 */
function getDescription(nb) {
    return document.getElementById("des-" + nb);
}

/**
 * Ajout des attributs à l'input
 * @param {} input 
 */
function ajtAtrrDes(input) {
    input.setAttribute("name", "des-" + nbContenue);
    input.setAttribute("type", "text");
    input.setAttribute("rows", "15");
    input.setAttribute("placeholder", "Ajoutez ici une description...");
    input.classList.add("mb-2");
    input.classList.add("mt-2");
    input.classList.add("form-control");
}

/**
 * Ajoute les attribut aux div
 */
function ajtAttrDiv() {
    document.getElementById("contenue-" + nbContenue).classList.add("row");
    document.getElementById("iRub-" + nbContenue).classList.add(["col-sm-5"]);
    document.getElementById("iDes-" + nbContenue).classList.add(["col-sm-7"]);

}


/**
 * Fonction qui permet d'ajouter un nouveau contenu pour une fiche
 */
document.getElementById('btnCtn').addEventListener('click', function() {
    addContenue(getContenue()); //Ajout du contenu à la div qui contient tous les contenus
    ajtAttrRub(getRubrique(nbContenue));//Ajout des attributs sur la rubrique
    ajtAtrrDes(getDescription(nbContenue));//Ajout des attributs sur la description
    ajtAttrDiv();
    if(nbContenue>0){ //Si le nombre de contenu est à 0 sur la page alors il est impossible de créer une fiche
        document.getElementById("btnFiche").removeAttribute("disabled");
        document.getElementById('spModal').removeAttribute("disabled");
    }
});

/**
 * Cette fonction permet de retirer le dernier contenu ajouter de la page
 */
document.getElementById('btnSpCtn').addEventListener('click',function(){
    nbCon=document.getElementById("nbContenue")
    contenu=getContenue();
    contenu.removeChild(document.getElementById('contenue-'+nbContenue));
    nbContenue-=1;
    nbCon.value=nbContenue;
    if(nbCon.value==0){
        document.getElementById('spModal').setAttribute('disabled',true);
        document.getElementById("btnFiche").setAttribute("disabled",true);
    }
})

