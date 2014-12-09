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
				
				var validator = jQuery("#form_modification").validate({
				//Creation de nos regles pour la validation du formulaire "form_inscription"
				rules: {
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