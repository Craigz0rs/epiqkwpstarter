<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>


<?php get_header(); 

?>
<main id="site-main" class="site-main">
<?php
  if ( have_posts() ) {
    while ( have_posts() ) {

        the_post(); ?>

        <?php the_content(); ?>
<?php }
  } 
?>

</main>
<?php get_footer(); ?>