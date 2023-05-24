<?php

namespace WP_RSS_MC;

class ADMIN_SETTINGS extends BASE{

  function __construct(){
		$this->setNavigationTabs();
		add_action( 'admin_menu', [$this, 'registerMenu'] );
		//add_action( 'admin_init', [$this, 'settingsOptionsRegistration'] );
	}


	/**
	 * Callback function for registering submenu
	 */
	public function registerMenu(){
		add_submenu_page(
			'rssmcfeeds',
			'Settings',
      'Settings',
      'manage_options',
      'rssmcfeeds_settings',
      [$this, 'settingsTemplateCallback']
	   );
	}


	/**
	 * Initialize options for Tabbed Navigation.
	 * Update this attribute if new tab needs to be added
	 * Match the 'section-page' value to 'page-slug' value of section-settings-attributes
	 */
	public function setNavigationTabs(){
		$this->navigationTabs = array(
      array(
        'slug'          => 'settings',
        'title'         => 'Settings',
        'section-page'  => 'rssmcfeeds_settings_section'
      )
    );
	}


	/*
	* Returns array config for TabbedNavigation
	*/
	public function getNavigationTabs(){ return $this->navigationTabs; }

	public function settingsTemplateCallback(){
	?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<?php
		  	$navigation_tabs = $this->getNavigationTabs();

				// CHECK IF ACTIVE TAB IS PASSED IN THE URL
				// OR ELSE THE SLUG OF THE FIRST TAB
		  	$active_tab = '';
				if( isset( $_GET['tab'] ) ){ $active_tab = $_GET['tab']; }
				elseif( count( $navigation_tabs ) ){
					$active_tab = $navigation_tabs[0]['slug'];
				}
	    ?>

		  <h2 class="nav-tab-wrapper">
			<?php
				foreach ($navigation_tabs as $tab) {
					$active_class = ($tab['slug'] == $active_tab) ? 'nav-tab-active' : '';

					$page = $_GET['page'];
					$tab_slug = $tab['slug'];
					$tab_title = $tab['title'];

					echo "<a href='?page=$page&tab=$tab_slug' class='nav-tab $active_class'>$tab_title</a>";
				}
			?>
		  </h2>


			<?php
				foreach ($navigation_tabs as $tab) {
					if( $active_tab == $tab['slug'] ) {
            include( 'templates/' . $tab['slug'] . '.php' );
          }
				}


			?>

		</div>
    <?php
	}





}


ADMIN_SETTINGS::getInstance();
