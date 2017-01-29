$("#utilisateursForm").submit(function (evt) {
    $("#utilisateursForm div.form-group.has-error").removeClass("has-error");
    try {
        var regMail = /^[^@.]+[^@]*@[^@]+$/;
        var regLogin = /^[a-zA-Z0-9_]*$/;

        var nom = $("#nom");
        if (nom.val().trim().length === 0) {
            throw {field: nom, msg: "Le nom ne doit pas être vide"};
        } else if (nom.val().length > 255) {
            throw {field: nom, msg: "Nom trop long, 256 caractères maximum"};
        }
        var prenom = $("#prenom");
        if (prenom.val().trim().length === 0) {
            throw {field: prenom, msg: "Le prenom ne doit pas être vide"};
        } else if (prenom.val().length > 255) {
            throw {field: prenom, msg: "Prenom trop long, 256 caractères maximum"};
        }
        var email = $("#email");
        if (email.val().trim().length === 0) {
            throw {field: email, msg: "L'email ne doit pas être vide"};
        } else if (!regMail.test(email.val())) {
            throw {field: email, msg: "Email invalide"};
        }
        var login = $("#login");
        if (login.val().trim().length === 0) {
            throw {field: login, msg: "Le login ne doit pas être vide"};
        } else if (!regLogin.test(login.val())) {
            throw {field: login, msg: "Le login ne doit être composé que de lettres, chiffres et underscores"};
        } else if (login.val().trim().length <= 5) {
            throw {field: login, msg: "Le login doit faire plus de 5 caractères"};
        } else if (login.val().trim().length > 255) {
            throw {field: login, msg: "Login trop long, 256 caractères maximum"};
        }
        var motdepasse = $("#motdepasse");
        if ($("#mode").val() === 'create' || motdepasse.val().length) {
            if (motdepasse.val().length === 0) {
                throw {field: motdepasse, msg: "Le mot de passe ne doit pas être vide"};
            } else if (motdepasse.val().length < 6) {
                throw {field: motdepasse, msg: "Le mot de passe doit faire plus de 5 caractères"};
            }
            var confirmation = $("#confirmation");
            if (confirmation.val().length === 0) {
                throw {field: confirmation, msg: "Veuillez confirmer votre mot de passe"};
            } else if (confirmation.val() !== motdepasse.val()) {
                throw {field: confirmation, msg: "La confirmation est différente du mot de passe"};
            }
        }
    } catch (ex) {
        var message = $("#content h2+div.alert");
        if (message.length === 0) {
            $("<div>" + ex.msg + "</div>").addClass("alert alert-warning").insertAfter("#content h2");
        } else {
            message.html(ex.msg);
        }
        ex.field.closest("div.form-group").addClass("has-error");
        ex.field.focus();
        evt.preventDefault();
    }
});