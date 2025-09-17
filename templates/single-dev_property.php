<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $post;

// Collect meta helper
function dev_prop_get( $key, $default = '' ) {
	$value = get_post_meta( get_the_ID(), "_dev_{$key}", true );
	return $value !== '' ? $value : $default;
}

get_header();
?>
<div class="container my-5 dev-single-property">
	<div class="row g-4">
		<div class="col-12">
			<h1 class="display-5 mb-0"><?php the_title(); ?></h1>
			<?php if ( dev_prop_get('address') || dev_prop_get('city') ) : ?>
				<p class="text-muted mb-2">
					<?php echo esc_html( dev_prop_get('address') ); ?>
					<?php if ( dev_prop_get('city') ) echo ', ' . esc_html( dev_prop_get('city') ); ?>
					<?php if ( dev_prop_get('state') ) echo ', ' . esc_html( dev_prop_get('state') ); ?>
				</p>
			<?php endif; ?>
			<hr />
		</div>

		<div class="col-lg-8">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="mb-4">
					<?php the_post_thumbnail( 'large', [ 'class' => 'img-fluid rounded shadow-sm w-100' ] ); ?>
				</div>
			<?php endif; ?>

			<?php
			$gallery_ids = dev_prop_get('photo_gallery');
			if ( $gallery_ids ) {
				$ids = array_filter( array_map( 'absint', explode( ',', $gallery_ids ) ) );
				if ( ! empty( $ids ) ) {
					echo '<div id="propGallery" class="carousel slide mb-4" data-bs-ride="carousel">';
					echo '<div class="carousel-inner">';
					$active = 'active';
					foreach ( $ids as $id ) {
						$img = wp_get_attachment_image( $id, 'large', false, [ 'class' => 'd-block w-100 rounded' ] );
						echo '<div class="carousel-item ' . $active . '">' . $img . '</div>';
						$active = '';
					}
					echo '</div>';
					echo '<button class="carousel-control-prev dev-carousel-control" type="button" data-bs-target="#propGallery" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="dev-carousel-label">Prev</span><span class="visually-hidden">Previous</span></button>';
					echo '<button class="carousel-control-next dev-carousel-control" type="button" data-bs-target="#propGallery" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="dev-carousel-label">Next</span><span class="visually-hidden">Next</span></button>';
					echo '</div>';
				}
			}
			?>

			<div class="card mb-4">
				<div class="card-body">
					<h3 class="h5 mb-3">Property Description</h3>
					<div class="content"><?php the_content(); ?></div>
				</div>
			</div>

			<div class="card mb-4">
				<div class="card-body">
					<h3 class="h5 mb-3">Interior Details</h3>
					<div class="row g-3">
						<?php
						$interior = [
							'bedrooms' => 'Bedrooms',
							'bathrooms' => 'Bathrooms',
							'half_bathrooms' => 'Half Bathrooms',
							'living_rooms' => 'Living Rooms',
							'dining_rooms' => 'Dining Rooms',
							'kitchens' => 'Kitchens',
							'office_rooms' => 'Office/Study Rooms',
							'laundry_rooms' => 'Laundry/Utility Rooms',
							'storage_rooms' => 'Storage Rooms',
							'balconies' => 'Balconies',
						];
						foreach ( $interior as $key => $label ) {
							$val = dev_prop_get( $key );
							if ( $val !== '' ) {
								echo '<div class="col-6 col-md-4"><div class="small text-muted">' . esc_html( $label ) . '</div><div class="fw-semibold">' . esc_html( $val ) . '</div></div>';
							}
						}
						$checks = [
							'basement' => 'Basement',
							'attic' => 'Attic',
							'walk_in_closet' => 'Walk-in Closet',
							'pantry' => 'Pantry',
							'terrace' => 'Terrace/Rooftop',
							'loft' => 'Loft/Mezzanine',
							'guest_room' => 'Guest Room',
							'maids_room' => "Maid's Room",
						];
						foreach ( $checks as $key => $label ) {
							if ( dev_prop_get( $key ) ) {
								echo '<div class="col-6 col-md-4"><span class="badge bg-success-subtle text-success border">' . esc_html( $label ) . '</span></div>';
							}
						}
						?>
					</div>
				</div>
			</div>

			<div class="card mb-4">
				<div class="card-body">
					<h3 class="h5 mb-3">Exterior & Community</h3>
					<div class="row g-3">
						<?php
						$ext_numbers = [
							'parking_spaces' => 'Parking Spaces',
							'garage_capacity' => 'Garage Capacity',
						];
						foreach ( $ext_numbers as $key => $label ) {
							$val = dev_prop_get( $key );
							if ( $val !== '' ) {
								echo '<div class="col-6 col-md-4"><div class="small text-muted">' . esc_html( $label ) . '</div><div class="fw-semibold">' . esc_html( $val ) . '</div></div>';
							}
						}
						$ext_checks = [
							'garden' => 'Garden/Yard',
							'landscaping' => 'Landscaping',
							'jacuzzi' => 'Jacuzzi/Hot Tub',
							'patio' => 'Patio/Deck',
							'carport' => 'Carport',
							'driveway' => 'Driveway',
							'shed' => 'Shed/Outbuilding',
							'greenhouse' => 'Greenhouse',
							'barbecue_area' => 'Barbecue Area',
							'outdoor_kitchen' => 'Outdoor Kitchen',
							'boat_dock' => 'Boat Dock/Marina Access',
						];
						foreach ( $ext_checks as $key => $label ) {
							if ( dev_prop_get( $key ) ) {
								echo '<div class="col-6 col-md-4"><span class="badge bg-primary-subtle text-primary border">' . esc_html( $label ) . '</span></div>';
							}
						}
						$ext_selects = [
							'swimming_pool' => 'Swimming Pool',
							'garage' => 'Garage',
							'fence_type' => 'Fence Type',
						];
						foreach ( $ext_selects as $key => $label ) {
							$val = dev_prop_get( $key );
							if ( $val ) echo '<div class="col-6 col-md-4"><div class="small text-muted">' . esc_html( $label ) . '</div><div class="fw-semibold">' . esc_html( $val ) . '</div></div>';
						}
						?>
					</div>
				</div>
			</div>

			<?php if ( dev_prop_get('latitude') && dev_prop_get('longitude') ) : ?>
			<div class="card mb-4">
				<div class="card-body">
					<h3 class="h5 mb-3">Location</h3>
					<div class="ratio ratio-16x9">
						<iframe
							src="https://www.google.com/maps?q=<?php echo rawurlencode( dev_prop_get('latitude') . ',' . dev_prop_get('longitude') ); ?>&output=embed"
							loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"
							allowfullscreen
						></iframe>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php
			// Render all other fields not covered above, grouped by remaining sections
			$plugin = function_exists('dev_init_plugin') ? new Dev_Property_Listings() : null;
			if ( $plugin ) {
				$plugin->dev_run(); // ensure groups are initialized
				$field_groups = $plugin->get_field_groups();
				$skip_groups = [ 'rooms_interior', 'exterior_features', 'media' ];
				foreach ( $field_groups as $group_key => $group ) {
					if ( in_array( $group_key, $skip_groups, true ) ) continue;
					echo '<div class="card mb-4">';
					echo '<div class="card-body">';
					echo '<h3 class="h5 mb-3">' . esc_html( strip_tags( $group['title'] ) ) . '</h3>';
					echo '<div class="row g-3">';
					foreach ( $group['fields'] as $key => $field ) {
						$value = dev_prop_get( $key );
						// Skip empties, zero-like, agent_photo, and media/gallery types (IDs)
						if ( $value === '' || $value === null || $value == 0 ) continue;
						if ( $key === 'agent_photo' ) continue;
						if ( isset( $field['type'] ) && in_array( $field['type'], [ 'media', 'gallery' ], true ) ) continue;
						$label = isset( $field['label'] ) ? $field['label'] : $key;
						if ( $field['type'] === 'checkbox' ) {
							echo '<div class="col-6 col-md-4"><span class="badge bg-light text-dark border">' . esc_html( $label ) . '</span></div>';
						} else {
							echo '<div class="col-6 col-md-4"><div class="small text-muted">' . esc_html( $label ) . '</div><div class="fw-semibold">' . esc_html( $value ) . '</div></div>';
						}
					}
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
			}
			?>
		</div>

		<div class="col-lg-4">
			<div class="card mb-4">
				<div class="card-body">
					<h3 class="h5 mb-3">Key Facts</h3>
					<div class="row g-3">
						<?php
						$price = dev_prop_get('price');
						if ( $price !== '' ) {
							$currency = dev_prop_get('currency');
							$freq = dev_prop_get('price_frequency');
							echo '<div class="col-12"><div class="small text-muted">Price</div><div class="fs-4 fw-bold">' . esc_html( ($currency ? $currency . ' ' : '') . number_format_i18n( floatval( $price ) ) ) . ( $freq ? ' / ' . esc_html( $freq ) : '' ) . '</div></div>';
						}
						// Additional basic details
						$price_type = dev_prop_get('price_type');
						if ( $price_type !== '' ) echo '<div class="col-6"><div class="small text-muted">Price Type</div><div class="fw-semibold">' . esc_html( $price_type ) . '</div></div>';
						$currency_only = dev_prop_get('currency');
						if ( $currency_only !== '' ) echo '<div class="col-6"><div class="small text-muted">Currency</div><div class="fw-semibold">' . esc_html( $currency_only ) . '</div></div>';
						$price_frequency = dev_prop_get('price_frequency');
						if ( $price_frequency !== '' ) echo '<div class="col-6"><div class="small text-muted">Price Frequency</div><div class="fw-semibold">' . esc_html( $price_frequency ) . '</div></div>';
						$availability_date = dev_prop_get('availability_date');
						if ( $availability_date !== '' ) echo '<div class="col-6"><div class="small text-muted">Available From</div><div class="fw-semibold">' . esc_html( $availability_date ) . '</div></div>';
						$open_house_date = dev_prop_get('open_house_date');
						if ( $open_house_date !== '' ) echo '<div class="col-6"><div class="small text-muted">Open House</div><div class="fw-semibold">' . esc_html( $open_house_date ) . '</div></div>';
						$size = dev_prop_get('property_size');
						if ( $size !== '' ) echo '<div class="col-6"><div class="small text-muted">Size</div><div class="fw-semibold">' . esc_html( $size ) . ' m²</div></div>';
						$land = dev_prop_get('land_size');
						if ( $land !== '' ) echo '<div class="col-6"><div class="small text-muted">Land</div><div class="fw-semibold">' . esc_html( $land ) . ' m²</div></div>';
						$year_built = dev_prop_get('year_built');
						if ( $year_built !== '' ) echo '<div class="col-6"><div class="small text-muted">Year Built</div><div class="fw-semibold">' . esc_html( $year_built ) . '</div></div>';
						$floors = dev_prop_get('floors');
						if ( $floors !== '' ) echo '<div class="col-6"><div class="small text-muted">Floors</div><div class="fw-semibold">' . esc_html( $floors ) . '</div></div>';
						$floor_level = dev_prop_get('floor_level');
						if ( $floor_level !== '' ) echo '<div class="col-6"><div class="small text-muted">Floor Level</div><div class="fw-semibold">' . esc_html( $floor_level ) . '</div></div>';
						$ceiling_height = dev_prop_get('ceiling_height');
						if ( $ceiling_height !== '' ) echo '<div class="col-6"><div class="small text-muted">Ceiling Height</div><div class="fw-semibold">' . esc_html( $ceiling_height ) . ' m</div></div>';
						$type = dev_prop_get('property_type');
						if ( $type ) echo '<div class="col-6"><div class="small text-muted">Type</div><div class="fw-semibold">' . esc_html( $type ) . '</div></div>';
						$status = dev_prop_get('listing_status');
						if ( $status ) echo '<div class="col-6"><div class="small text-muted">Status</div><div class="fw-semibold">' . esc_html( $status ) . '</div></div>';
						?>
					</div>
				</div>
			</div>

			<div class="card mb-4">
				<div class="card-body">
					<h3 class="h5 mb-3">Agent</h3>
					<div class="d-flex align-items-center gap-3">
						<?php
						$agent_photo_id = dev_prop_get('agent_photo');
						if ( $agent_photo_id ) {
							echo wp_get_attachment_image( $agent_photo_id, 'thumbnail', false, [ 'class' => 'rounded-circle', 'style' => 'width:64px;height:64px;object-fit:cover;' ] );
						}
						?>
						<div>
							<div class="fw-semibold"><?php echo esc_html( dev_prop_get('agent_name') ); ?></div>
							<div class="small text-muted"><?php echo esc_html( dev_prop_get('agency_name') ); ?></div>
							<?php if ( dev_prop_get('agent_phone') ) : ?>
								<div><a href="tel:<?php echo esc_attr( dev_prop_get('agent_phone') ); ?>" class="text-decoration-none">📞 <?php echo esc_html( dev_prop_get('agent_phone') ); ?></a></div>
							<?php endif; ?>
							<?php if ( dev_prop_get('agent_email') ) : ?>
								<div><a href="mailto:<?php echo esc_attr( dev_prop_get('agent_email') ); ?>" class="text-decoration-none">✉️ <?php echo esc_html( dev_prop_get('agent_email') ); ?></a></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<?php if ( dev_prop_get('video_url') ) : ?>
			<div class="card mb-4">
				<div class="card-body">
					<h3 class="h5 mb-3">Video</h3>
					<div class="ratio ratio-16x9">
						<iframe src="<?php echo esc_url( dev_prop_get('video_url') ); ?>" title="Property video" allowfullscreen loading="lazy"></iframe>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
get_footer();
?>
