 $(document).ready(function(){
				var validator = jQuery("#form_connexion").validate({
				//Creation de nos regles pour la validation du formulaire "form_connexion"
				rules: {
					pseudo:{
						required:true,
						minlength: 3
					},
					motdepasse:{
                        required:true
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