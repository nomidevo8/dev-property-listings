<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$paged = max( 1, get_query_var('paged'), (int) ( $_GET['paged'] ?? 1 ) );

?>
<div class="container my-5 dev-search-properties">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Search Results</h1>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" href="<?php echo esc_url( get_post_type_archive_link('dev_property') ); ?>">Clear filters</a>
            <a class="btn btn-link" href="<?php echo esc_url( get_post_type_archive_link('dev_property') ); ?>">← Back to All Properties</a>
        </div>
    </div>
	<div class="row g-4">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); if ( get_post_type() !== 'dev_property' ) continue; ?>
			<div class="col-12 col-sm-6 col-lg-4">
				<?php
					$pricev   = get_post_meta( get_the_ID(), '_dev_price', true );
					$currency = get_post_meta( get_the_ID(), '_dev_currency', true );
					$freq     = get_post_meta( get_the_ID(), '_dev_price_frequency', true );
					$cityv    = get_post_meta( get_the_ID(), '_dev_city', true );
					$typev    = get_post_meta( get_the_ID(), '_dev_property_type', true );
					$statusv  = get_post_meta( get_the_ID(), '_dev_listing_status', true );
					$beds     = get_post_meta( get_the_ID(), '_dev_bedrooms', true );
					$baths    = get_post_meta( get_the_ID(), '_dev_bathrooms', true );
					$size     = get_post_meta( get_the_ID(), '_dev_property_size', true );
					$pool     = get_post_meta( get_the_ID(), '_dev_swimming_pool', true );
					$garden   = get_post_meta( get_the_ID(), '_dev_garden', true );
				?>
				<div class="card h-100 shadow-sm overflow-hidden">
					<div class="position-relative">
						<a href="<?php the_permalink(); ?>" class="ratio ratio-16x9 d-block bg-light">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'medium_large', [ 'class' => 'card-img-top object-fit-cover' ] );
							} ?>
						</a>
						<?php if ( $statusv ) : ?>
							<span class="badge bg-primary position-absolute text-white top-0 start-0 m-2"><?php echo esc_html( $statusv ); ?></span>
						<?php endif; ?>
						<?php if ( $pricev !== '' ) : ?>
							<span class="badge bg-success position-absolute text-white top-0 end-0 m-2">
								<?php echo esc_html( ($currency ? $currency . ' ' : '') . number_format_i18n( floatval( $pricev ) ) . ( $freq ? ' / ' . $freq : '' ) ); ?>
							</span>
						<?php endif; ?>
					</div>

					<div class="card-body">
						<h5 class="card-title mb-1"><a class="text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<?php if ( $cityv ) : ?><div class="text-muted small mb-2"><?php echo esc_html( $cityv ); ?></div><?php endif; ?>

						<div class="d-flex flex-wrap gap-2 small">
							<?php if ( $beds !== '' ) : ?><span class="badge bg-light text-dark border">🛏 <?php echo esc_html( $beds ); ?> Beds</span><?php endif; ?>
							<?php if ( $baths !== '' ) : ?><span class="badge bg-light text-dark border">🛁 <?php echo esc_html( $baths ); ?> Baths</span><?php endif; ?>
							<?php if ( $size !== '' ) : ?><span class="badge bg-light text-dark border">📐 <?php echo esc_html( $size ); ?> m²</span><?php endif; ?>
							<?php if ( $typev ) : ?><span class="badge bg-light text-dark border">🏷 <?php echo esc_html( $typev ); ?></span><?php endif; ?>
						</div>
					</div>

					<div class="card-footer bg-white">
						<div class="d-flex flex-wrap gap-2 small">
							<?php if ( $pool && strtolower($pool) !== 'none' ) : ?><span class="badge bg-primary-subtle text-primary border">Pool</span><?php endif; ?>
							<?php if ( $garden ) : ?><span class="badge bg-success-subtle text-success border">Garden</span><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; else: ?>
			<div class="col-12">
				<div class="alert alert-info">No matching properties found.</div>
			</div>
		<?php endif; ?>
	</div>

	<?php
	$big = 999999999;
	$pagination = paginate_links([
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $wp_query->max_num_pages,
		'type' => 'list',
	]);
	if ( $pagination ) echo '<div class="mt-4">' . wp_kses_post( $pagination ) . '</div>';
	?>
</div>
<?php get_footer(); ?>
