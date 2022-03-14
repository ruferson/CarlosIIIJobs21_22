<?php 
class CarlosIIICommit_Options {

    public function CarlosIIICommit_options_menu() {
	    $hookname = add_submenu_page(
	        'edit.php?post_type=' . CarlosIIICommit_Commit_type::POST_TYPE,
	        __( 'Options del plugin CarlosIIICommit', 'textdomain' ),
	        __( 'Commit Options', 'textdomain' ),
	        'manage_options',
	        'Commit-options',
	        array( $this, 'Commit_options_callback' )
	    );

	    add_action( 'load-' . $hookname, array($this, 'CarlosIIICommit_save_options') );
	}

	function Commit_options_callback() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/Commit-options-form.php';
	}

    public function CarlosIIICommitRegistraOpciones() {
		$opciones = array(
			array(
				'name' => 'dominio',
				'title' => 'Dominio admitido',
				'args' => array(
					'type' => 'string',
					'default' => NULL,
				),
			),
			array(
				'name' => 'nCommit',
				'title' => 'N&uacute;mero de ofertas en Shortcode',
				'args' => array(
					'type' => 'integer',
					'default' => NULL,
				),
			),
		);
		foreach ($opciones as $opcion) {
		    register_setting( 'CarlosIIICommit_options', $opcion['name'], $opcion['args'] );
		}

		add_settings_section( 'CarlosIIICommit_options_section', 'Opciones', array($this, 'Commit_options_section_callback'), 'Commit-options');

		foreach ($opciones as $opcion) {
		    add_settings_field( $opcion['name'], $opcion['title'], array($this, 'Commit_options_' . $opcion['name'] . '_callback'), 'Commit-options', 'CarlosIIICommit_options_section');
		}

	}

    public function Commit_options_dominio_callback($args) {
    	echo '<input type="text" id="CarlosIIICommit_options_dominio" name="CarlosIIICommit_options_dominio" value="'. get_option('CarlosIIICommit_options_dominio') .'">';
    }

    public function Commit_options_nCommit_callback($args) {
    	echo '<input type="text" id="CarlosIIICommit_options_nCommit" name="CarlosIIICommit_options_nCommit" value="'. get_option('CarlosIIICommit_options_nCommit') .'">';
    }

    public function Commit_options_section_callback( $arg ) {
        echo '<hr>';       // title: Example settings section in reading
    }

    public function CarlosIIICommit_save_options() {
    	if ('POST' === $_SERVER['REQUEST_METHOD']) {
			update_option('CarlosIIICommit_options_dominio', htmlspecialchars($_POST["CarlosIIICommit_options_dominio"]));
			update_option('CarlosIIICommit_options_nCommit', htmlspecialchars($_POST["CarlosIIICommit_options_nCommit"]));
			wp_redirect( admin_url( 'edit.php?post_type=' . CarlosIIICommit_Commit_type::POST_TYPE) );
		}
    }

}