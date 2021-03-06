        $(document).ready(function(){
				var validator = jQuery("#form_mdp").validate({
				// Creation de nos regles pour la validation du formulaire "form_inscription"
				rules: {
					nouveaumdp:{
                        required:true,
                        passwordCustom:"#pseudo"
					},
					confNouveau:{
						equalTo:"#nouveaumdp"
					}
				},
				// Ajout des messages personnalisés. On aurait pu importer les fichiers type localisation fr
				messages:{
					nouveaumdp:{
						required:"Veuillez préciser le nouveau mot de passe"
					},
					confNouveau:{
						equalTo: "Les deux mots de passe doivent être identiques"
					}
				},
				submitHandler: function(form) {
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
					//Ajout test personnalisé. On ne prend pas en compte la casse dans ce test
					// (c'est ce que l'on veut dans la consigne)
					lettres = LETTRES.test(password);
				
				if (lettres && digit && password.length > 6
                        || lettres && digits && password.length > 6 || special && password.length > 6 )
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
			
			$.validator.addMethod("passwordCustom", function(value, element, usernameField) {
				var password = element.value,
					username = $(typeof usernameField != "boolean" ? usernameField : []);
				var rating = $.validator.passwordRating(password, username.val());
				var meter = $(".password-meter", element.form);
				console.log(password);
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