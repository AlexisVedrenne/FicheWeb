
var nbMedia=0;
function getMedia(){
    return document.getElementById('media');
}

function addMedia(element){
    nbMedia++;
    element.appendChild(document.createElement("div")).setAttribute("id","media-"+nbMedia);
    div=document.getElementById('media-'+nbMedia);
    div.appendChild(document.createElement('div')).setAttribute("id","iLien-"+nbMedia);
    div.appendChild(document.createElement('div')).setAttribute("id","iType-"+nbMedia);
    
    
    
    document.getElementById('iLien-'+nbMedia).appendChild(document.createElement("input")).setAttribute("id","lien-"+nbMedia);
    document.getElementById('iType-'+nbMedia).appendChild(document.createElement("input")).setAttribute("id","type-"+nbMedia);
    

}

function ajtLien(input){
    input.setAttribute("name","lien-"+nbMedia);
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
    document.getElementById('media-'+nbMedia).classList.add("row");
    document.getElementById('iLien-'+nbMedia).classList.add('col-sm-5');
    
    
}

function ajtType(input){
    input.setAttribute("name","type-"+nbMedia);
    input.setAttribute("type","text");
    input.classList.add ("form-control");
}


document.getElementById('btnMd').addEventListener('click',function(){
    addMedia(getMedia());
    ajtLien(getLien(nbMedia));
    ajtType(getType(nbMedia));
    ajtAttrDiv();
    console.log(nbMedia);
});

