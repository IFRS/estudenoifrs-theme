<?php
add_action( 'admin_head', function() {
	echo '<style>
	#editor .block-library-heading-level-dropdown .components-dropdown-menu__menu button:first-child {
		width: 0;
		min-width: auto;
		padding: 0;
		pointer-events: none;
		visibility: hidden;
	}
	</style>';
} );
