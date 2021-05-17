<?php
$enabled 			= get_field('popup_enabled', 'option');
$front_page_only 	= get_field('popup_front_page_only', 'option');
$title 				= get_field('popup_title', 'option');
$content 			= get_field('popup_content', 'option');
$show_once 			= get_field('popup_show_once', 'option');
$delay 				= get_field('popup_delay', 'option') ?: 0;
$hash				= substr(md5($title . $content), 0, 6);
?>
<?php if( $enabled && ( !$front_page_only || is_front_page() ) ): ?>
	<!-- Modal -->
	<div class="modal fade" id="otomatiesModal" tabindex="-1" role="dialog" aria-labelledby="otomatiesModalTitle" aria-hidden="true" data-delay="<?php echo $delay; ?>" data-showonce="<?php echo ( $show_once ? $hash : ''); ?>">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<?php if( apply_filters( 'otomaties_popup_show_title', true ) ): ?>
						<h5 class="modal-title" id="otomatiesModalTitle"><?php echo $title; ?></h5>
					<?php endif; ?>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<?php echo apply_filters('otomaties_popup_header_close_button', '<span aria-hidden="true">&times;</span>'); ?>
					</button>
				</div>
				<div class="modal-body">
					<?php echo $content; ?>
				</div>
				<?php if( apply_filters( 'otomaties_popup_show_close_button', true ) ): ?>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal"><?php _e('Close', 'otomaties-popup'); ?></button>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif;
