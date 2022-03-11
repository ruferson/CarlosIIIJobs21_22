(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
    $(function() {

        $('.widget_form_inscribe').on('submit', function (e) {
            e.preventDefault();

            var $form = $(this);
            $.post($form.attr('action'), $form.serialize(), function (data) {
                alert(data.message);
				$('#solo-inscribe-nombre').val("");
				$('#solo-inscribe-email').val("");
				$('#solo-inscribe-url_logotipo').val("");
				$('#boton_enviar').attr("disabled", true);
            }, 'json');
        });

    });

})( jQuery );
