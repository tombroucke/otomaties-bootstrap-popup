<div class="<?php echo apply_filters('otomaties_bootstrap_popup_modal_classes', 'modal fade otomaties-bootstrap-popup '); ?>" id="popup-<?php echo $popup->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="popup-<?php echo $popup->getId() ?>Label" aria-hidden="true" data-show-once="<?php echo $popup->showOnce(); ?>" data-delay="<?php echo $popup->delay(); ?>" data-hash="<?php echo $popup->hash(); ?>">
    <div class="<?php echo apply_filters('otomaties_bootstrap_popup_modal_dialog_classes', 'modal-dialog'); ?>" role="document">
        <div class="<?php echo apply_filters('otomaties_bootstrap_popup_modal_content_classes', 'modal-content'); ?>">
            <div class="<?php echo apply_filters('otomaties_bootstrap_popup_modal_header_classes', 'modal-header'); ?>">
                <h5 class="<?php echo apply_filters('otomaties_bootstrap_popup_modal_title_classes', 'modal-title'); ?>" id="popup-<?php echo $popup->getId() ?>Title"><?php echo $popup->title(); ?></h5>
                <?php if ($version == '4.x') : ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                <?php else : ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <?php endif; ?>
            </div>
            <div class="<?php echo apply_filters('otomaties_bootstrap_popup_modal_body_classes', 'modal-body'); ?>">
                <?php echo apply_filters('otomaties_bootstrap_popup_content', $popup->content()); ?>
            </div>
            <?php if (!empty($popup->buttons()) || $popup->showCloseButton()) : ?>
                <div class="<?php echo apply_filters('otomaties_bootstrap_popup_modal_footer_classes', 'modal-footer'); ?>">
                    <?php foreach ($popup->buttons() as $button) : ?>
                        <a href="<?php echo esc_url($button['link']); ?>" class="btn btn-<?php echo esc_attr($button['theme']); ?>" target="<?php echo esc_attr($button['target']); ?>"><?php echo esc_html($button['label']); ?></a>
                    <?php endforeach; ?>
                    <?php if ($popup->showCloseButton()) : ?>
                        <?php if ($version == '4.x') : ?>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php _e('Close', 'otomaties-popup'); ?></button>
                        <?php else : ?>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><?php _e('Close', 'otomaties-popup'); ?></button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
