<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>


<?php get_header(); 

$background_image = get_field('404_background', 'option');

?>

<main id="site-main" class="site-main">
    <div class="wp-block-cover is-style-hero">
        <span aria-hidden="true" class="has-black-background-color has-background-dim-30 wp-block-cover__gradient-background has-background-dim"></span>
        <?php echo wp_get_attachment_image(get_field('404_background', 'options'), 'large', '', array( "class" => "wp-block-cover__image-background" )); ?>        
        <div class="wp-block-cover__inner-container">
            <h1>404: Not found</h1>
            <div class="wp-block-buttons">
                <div class="wp-block-button">
                    <a href="/" class="wp-block-button__link">Back to home</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>