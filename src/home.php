<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>


<?php get_header(); 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$categories = get_categories( array(
  'post_type' => 'post',
  'orderby'   => 'name',
  'order'     => 'ASC',
  'taxonomy'  => 'category',
  'hide_empty' => true,
) );
?>

<main id="site-main" class="site-main">
    <div class="wp-block-cover is-style-hero is-style-hero--blog">
        <?php echo wp_get_attachment_image(get_field('blog_hero', 'options'), 'large', '', array( "class" => "wp-block-cover__image-background" )); ?>
        <div class="wp-block-cover__inner-container">
            <?php echo get_field('blog_hero_content', 'options'); ?>
        </div>
    </div>
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">
            <form class="blog__sort-form" id="sort-form">
                <span>FILTER</span>
                <div>
                    <select id="category" name="categoryId">
                        <option value="">ALL Categories</option>
                        <?php foreach($categories as $cat) : ?>
                            <option value="<?php echo $cat->term_id; ?>"<?php if($_GET['categoryId'] == $cat->term_id) { echo ' selected'; } ?>><?php echo $cat->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input id="sort-submit" type="submit" value="Submit" class="screen-reader-text">
            </form>
        </div>
    </div>
    <div class="wp-block-group" id="blog-list">
        <div class="wp-block-group__inner-container blog__wrap">
            <?php if ( have_posts() ): ?>
                <ul class="blog__list">
                    <?php
                        while ( have_posts() ) :
                            the_post();
                            $post_cats = get_the_terms( $post->ID, 'category' ); 
                    ?>
                        <li class="blog__listing content">
                            <article class="blog__teaser">
                                <a href="<?php echo get_permalink(); ?>">
                                    <div class="blog__teaser__image-wrap">
                                        <?php echo get_the_post_thumbnail( $post, 'large' ); ?>
                                    </div>
                                    <div class="blog__teaser__content-wrap">
                                        <div class="blog__teaser__categories">
                                            <?php foreach($post_cats as $cat) { echo '<span>' . $cat->name . '</span>'; } ?>
                                        </div>
                                        <h2>
                                            <sup><?php echo get_the_date('M d, Y'); ?></sup>
                                            <?php echo the_title(); ?>
                                        </h2>
                                        <?php echo the_excerpt(); ?>
                                        <span>Read more</span>
                                    </div>
                                </a>
                            </article>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <div class="next-page-link-wrapper wp-block-button" data-page-current="<?php echo $paged; ?>" data-per-page="<?php echo get_option('posts_per_page'); ?>"><?php print get_next_posts_link(); ?></div>
            <?php else: ?>
                <p>Sorry, there are no blog posts to show.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
