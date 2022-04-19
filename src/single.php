<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>

<?php get_header(); 

if ( have_posts() ) {
  while ( have_posts() ) {

      the_post(); 

      $next_post = get_adjacent_post(false, '', false);
      $prev_post = get_adjacent_post(false, '', true);

?>
<main id="site-main" class="site-main">
  <article class="blog__single">
    <div class="wp-block-cover is-style-hero is-style-hero--blog">
        <?php echo get_the_post_thumbnail($post, 'large', array( "class" => "wp-block-cover__image-background" )); ?>
        <div class="wp-block-cover__inner-container">
            <h1>
              <sup>
                <?php
                  $post_cats = get_the_terms( $post->ID, 'category' );
                  foreach($post_cats as $cat) {
                    echo '<span>' . $cat->name . '</span>';
                  }
                ?>
              </sup>
              <?php echo the_title(); ?></h1>
              <span><?php echo get_the_date('M d, Y'); ?></span>
        </div>
    </div>
    <div class="wp-block-group">
      <div class="wp-block-group__inner-container blog__single__wrap">
        <div class="blog__single__share">
          <span>SHARE</span>
          <ul class="blog__single__share-list">
              <?php $url = get_permalink(); ?>
              <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php print esc_url( $url ) ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.35 21.35"><g data-name="Layer 2"><path d="M21.34 21.35v-7.83c0-3.83-.83-6.78-5.3-6.78A4.64 4.64 0 0011.86 9h-.06V7.09H7.55v14.26H12v-7.06c0-1.86.35-3.66 2.66-3.66s2.3 2.13 2.3 3.78v6.94zM.35 7.1h4.43v14.25H.35zM2.56 0a2.58 2.58 0 102.57 2.56A2.56 2.56 0 002.56 0z"/></g></svg></a></li>
              <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php print esc_url( $url ) ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.45 23.03"><path d="M12 0H9C5.64 0 3.47 2.22 3.47 5.67v2.61h-3a.47.47 0 00-.47.47v3.79a.47.47 0 00.47.46h3v9.55a.47.47 0 00.47.47h3.92a.47.47 0 00.47-.47V13h3.51a.47.47 0 00.47-.47V8.75a.47.47 0 00-.14-.33.44.44 0 00-.33-.14H8.33V6.07c0-1.07.25-1.61 1.67-1.61h2a.47.47 0 00.45-.46V.47A.48.48 0 0012 0z" data-name="Layer 2"/></svg></a></li>
              <li><a href="https://twitter.com/intent/tweet?url=<?php print esc_url( $url ) ?>&text=<?php print (string) get_the_title(); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.67 17.6"><path d="M21.67 2.08a8.83 8.83 0 01-2.56.7 4.49 4.49 0 002-2.46 8.89 8.89 0 01-2.87 1.08 4.44 4.44 0 00-7.68 3 4.9 4.9 0 00.11 1A12.64 12.64 0 011.51.81a4.36 4.36 0 00-.6 2.24 4.42 4.42 0 002 3.69 4.4 4.4 0 01-2-.55 4.47 4.47 0 003.57 4.37 5 5 0 01-1.17.15 4.6 4.6 0 01-.84-.08 4.46 4.46 0 004.15 3.09 8.92 8.92 0 01-5.52 1.89A9.28 9.28 0 010 15.6a12.51 12.51 0 006.82 2A12.56 12.56 0 0019.46 5v-.58a8.71 8.71 0 002.23-2.3z" data-name="Layer 2"/></svg></a></li>
              <li><a id="copy-link" value="<?php echo the_permalink(); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.66 16.66"><g data-name="Layer 2"><path d="M12.67 0a4 4 0 00-2.82 1.17l-3.1 3.1a5.66 5.66 0 01.72-.07 5.17 5.17 0 011.92.37l1.94-1.93a1.88 1.88 0 011.34-.56A1.92 1.92 0 0114.58 4 1.89 1.89 0 0114 5.33l-3.46 3.48a2 2 0 01-2.69 0l-1.48 1.48a4 4 0 005.64 0l3.48-3.49A4 4 0 0012.67 0z"/><path d="M7.25 12.1L5.33 14a1.89 1.89 0 01-1.33.58 1.92 1.92 0 01-1.91-1.91 1.88 1.88 0 01.56-1.34l3.47-3.48a2 2 0 012.69 0l1.47-1.48a4.08 4.08 0 00-5.63 0L1.17 9.85a4 4 0 105.63 5.64l3.07-3.06a5.2 5.2 0 01-.68.06 4.91 4.91 0 01-1.94-.39z"/></g></svg></a></li>
            </ul>
        </div>
        <div class="blog__single__body">
          <?php the_content(); ?>
        </div>
      </div>
    </div>

    <div class="blog__single__pagination wp-block-group">
      <div class="wp-block-group__inner-container">
        <div>
          <?php if($prev_post) { ?>
            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="blog__link">Previous Post</a>
          <?php } ?>
        </div>
        <div class="wp-block-buttons intersected">
          <div class="wp-block-button intersected">
            <a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>" class="wp-block-button__link" aria-label="Back to main posts page"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.08 20"><defs><style>.cls-1{fill:currentColor}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Artwork"><path class="cls-1" d="M0 0h4v4H0zM8.08 0h4v4h-4zM16.08 0h4v4h-4zM0 8h4v4H0zM8.08 8h4v4h-4zM16.08 8h4v4h-4zM0 16h4v4H0zM8.08 16h4v4h-4zM16.08 16h4v4h-4z"/></g></g></svg></a>
          </div>
        </div>
        <div>
          <?php if($next_post) { ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>" class="blog__link">Next Post</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </article>
</main>
<?php 
  }
}
?>
<?php get_footer(); ?>

