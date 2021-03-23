<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

$description = get_the_archive_description();
?>
<script>console.log(<?php echo json_encode( get_field('tribe_image', get_queried_object()) ); ?>)</script>
<?php if ( have_posts() ) : ?>

	<header class="page-header alignwide">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
      <?php if ( get_query_var( 'tribe_category' ) ) : ?>
        <h2><?php echo get_term_by( 'slug', get_query_var('tribe_category'), 'tribe_category' )->name; ?></h2>
      <?php endif; ?>
      <img src="<?php echo get_field('tribe_image', get_queried_object()); ?>">
		<?php endif; ?>
	</header><!-- .page-header -->

<div class="archive-container">
  <div class="article-list">
    <h4>Articles</h4>
    <div class="content">
      <?php while ( have_posts() ) :
        the_post();

        if ( get_post_type() === 'tribe' && get_field('type') === 'Article' ):
          get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
        endif;

      endwhile; ?>
    </div>
  </div>

  <div class="book-list">
    <h4>Books</h4>
    <div class="content">
      <?php while ( have_posts() ) :
        the_post();

        if ( get_post_type() === 'tribe' && get_field('type') === 'Book' ):
          get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
        endif;
        
      endwhile; ?>
    </div>
  </div>
</div>

	<?php twenty_twenty_one_the_posts_navigation(); ?>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
