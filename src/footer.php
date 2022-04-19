<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>

<footer class="footer" id="colophon">
  <div class="footer__sub-footer content-wrap">
    <?php // print apply_filters( 'the_content', get_post( 33 )->post_content ); ?>
    <p>&copy; Copyright <?php echo date('Y'); ?> Company name here</p>
    <p>Website by <a href="https://epiqk.io" target="_blank" rel="noopener">epiqk</a></p>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>