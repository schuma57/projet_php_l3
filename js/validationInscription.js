        $(document).ready(function(){
			//Création d'une méthode perso pour tester si un champ ne contient que des lettres
			jQuery.validator.addMethod("string", function(value, element, param) {
                if(value.length > 0)
				    return value.match(new RegExp("^[a-zA-Z]+$"));
                else
                    return true;
			}, "Ne peut contenir autre chose que des lettres");
			
			jQuery.validator.addMethod("date", function(value, element, param) {
                if(value.length > 0)
				    return value.match(new RegExp("^(((0[1-9]|[12][0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$"));
                else
                    return true;
            }, "Date invalide");
				
				var validator = jQuery("#form_inscription").validate({
				//Creation de nos regles pour la validation du formulaire "form_inscription"
				rules: {
					pseudo:{
						required:true,
						minlength: 3
					},
					motdepasse:{
                        required:true,
						password:"#pseudo"
					},
					nom:{
						string:true
					},
					prenom:{
						string:true
					},
					sexe:{
					},
					email:{
						email:true
					},
					naissance:{
						date:true
					},
					telephone:{
						minlength:10,
						digits:true
					},
					postal:{
						minlenght:5,
						digits:true
					},
					ville:{
						string:true
					},
					adresse:{
					
					}
				},
				//Ajout des messages personnalisés. On aurait pu importer les fichiers type localisation fr
				messages:{
					pseudo:{
						required:"Veuillez préciser votre pseudonyme",
						minlength: "Votre pseudonyme doit être composé d'au moins 2 caractères"
					},
					motdepasse:{
						required:"Veuillez préciser votre mot de passe",
						minlength: "Votre mot de passe doit être composé d'au moins 2 caractères"
					},
					nom:{
						required:"Veuillez préciser votre nom",
						minlength: "Votre nom doit être composé d'au moins 2 caractères"
					},
					prenom:{
						required:"Veuillez préciser votre prénom",
						minlength: "Votre prénom doit être composé d'au moins 2 caractères"
					},
					sexe:{
						required:"Veuillez préciser votre sexe"
					},					
					email:{
						required:"Veuillez saisir votre adresse mail",
						email:"Veuillez entrer une adresse mail valide"
					},
					naissance:{
						required:"Veuillez indiquer votre date de naissance"
					},
					telephone:{
						required:"Veuillez entrer votre numéro de téléphone",
						minlength:"Un numéro de téléphone se compose de 10 chiffres",
						digits:"Format invalide"
					},
					postal:{
						minlenght:"Code postal incomplet",
						digits:"Le code postal ne peut contenir que des chiffres"
					},
					ville:{
						string:"Ville invalide"
					},
					adresse:{
					
					}
				},
				submitHandler: function(form) {
					//alert("Formulaire envoyé");
                    form.submit();
				},
				errorElement: "div",
				wrapper: "div",
				success: function(element){
					$(element).addClass('valid').removeClass('error');
				},
				errorPlacement: function(error, element) {
					offset = element.offset();
					error.insertBefore(element);
					error.css('position', 'absolute');
					error.css('left', offset.left + element.outerWidth()+ 30);
					error.css('top', offset.top - 3);
				}
			});
        });

		(function($) {
			
			//On a ajouté ici nos propres tests
			var LOWER = /[a-z]/,
				UPPER = /[A-Z]/,
				DIGIT = /[0-9]/,
				DIGITS = /[0-9].*[0-9]/,
				SPECIAL = /[^a-zA-Z0-9]/,
				SAME = /^(.)\1+$/,
				LETTRES = /[a-zA-Z]/;
				
			function rating(rate, message) {
				return {
					rate: rate,
					messageKey: message
				};
			}
			
			function uncapitalize(str) {
				return str.substring(0, 1).toLowerCase() + str.substring(1);
			}
			
			$.validator.passwordRating = function(password, username) {
				if (!password || password.length < 3)
					return rating(0, "too-short");
				if (username && password.toLowerCase().match(username.toLowerCase()))
					return rating(0, "similar-to-username");
				if (SAME.test(password))
					return rating(1, "very-weak");
				
				var lower = LOWER.test(password),
					upper = UPPER.test(uncapitalize(password)),
					digit = DIGIT.test(password),
					digits = DIGITS.test(password),
					special = SPECIAL.test(password),
					//Ajout test personnalisé. On ne prend pas en compte la casse dans ce test (c'est ce que l'on veut dans la consigne)
					lettres = LETTRES.test(password);
				
				if (lettres && digit && password.length > 6 || lettres && digits && password.length > 6 || special && password.length > 6 )
					return rating(4, "strong");
				if (lettres && password.length > 6 || digits && password.length > 6 )
					return rating(3, "good");
				return rating(2, "weak");
			}
			//Personnalisation des messages, on ajoute un petit côté "user friendly" parce qu'on sait que le projet est fictif
			$.validator.passwordRating.messages = {
				"similar-to-username": "Similaire au pseudo",
				"too-short": "Trop court",
				"very-weak": "Trop faible",
				"weak": "Faible",
				"good": "Acceptable",
				"strong": "Robuste"
			}
			
			$.validator.addMethod("password", function(value, element, usernameField) {
				var password = element.value,
					username = $(typeof usernameField != "boolean" ? usernameField : []);
				var rating = $.validator.passwordRating(password, username.val());
				var meter = $(".password-meter", element.form);
				meter.find(".password-meter-bar").removeClass().addClass("password-meter-bar").addClass("password-meter-" + rating.messageKey);
				meter.find(".password-meter-message")
				.removeClass()
				.addClass("password-meter-message")
				.addClass("password-meter-message-" + rating.messageKey)
				.text($.validator.passwordRating.messages[rating.messageKey]);
				//Ici nous avons abaissé le niveau de robustesse à partir duquel le mot de passe est acceptable pour l'envoi 2 -> 1
				return rating.rate > 1;
			}, "&nbsp;");
			$.validator.classRuleSettings.password = { password: true };
		})(jQuery);