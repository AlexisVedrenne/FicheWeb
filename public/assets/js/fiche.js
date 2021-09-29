
var nbContenue=0;

function getContenue(){
    return document.getElementById('contenue');
}


function addContenue(element){
    nbContenue++;
    element.appendChild(document.createElement("input")).setAttribute("id","rub-"+nbContenue);
    element.appendChild(document.createElement("textarea")).setAttribute('id',"des-"+nbContenue);
}

function ajtAttrRub(input){
    input.setAttribute("name","rub-"+nbContenue);
    input.setAttribute("type","text");
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
}


document.getElementById('btnCtn').addEventListener('click',function(){
    addContenue(getContenue());
    ajtAttrRub(getRubrique(nbContenue));
    ajtAtrrDes(getDescription(nbContenue));
    console.log(nbContenue);
});
