var nbContenue=0;

function getMedia(nb){
    return document.getElementById('media-'+nb);
}

function addMedia(nb,contenue){
    div=document.getElementById('contenue-'+contenue).children["media-"+nb];
    div.appendChild(document.createElement('div')).setAttribute("id","iLien-"+nb);
    div.appendChild(document.createElement('div')).setAttribute("id","iType-"+nb);
    
    lien=div.children["iLien-"+nb];
    type=div.children["iType-"+nb];
    
    lien.appendChild(document.createElement("input")).setAttribute("id","lien-"+nb);
    type.appendChild(document.createElement("input")).setAttribute("id","type-"+nb);
    console.log(lien);   

}

function ajtLien(input){
    input.setAttribute("name","lien-"+nbContenue);
    input.setAttribute("type","text");
    input.classList.add ("mb-2");
    input.classList.add ("mt-2");
    input.classList.add ("form-control");

}
function getLien(nb){
    return document.getElementById("lien-"+nb);
}

function getType(nb){
    return document.getElementById('type-'+nb);
}

function ajtAttrDiv() {
    document.getElementById('media-'+nbContenue).classList.add("row");
    document.getElementById('iLien-'+nbContenue).classList.add('col-sm-5');
    
    
}

function ajtType(input){
    input.setAttribute("name","type-"+nbContenue);
    input.setAttribute("type","text");
    input.classList.add ("form-control");
}



function getContenue(){
    return document.getElementById('contenue');
}


function addContenue(element){
    nbContenue++;
    //Création de la div qui va acceuillir le contenue 
    element.appendChild(document.createElement("div")).setAttribute("id","contenue-"+nbContenue);
    //Récupération de notre div contenue-nb dans une variable
    div = document.getElementById("contenue-"+nbContenue);
    div.appendChild(document.createElement("button")).setAttribute("id","btnMd-"+nbContenue);
    div.appendChild(document.createElement("input")).setAttribute("id","nbMedia-"+nbContenue);
    document.getElementById("btnMd-"+nbContenue).setAttribute("value",""+nbContenue);
    document.getElementById("nbMedia-"+nbContenue).setAttribute("value","0");
    document.getElementById("nbMedia-"+nbContenue).setAttribute("hidden","true");
    document.getElementById('btnMd-'+nbContenue).addEventListener('click',function(){
        nbMedia=document.getElementById("nbMedia-"+this.value).value;
        nbMedia++;
        document.getElementById("nbMedia-"+this.value).value=nbMedia
        document.getElementById("contenue-"+this.value).appendChild(document.createElement("div")).setAttribute("id","media-"+nbMedia);
        addMedia(nbMedia,this.value);
    });
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






