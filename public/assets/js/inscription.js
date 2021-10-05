var check = function() {
    if (document.getElementById('registration_form_plainPassword').value == document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Le mot de passe correspond';
        document.getElementById('btnEnregistrer').removeAttribute("disabled")
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('btnEnregistrer').setAttribute("disabled", true)
        document.getElementById('message').innerHTML = 'Le mot de passe ne correspond pas !';
    }
}

