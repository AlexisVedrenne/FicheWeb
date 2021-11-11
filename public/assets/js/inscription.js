

//Fonction qui va checker si les mots de passe corresponde
var check = function() {
    if (document.getElementById('registration_form_plainPassword').value == document.getElementById('confirm_password').value){//Si les mots de passe corresponde alors on passe la phrase en vert et on active le bouton
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Le mot de passe correspond';
        document.getElementById('btnEnregistrer').removeAttribute("disabled")
    } else { 
        document.getElementById('message').style.color = 'red';
        document.getElementById('btnEnregistrer').setAttribute("disabled", true)
        document.getElementById('message').innerHTML = 'Le mot de passe ne correspond pas !';
    }
}