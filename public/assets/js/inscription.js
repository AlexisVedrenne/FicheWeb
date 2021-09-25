var check = function() {
    if (document.getElementById('registration_form_plainPassword').value ==
        document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Le mot de passe correspond';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Le mot de passe ne correspond pas !';
    }
}