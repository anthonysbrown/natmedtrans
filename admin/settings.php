<?php
add_action( 'admin_menu', 'natmedtrans_add_admin_menu' );
add_action( 'admin_init', 'natmedtrans_settings_init' );


function natmedtrans_add_admin_menu(  ) { 

	add_menu_page( 'Nat Med Trans', 'Nat Med Trans', 'manage_options', 'nat_med_trans', 'natmedtrans_options_page' );

}


function natmedtrans_settings_init(  ) { 

	register_setting( 'pluginPage', 'natmedtrans_settings' );

	add_settings_section(
		'natmedtrans_pluginPage_section', 
		__( 'Settings', 'natmedtrans' ), 
		'natmedtrans_settings_section_callback', 
		'pluginPage'
	);
add_settings_field( 
		'natmed_appurl', 
		__( 'APP URL', 'natmedtrans' ), 
		'natmed_appurl_render', 
		'pluginPage', 
		'natmedtrans_pluginPage_section' 
	);
	
	add_settings_field( 
		'natmed_clientid', 
		__( 'Client ID', 'natmedtrans' ), 
		'natmed_clientid_render', 
		'pluginPage', 
		'natmedtrans_pluginPage_section' 
	);

	
	
	
	add_settings_field( 
		'natmed_clientsecret', 
		__( 'Client Secret', 'natmedtrans' ), 
		'natmed_clientsecret_render', 
		'pluginPage', 
		'natmedtrans_pluginPage_section' 
	);

	add_settings_field( 
		'natmed_header', 
		__( 'Modal Header Text', 'natmedtrans' ), 
		'natmed_header_render', 
		'pluginPage', 
		'natmedtrans_pluginPage_section' 
	);

	add_settings_field( 
		'natmed_width', 
		__( 'Modal Width', 'natmedtrans' ), 
		'natmed_width_render', 
		'pluginPage', 
		'natmedtrans_pluginPage_section' 
	);


}

function natmed_appurl_render(  ) { 

	$options = get_option( 'natmedtrans_settings' );
	?>
	<input type='text' name='natmedtrans_settings[natmed_appurl]' value='<?php echo $options['natmed_appurl']; ?>' style="width:100%">
	<?php

}

function natmed_clientid_render(  ) { 

	$options = get_option( 'natmedtrans_settings' );
	?>
	<input type='text' name='natmedtrans_settings[natmed_clientid]' value='<?php echo $options['natmed_clientid']; ?>' style="width:100%">
	<?php

}


function natmed_clientsecret_render(  ) { 

	$options = get_option( 'natmedtrans_settings' );
	?>
	<input type='text' name='natmedtrans_settings[natmed_clientsecret]' value='<?php echo $options['natmed_clientsecret']; ?>' style="width:100%">
	<?php

}


function natmed_header_render(  ) { 

	$options = get_option( 'natmedtrans_settings' );
	?>
	<input type='text' name='natmedtrans_settings[natmed_header]' value='<?php echo $options['natmed_header']; ?>' style="width:100%">
	<?php

}


function natmed_width_render(  ) { 

	$options = get_option( 'natmedtrans_settings' );
	?>
	<input type='text' name='natmedtrans_settings[natmed_width]' value='<?php echo $options['natmed_width']; ?>' style="width:100%">
	<?php

}


function natmedtrans_settings_section_callback(  ) { 

	

}


function natmedtrans_options_page(  ) { 

		?>
		<form action='options.php' method='post'>

			<h2>Nat Med Trans</h2>

			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>

		</form>
		<?php

}
