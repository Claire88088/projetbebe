    
(function($) {
    //MENU//
    // 1.Aide à la saisie d'un mot de passe fort (page inscription) //
    // 2.Confirmation du mot de passe (page inscription) //
    // 3. Validation avant envoi du formulaire (inscription) //
    // 4.Animation des icônes de l'accueil //

    // 1.Aide à la saisie d'un mot de passe fort //
    $('[type=password] + .alert').hide();

    // Déclaration des variables
    const alertElt  = $('#new-password + .alert');
    let passwordIsValid;

    // Déclaration des messages d'aide
    const lengthMessage = '8 caractères</br>';
    const numberMessage = 'un chiffre</br>';
    const lowerCaseMessage = 'une minuscule</br>';
    const upperCaseMessage= 'une majuscule</br>';
    const ponctuationMessage= 'un caractère spécial</br>';

    // Déclaration des expressions régulières (pour validation formulaires)
    const intRegex = new RegExp('[0-9]'); // chiffre
    const minLetterRegex = new RegExp('[a-z]'); // lettre minuscule
    const majLetterRegex = new RegExp('[A-Z]'); // lettre majuscule
    const ponctuationRegex = new RegExp('!|"|#|%|&|\'|,|-|:|;|<|=|>|@|/|_|`|{|}|~'); // signe de ponctuation // signes qui ne fonctionnent pas $ ( ) * + . ? [ ] \ ^
    
    $('#new-password').on('keyup', function(e) {
        if (alertElt.hasClass('alert-danger')) {
            alertElt.removeClass('alert-danger').addClass('alert-warning');
        }
        passwordIsValid = true; 
        let message ='Votre mot de passe doit contenir au minimum : </br>';
        let newPassword = (e.target.value);

        if (newPassword.length < 8) {
            passwordIsValid = false;
            message += lengthMessage; 
        }
        
        if (intRegex.test(newPassword) === false) {
            passwordIsValid = false;
            message += numberMessage; 
        }

        if (minLetterRegex.test(newPassword) === false) {
            passwordIsValid = false;
            message += lowerCaseMessage;
        }
        
        if (majLetterRegex.test(newPassword) === false) {
            passwordIsValid = false;
            message += upperCaseMessage;
        }

        if (ponctuationRegex.test(newPassword) === false) {
            passwordIsValid = false;
            message += ponctuationMessage;
        }
        
        if (passwordIsValid === false) {
            alertElt.html(message).show();
        } else {
            alertElt.hide();
        }    
    });


    // 2.Confirmation du mot de passe //

    $('#confirmation-password').on('keyup', function(e) {
        let newPassword = $('#new-password').val();

        if (e.target.value !== newPassword) {
            $('#confirmation-password + .alert').show().text('Les deux mots de passe doivent être identiques');
        } else {
            $('#confirmation-password + .alert').hide();
        }
    });


    // 3. Validation avant envoi du formulaire (inscription) //

    $('#registration-submit-btn').click(function(e) {
        newPassword = $('#new-password').val();
        confirmationPassWord = $('#confirmation-password').val();
        if (newPassword.length < 8 || !intRegex.test(newPassword) || !minLetterRegex.test(newPassword) || !majLetterRegex.test(newPassword) || !ponctuationRegex.test(newPassword)) {
            e.preventDefault();
            alertElt.html('Votre mot de passe n\'est pas conforme').removeClass('alert-warning').addClass('alert-danger').show();
        }
        
        if (newPassword !== confirmationPassWord) {
            e.preventDefault();
            alertElt.html('Les deux mots de passe doivent être identiques').removeClass('alert-warning').addClass('alert-danger').show();
        }
    });


    // 4.Animation des icônes de l'accueil //

    // on stocke la couleur de l'élément avant l'animation
    let defaultColorRgb = $('.fas').css('color');
    
    if (typeof(defaultColorRgb) === 'string') {
        // on transforme la couleur de rgb à hexa
        defaultColor = defaultColorRgb.substring(4, defaultColorRgb.length -1); // on enlève 'rgb( )' pour ne garder que les chiffres
        let defaultColorSplit = defaultColor.split(', ');
        let defaultR = parseInt(defaultColorSplit[0]);
        let defaultG = parseInt(defaultColorSplit[1]);
        let defaultB = parseInt(defaultColorSplit[2]);
        
        let defaultColorHexa = rgbToHex(defaultR, defaultG, defaultB);

        // animation sur les icones lors du survol de la souris
        $('.fas').mouseover(function(e) {
            $(this).animate({margin: ''}, {
                step: function() {
                    $(this).css('color', 'white');
                    $(this).css('transform','rotate(360deg)');
                    $(this).css('transition', 'transform 1000ms');
                }
            });
        });

        $('.fas').mouseout(function(e) {
            $(this).animate({margin: ''}, {
                step: function() {
                    $(this).css('color', defaultColorHexa);
                }
            });
        });
    }

})(jQuery);
