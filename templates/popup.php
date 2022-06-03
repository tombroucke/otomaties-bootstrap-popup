<div class="modal fade otomaties-bootstrap-popup" id="popup-<?php echo $popup->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="popup-<?php echo $popup->getId() ?>Label" aria-hidden="true" data-show-once="<?php echo $popup->showOnce(); ?>" data-delay="<?php echo $popup->delay(); ?>" data-hash="<?php echo $popup->hash(); ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popup-<?php echo $popup->getId() ?>Title"><?php echo $popup->title(); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo apply_filters('the_content', $popup->content()); ?>
            </div>
            <?php if (!empty($popup->buttons()) || $popup->showCloseButton()) : ?>
                <div class="modal-footer">
                    <?php foreach ($popup->buttons() as $button) : ?>
                        <a href="<?php echo esc_url($button['link']); ?>" class="btn btn-<?php echo esc_attr($button['theme']); ?>" target="<?php echo esc_attr($button['target']); ?>"><?php echo esc_html($button['label']); ?></a>
                    <?php endforeach; ?>
                    <?php if ($popup->showCloseButton()) : ?>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><?php _e('Close', 'otomaties-popup'); ?></button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
