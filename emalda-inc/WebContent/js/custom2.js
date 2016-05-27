// If JavaScript is enabled remove 'no-js' class and give 'js' class
jQuery('html').removeClass('no-js').addClass('js');


// When DOM is fully loaded
jQuery(document).ready(function($) {


	/* Contact Form
	 ---------------------------------------------------------------------- */
	(function() {

		var 
			$form   = $('.contact-form'),
			$ajax_loader = '<img src="img/loader.gif" height="11" width="16" alt="Loading..." />';

		$form.append('<div id="ajax-message" class="hidden"></div>');
		var $ajax_message = $('#ajax-message');
		
		// Submit click event
		$form.on('click', 'input[type=submit]', function(e){

			$ajax_message.hide().html($ajax_loader).show();
			
			// Ajax request
			$.post('plugins/contact-form.php', $form.serialize(), function(data) {

				// Show ajax-message
				$ajax_message.html(data);

				// If the message was sent, clear form fields
				if (data.indexOf("success") != -1) {
					clear_form_elements($form);
				}
			});
			
			e.preventDefault();
		});

		function clear_form_elements(el) {

		    $(el).find(':input').each(function() {
		        switch(this.type) {
		            case 'password':
		            case 'select-multiple':
		            case 'select-one':
		            case 'text':
		            case 'email':
		            case 'textarea':
		                $(this).val('');
		                break;
		            case 'checkbox':
		            case 'radio':
		                this.checked = false;
		        }
		    });

		}

	})();

});