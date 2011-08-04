<ul>
	<li><a href="<?php echo dirname( $_SERVER['REQUEST_URI'] ) ?>">Back to Examples</a></li>
	<li><a href="<?php echo GITHUB_EXAMPLES_URL ?><?php echo basename( $_SERVER['PHP_SELF'] ) ?>">View Example Code</a></li>
	<?php if( isset( $relevant_code ) ): ?>
	<li>
		Relevant Code:
		<ul>
			<?php foreach( $relevant_code as $code ): ?>
			<li><a href="<?php echo GITHUB_CODE_URL ?><?php echo ltrim( str_replace( '\\', '/', $code ), '/' ) ?>.php"><?php echo end( explode( '\\', $code ) ) ?></a></li>	
			<?php endforeach; ?>
		</ul>
	</li>
	<?php endif; ?>
	<?php if( defined( 'BUG_ID' ) ): ?><li><a href="<?php echo GITHUB_ISSUES_URL ?><?php echo BUG_ID ?>">Issue on Github</a></li><?php endif; ?>
</ul>