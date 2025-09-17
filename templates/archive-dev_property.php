<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

// Read filters
$city   = isset($_GET['city']) ? sanitize_text_field( wp_unslash( $_GET['city'] ) ) : '';
$type   = isset($_GET['type']) ? sanitize_text_field( wp_unslash( $_GET['type'] ) ) : '';
$status = isset($_GET['status']) ? sanitize_text_field( wp_unslash( $_GET['status'] ) ) : '';
$min    = isset($_GET['min_price']) ? floatval( $_GET['min_price'] ) : '';
$max    = isset($_GET['max_price']) ? floatval( $_GET['max_price'] ) : '';
$kw     = isset($_GET['s']) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';

$meta_query = [ 'relation' => 'AND' ];
if ( $city !== '' )   $meta_query[] = [ 'key' => '_dev_city', 'value' => $city, 'compare' => 'LIKE' ];
if ( $type !== '' )   $meta_query[] = [ 'key' => '_dev_property_type', 'value' => $type, 'compare' => '=' ];
if ( $status !== '' ) $meta_query[] = [ 'key' => '_dev_listing_status', 'value' => $status, 'compare' => '=' ];
if ( $min !== '' )    $meta_query[] = [ 'key' => '_dev_price', 'value' => $min, 'type' => 'NUMERIC', 'compare' => '>=' ];
if ( $max !== '' )    $meta_query[] = [ 'key' => '_dev_price', 'value' => $max, 'type' => 'NUMERIC', 'compare' => '<=' ];

$paged = max( 1, get_query_var('paged'), (int) ( $_GET['paged'] ?? 1 ) );
$args = [
	'post_type' => 'dev_property',
	'post_status' => 'publish',
	'paged' => $paged,
	'posts_per_page' => 12,
	's' => $kw,
];
if ( count( $meta_query ) > 1 ) $args['meta_query'] = $meta_query;

$query = new WP_Query( $args );
?>
<div class="container my-5 dev-archive-properties">
	<h1 class="mb-4">Properties</h1>

	<form class="row g-3 mb-2" method="get">
		<div class="col-12 col-md-3">
			<input type="text" class="form-control" name="s" placeholder="Keywords" value="<?php echo esc_attr( $kw ); ?>">
		</div>
		<div class="col-6 col-md-2">
			<input type="text" class="form-control" name="city" placeholder="City" value="<?php echo esc_attr( $city ); ?>">
		</div>
		<div class="col-6 col-md-2">
			<select class="form-select" name="type">
				<option value="">Type</option>
				<?php foreach ( ['House','Apartment','Villa','Studio','Townhouse','Land','Commercial'] as $opt ): ?>
					<option value="<?php echo esc_attr($opt); ?>" <?php selected( $type, $opt ); ?>><?php echo esc_html($opt); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="col-6 col-md-2">
			<select class="form-select" name="status">
				<option value="">Status</option>
				<?php foreach ( ['For Sale','For Rent','Sold','Leased','Under Offer','Coming Soon'] as $opt ): ?>
					<option value="<?php echo esc_attr($opt); ?>" <?php selected( $status, $opt ); ?>><?php echo esc_html($opt); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="col-6 col-md-1">
			<input type="number" class="form-control" name="min_price" placeholder="Min" value="<?php echo esc_attr( $min ); ?>">
		</div>
		<div class="col-6 col-md-1">
			<input type="number" class="form-control" name="max_price" placeholder="Max" value="<?php echo esc_attr( $max ); ?>">
		</div>
		<div class="col-6 col-md-1 d-grid">
			<button class="btn btn-primary" type="submit">Filter</button>
		</div>

	</form>


	<div class="row g-4">
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
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
				<div class="alert alert-info">No properties found.</div>
			</div>
		<?php endif; wp_reset_postdata(); ?>
	</div>

	<?php
	$big = 999999999;
	$pagination = paginate_links([
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $query->max_num_pages,
		'type' => 'list',
	]);
	if ( $pagination ) echo '<div class="mt-4">' . wp_kses_post( $pagination ) . '</div>';
	?>
</div>
<?php get_footer(); ?>
