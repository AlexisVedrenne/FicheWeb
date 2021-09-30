
var nbContenue=0;

function getContenue(){
    return document.getElementById('contenue');
}


function addContenue(element){
    nbContenue++;
    //Création de la div qui va acceuillir le contenue 
    element.appendChild(document.createElement("div")).setAttribute("id","contenue-"+nbContenue);
    //Récupération de notre div contenue-nb dans une variable
    div = document.getElementById("contenue-"+nbContenue);
    //Création d'une nouvelle div dans notre div contenue-nb
    div.appendChild(document.createElement("div")).setAttribute("id","iRub-"+nbContenue);
    //Création d'une nouvelle div dans notre div contenue-nb
    div.appendChild(document.createElement("div")).setAttribute("id","iDes-"+nbContenue);

    //Récupération de la div iRub-nbcontenue que l'on vient de créer et ajout de notre élément input
    document.getElementById("iRub-"+nbContenue).appendChild(document.createElement("input")).setAttribute("id","rub-"+nbContenue);
    //Récupération de la div iDes-nbcontenue que l'on vient de créer et ajout de notre élément textArea
    document.getElementById("iDes-"+nbContenue).appendChild(document.createElement("textarea")).setAttribute('id',"des-"+nbContenue);
}

function ajtAttrRub(input){
    input.setAttribute("name","rub-"+nbContenue);
    input.setAttribute("type","text");
    input.classList.add("mb-2");
    input.classList.add("mt-2");
    input.classList.add("form-control");
}

function getRubrique(nb){
    return document.getElementById("rub-"+nb);
}

function getDescription(nb){
    return document.getElementById("des-"+nb);
}

function ajtAtrrDes(input){
    input.setAttribute("name","des-"+nbContenue);
    input.setAttribute("type","text");
    input.setAttribute("rows","15");
    input.classList.add("mb-2");
    input.classList.add("mt-2");
    input.classList.add("form-control");
}

function ajtAttrDiv(){
    document.getElementById("contenue-"+nbContenue).classList.add("row");
    document.getElementById("iRub-"+nbContenue).classList.add(["col-sm-5"]);
    document.getElementById("iDes-"+nbContenue).classList.add(["col-sm-7"]);

}


document.getElementById('btnCtn').addEventListener('click',function(){
    addContenue(getContenue());
    ajtAttrRub(getRubrique(nbContenue));
    ajtAtrrDes(getDescription(nbContenue));
    ajtAttrDiv();
    console.log(nbContenue);
});
