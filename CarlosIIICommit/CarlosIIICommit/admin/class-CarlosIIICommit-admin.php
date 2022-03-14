<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CarlosIIICommit
 * @subpackage CarlosIIICommit/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CarlosIIICommit
 * @subpackage CarlosIIICommit/admin
 * @author     Your Name <email@example.com>
 */
class CarlosIIICommit_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $CarlosIIICommit    The ID of this plugin.
	 */
	private $CarlosIIICommit;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $CarlosIIICommit       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $CarlosIIICommit, $version ) {

		$this->CarlosIIICommit = $CarlosIIICommit;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CarlosIIICommit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CarlosIIICommit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->CarlosIIICommit, plugin_dir_url( __FILE__ ) . 'css/CarlosIIICommit-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CarlosIIICommit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CarlosIIICommit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->CarlosIIICommit, plugin_dir_url( __FILE__ ) . 'js/CarlosIIICommit-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function CarlosIIICommit_inscribe() {

		$inscritos = get_option('JuezLTICommit_inscritos');

		if(!in_array(htmlspecialchars($_POST["nombre"]), $inscritos)) {

			$inscritos[] = htmlspecialchars($_POST["nombre"]);
			update_option('JuezLTICommit_inscritos', $inscritos);
			$nombreInscrito = htmlspecialchars($_POST["nombre"]);
			$emailInscrito = htmlspecialchars($_POST["email"]);
			$urlInscrito = htmlspecialchars($_POST["url_logotipo"]);
			if(!$this->getInscrito($emailInscrito)) {
				$this->addInscrito($nombreInscrito, $emailInscrito, $urlInscrito);
			} 

		}

        wp_safe_redirect(site_url() );
    }

    public function getInscrito($emailInscrito) {
       global $wpdb;

           $table_name = $wpdb->prefix . "c3jInscritos";
               // convendría no duplicar este código
               // Una buena forma sería crear una constante en la clase CarlosIIICommit con:
               // const C3JINSCRITOS_TABLE = 'c3jInscritos';
               // y acceder a ella desde este código
               // $table_name = $wpdb->prefix . CarlosIIICommit::C3JINSCRITOS_TABLE;
           $query = "SELECT count(email) FROM $table_name WHERE email = %s";
           $existeInscrito = $wpdb->get_var( $wpdb->prepare($query, $emailInscrito)); 
           return $existeInscrito > 0;
    }

    public function addInscrito($nombreInscrito, $emailInscrito, $urlInscrito) {
       global $wpdb;

           $table_name = $wpdb->prefix . "c3jInscritos";
           $wpdb->insert(
               $table_name,
               array(
                       'nombre' => $nombreInscrito,
					   'email' => $emailInscrito,
					   'url_logotipo' => $urlInscrito,
                       'time' => current_time('mysql', 2),
               ),
               array('%s')
           );
    }

}
