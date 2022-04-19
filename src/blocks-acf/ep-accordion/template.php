<?php

/**
 * Epiqk Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Load values and assign defaults.

?>
<div class="accordion">
    <?php if(have_rows('accordion')): ?>
        <?php while(have_rows('accordion')): the_row(); ?>
            <div class="accordion__item">
                <div class="accordion__item__title">
                    <h3><button><span><?php echo esc_html( get_sub_field('title') ); ?></span><b></b></button></h3>
                </div>
                <div class="accordion__item__content">
                    <?php echo get_sub_field('content'); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>