<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Dev_Property_Listings {

    private $field_groups = [];

    public function __construct() {
        // Define all custom fields organized by categories
        $this->field_groups = [
            'basic_details' => [
                'title' => '🏡 Basic Property Details',
                'fields' => [
                    'property_id' => [ 'label' => 'Property ID / MLS ID', 'type' => 'text' ],
                    'property_type' => [ 'label' => 'Property Type', 'type' => 'select',
                        'options' => ['House', 'Apartment', 'Villa', 'Studio', 'Townhouse', 'Land', 'Commercial', 'Office', 'Retail', 'Industrial', 'Warehouse', 'Hotel', 'Restaurant'] ],
                    'listing_status' => [ 'label' => 'Listing Status', 'type' => 'select',
                        'options' => ['For Sale', 'For Rent', 'Sold', 'Leased', 'Under Offer', 'Coming Soon', 'Off Market'] ],
                    'price' => [ 'label' => 'Price', 'type' => 'number' ],
                    'price_type' => [ 'label' => 'Price Type', 'type' => 'select',
                        'options' => ['Fixed', 'Negotiable', 'Starting From', 'Auction', 'Per Night', 'Per Week', 'Per Month', 'Per Year'] ],
                    'currency' => [ 'label' => 'Currency', 'type' => 'select',
                        'options' => ['USD', 'EUR', 'GBP', 'CAD', 'AUD', 'JPY', 'CHF', 'SEK', 'NOK', 'DKK'] ],
                    'price_frequency' => [ 'label' => 'Price Frequency', 'type' => 'select',
                        'options' => ['Per Month', 'Per Year', 'Weekly', 'Nightly', 'One-time'] ],
                    'availability_date' => [ 'label' => 'Availability Date', 'type' => 'date' ],
                    'open_house_date' => [ 'label' => 'Open House Date', 'type' => 'datetime-local' ],
                ]
            ],
            'size_dimensions' => [
                'title' => '📐 Size & Dimensions',
                'fields' => [
                    'property_size' => [ 'label' => 'Property Size (m²)', 'type' => 'number' ],
                    'property_size_ft' => [ 'label' => 'Property Size (ft²)', 'type' => 'number' ],
                    'land_size' => [ 'label' => 'Land Size (m²)', 'type' => 'number' ],
                    'land_size_ft' => [ 'label' => 'Land Size (ft²)', 'type' => 'number' ],
                    'building_size' => [ 'label' => 'Building Size (m²)', 'type' => 'number' ],
                    'year_built' => [ 'label' => 'Year Built', 'type' => 'number' ],
                    'year_renovated' => [ 'label' => 'Year Renovated', 'type' => 'number' ],
                    'floors' => [ 'label' => 'Number of Floors', 'type' => 'number' ],
                    'floor_level' => [ 'label' => 'Floor Level', 'type' => 'number' ],
                    'ceiling_height' => [ 'label' => 'Ceiling Height (m)', 'type' => 'number' ],
                    'frontage' => [ 'label' => 'Frontage (m)', 'type' => 'number' ],
                    'depth' => [ 'label' => 'Depth (m)', 'type' => 'number' ],
                ]
            ],
            'rooms_interior' => [
                'title' => '🛋️ Rooms & Interior Details',
                'fields' => [
                    'bedrooms' => [ 'label' => 'Bedrooms', 'type' => 'number' ],
                    'bathrooms' => [ 'label' => 'Bathrooms', 'type' => 'number' ],
                    'half_bathrooms' => [ 'label' => 'Half Bathrooms', 'type' => 'number' ],
                    'living_rooms' => [ 'label' => 'Living Rooms', 'type' => 'number' ],
                    'dining_rooms' => [ 'label' => 'Dining Rooms', 'type' => 'number' ],
                    'kitchens' => [ 'label' => 'Kitchens', 'type' => 'number' ],
                    'office_rooms' => [ 'label' => 'Office/Study Rooms', 'type' => 'number' ],
                    'laundry_rooms' => [ 'label' => 'Laundry/Utility Rooms', 'type' => 'number' ],
                    'storage_rooms' => [ 'label' => 'Storage Rooms', 'type' => 'number' ],
                    'basement' => [ 'label' => 'Basement', 'type' => 'checkbox' ],
                    'attic' => [ 'label' => 'Attic', 'type' => 'checkbox' ],
                    'walk_in_closet' => [ 'label' => 'Walk-in Closet', 'type' => 'checkbox' ],
                    'pantry' => [ 'label' => 'Pantry', 'type' => 'checkbox' ],
                    'balconies' => [ 'label' => 'Balconies', 'type' => 'number' ],
                    'terrace' => [ 'label' => 'Terrace/Rooftop', 'type' => 'checkbox' ],
                    'loft' => [ 'label' => 'Loft/Mezzanine', 'type' => 'checkbox' ],
                    'guest_room' => [ 'label' => 'Guest Room', 'type' => 'checkbox' ],
                    'maids_room' => [ 'label' => 'Maid\'s Room', 'type' => 'checkbox' ],
                ]
            ],
            'interior_features' => [
                'title' => '🔌 Interior Features',
                'fields' => [
                    'flooring_type' => [ 'label' => 'Flooring Type', 'type' => 'select',
                        'options' => ['Hardwood', 'Marble', 'Tile', 'Carpet', 'Laminate', 'Vinyl', 'Concrete', 'Bamboo', 'Cork'] ],
                    'heating_type' => [ 'label' => 'Heating Type', 'type' => 'select',
                        'options' => ['Central', 'Gas', 'Electric', 'Radiant', 'Heat Pump', 'Wood Stove', 'None'] ],
                    'cooling_type' => [ 'label' => 'Cooling Type', 'type' => 'select',
                        'options' => ['Central AC', 'Split AC', 'Ceiling Fans', 'Window AC', 'None'] ],
                    'fireplace' => [ 'label' => 'Fireplace', 'type' => 'checkbox' ],
                    'fireplace_count' => [ 'label' => 'Number of Fireplaces', 'type' => 'number' ],
                    'smart_home' => [ 'label' => 'Smart Home Features', 'type' => 'checkbox' ],
                    'built_in_furniture' => [ 'label' => 'Built-in Furniture', 'type' => 'checkbox' ],
                    'appliances' => [ 'label' => 'Appliances Included', 'type' => 'textarea' ],
                    'kitchen_type' => [ 'label' => 'Kitchen Type', 'type' => 'select',
                        'options' => ['Open', 'Closed', 'Modular', 'Gourmet', 'Galley', 'Island'] ],
                    'countertops' => [ 'label' => 'Countertops', 'type' => 'select',
                        'options' => ['Granite', 'Quartz', 'Marble', 'Laminate', 'Wood', 'Concrete', 'Stainless Steel'] ],
                    'lighting' => [ 'label' => 'Lighting Type', 'type' => 'select',
                        'options' => ['LED', 'Chandeliers', 'Recessed', 'Track', 'Pendant', 'Natural'] ],
                ]
            ],
            'exterior_features' => [
                'title' => '🌳 Exterior Features',
                'fields' => [
                    'garden' => [ 'label' => 'Garden/Yard', 'type' => 'checkbox' ],
                    'landscaping' => [ 'label' => 'Landscaping', 'type' => 'checkbox' ],
                    'swimming_pool' => [ 'label' => 'Swimming Pool', 'type' => 'select',
                        'options' => ['None', 'Indoor', 'Outdoor', 'Heated', 'Salt Water', 'Infinity'] ],
                    'jacuzzi' => [ 'label' => 'Jacuzzi/Hot Tub', 'type' => 'checkbox' ],
                    'patio' => [ 'label' => 'Patio/Deck', 'type' => 'checkbox' ],
                    'garage' => [ 'label' => 'Garage', 'type' => 'select',
                        'options' => ['None', 'Attached', 'Detached', 'Underground'] ],
                    'garage_capacity' => [ 'label' => 'Garage Capacity', 'type' => 'number' ],
                    'carport' => [ 'label' => 'Carport', 'type' => 'checkbox' ],
                    'driveway' => [ 'label' => 'Driveway', 'type' => 'checkbox' ],
                    'parking_spaces' => [ 'label' => 'Parking Spaces', 'type' => 'number' ],
                    'fence_type' => [ 'label' => 'Fence Type', 'type' => 'select',
                        'options' => ['None', 'Wood', 'Metal', 'Chain Link', 'Brick', 'Stone', 'Hedge'] ],
                    'shed' => [ 'label' => 'Shed/Outbuilding', 'type' => 'checkbox' ],
                    'greenhouse' => [ 'label' => 'Greenhouse', 'type' => 'checkbox' ],
                    'barbecue_area' => [ 'label' => 'Barbecue Area', 'type' => 'checkbox' ],
                    'outdoor_kitchen' => [ 'label' => 'Outdoor Kitchen', 'type' => 'checkbox' ],
                    'boat_dock' => [ 'label' => 'Boat Dock/Marina Access', 'type' => 'checkbox' ],
                ]
            ],
            'location_details' => [
                'title' => '📍 Location Details',
                'fields' => [
                    'address' => [ 'label' => 'Full Address', 'type' => 'text' ],
                    'street' => [ 'label' => 'Street', 'type' => 'text' ],
                    'city' => [ 'label' => 'City', 'type' => 'text' ],
                    'state' => [ 'label' => 'State/Province', 'type' => 'text' ],
                    'zip' => [ 'label' => 'ZIP/Postal Code', 'type' => 'text' ],
                    'country' => [ 'label' => 'Country', 'type' => 'text' ],
                    'neighborhood' => [ 'label' => 'Neighborhood/Area', 'type' => 'text' ],
                    'zone' => [ 'label' => 'Zone/District', 'type' => 'text' ],
                    'landmark' => [ 'label' => 'Landmark', 'type' => 'text' ],
                    'latitude' => [ 'label' => 'Latitude', 'type' => 'text' ],
                    'longitude' => [ 'label' => 'Longitude', 'type' => 'text' ],
                    'school_district' => [ 'label' => 'School District', 'type' => 'text' ],
                    'public_transport' => [ 'label' => 'Public Transport Distance (m)', 'type' => 'number' ],
                    'shopping_centers' => [ 'label' => 'Shopping Centers Distance (m)', 'type' => 'number' ],
                    'parks' => [ 'label' => 'Parks Distance (m)', 'type' => 'number' ],
                    'airports' => [ 'label' => 'Airports Distance (km)', 'type' => 'number' ],
                    'hospitals' => [ 'label' => 'Hospitals Distance (m)', 'type' => 'number' ],
                ]
            ],
            'media' => [
                'title' => '📸 Media',
                'fields' => [
                    'featured_image' => [ 'label' => 'Featured Image', 'type' => 'media' ],
                    'photo_gallery' => [ 'label' => 'Photo Gallery', 'type' => 'gallery' ],
                    'floor_plans' => [ 'label' => 'Floor Plans', 'type' => 'gallery' ],
                    'video_url' => [ 'label' => 'Video URL (YouTube/Vimeo)', 'type' => 'url' ],
                    'virtual_tour' => [ 'label' => '360° Virtual Tour URL', 'type' => 'url' ],
                    'brochure_pdf' => [ 'label' => 'Brochure/PDF Download', 'type' => 'media' ],
                    'drone_footage' => [ 'label' => 'Drone Footage URL', 'type' => 'url' ],
                ]
            ],
            'agent_contact' => [
                'title' => '🧑‍💼 Agent / Contact Info',
                'fields' => [
                    'agent_name' => [ 'label' => 'Agent Name', 'type' => 'text' ],
                    'agent_photo' => [ 'label' => 'Agent Photo', 'type' => 'media' ],
                    'agent_phone' => [ 'label' => 'Agent Phone', 'type' => 'tel' ],
                    'agent_email' => [ 'label' => 'Agent Email', 'type' => 'email' ],
                    'agent_whatsapp' => [ 'label' => 'Agent WhatsApp', 'type' => 'tel' ],
                    'agency_name' => [ 'label' => 'Agency Name', 'type' => 'text' ],
                    'agency_logo' => [ 'label' => 'Agency Logo', 'type' => 'media' ],
                    'agent_website' => [ 'label' => 'Agent Website', 'type' => 'url' ],
                    'agent_facebook' => [ 'label' => 'Agent Facebook', 'type' => 'url' ],
                    'agent_instagram' => [ 'label' => 'Agent Instagram', 'type' => 'url' ],
                    'agent_linkedin' => [ 'label' => 'Agent LinkedIn', 'type' => 'url' ],
                    'contact_form' => [ 'label' => 'Contact Form Integration', 'type' => 'checkbox' ],
                ]
            ],
            'utilities_services' => [
                'title' => '🛠️ Utilities & Services',
                'fields' => [
                    'electricity_type' => [ 'label' => 'Electricity Type', 'type' => 'select',
                        'options' => ['Grid', 'Solar', 'Generator', 'Wind', 'Hybrid'] ],
                    'water_supply' => [ 'label' => 'Water Supply', 'type' => 'select',
                        'options' => ['Municipal', 'Well', 'Tank', 'Bottled'] ],
                    'gas_type' => [ 'label' => 'Gas Type', 'type' => 'select',
                        'options' => ['Natural Gas', 'Propane', 'Electric', 'None'] ],
                    'internet_type' => [ 'label' => 'Internet/Fiber', 'type' => 'select',
                        'options' => ['Fiber', 'Cable', 'DSL', 'Satellite', 'Wireless', 'None'] ],
                    'cable_tv' => [ 'label' => 'Cable TV', 'type' => 'checkbox' ],
                    'trash_collection' => [ 'label' => 'Trash Collection', 'type' => 'checkbox' ],
                    'solar_panels' => [ 'label' => 'Solar Panels', 'type' => 'checkbox' ],
                    'generator_backup' => [ 'label' => 'Generator Backup', 'type' => 'checkbox' ],
                    'energy_rating' => [ 'label' => 'Energy Efficiency Rating', 'type' => 'select',
                        'options' => ['A+', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'Not Rated'] ],
                ]
            ]
        ];
    }

    /**
     * Expose field groups for frontend templates
     */
    public function get_field_groups() {
        return $this->field_groups;
    }

    public function dev_run() {
        add_action( 'init', [ $this, 'dev_register_post_type' ] );
        add_action( 'add_meta_boxes', [ $this, 'dev_register_meta_boxes' ] );
        add_action( 'save_post', [ $this, 'dev_save_property_meta' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'dev_admin_assets' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'dev_frontend_assets' ] );
        add_filter( 'single_template', [ $this, 'dev_single_template' ] );
        add_filter( 'archive_template', [ $this, 'dev_archive_template' ] );
        add_action( 'init', [ $this, 'dev_register_shortcodes' ] );
        add_filter( 'template_include', [ $this, 'dev_search_template' ] );
        add_action( 'pre_get_posts', [ $this, 'dev_adjust_search_query' ] );
        
        // AJAX handlers
        add_action( 'wp_ajax_dev_property_auto_save', [ $this, 'dev_ajax_auto_save' ] );
        add_action( 'wp_ajax_dev_get_attachment_data', [ $this, 'dev_ajax_get_attachment_data' ] );
    }

    /**
     * Register "Property" CPT
     */
    public function dev_register_post_type() {
        $labels = [
            'name'          => __( 'Sale Properties', 'dev-property-listings' ),
            'singular_name' => __( 'Sale Property', 'dev-property-listings' ),
            'add_new_item'  => __( 'Add New Property', 'dev-property-listings' ),
            'edit_item'     => __( 'Edit Property', 'dev-property-listings' ),
            'view_item'     => __( 'View Property', 'dev-property-listings' ),
        ];

        $args = [
            'labels'        => $labels,
            'public'        => true,
            'menu_icon'     => 'dashicons-admin-home',
            'has_archive'   => true,
            'rewrite'       => [ 'slug' => 'property' ],
            'supports'      => [ 'title', 'editor', 'thumbnail' ],
            'show_in_rest'  => true,
        ];

        register_post_type( 'dev_property', $args );

        // Taxonomies
        register_taxonomy( 'dev_property_type', 'dev_property', [
            'label'        => __( 'Property Type', 'dev-property-listings' ),
            'public'       => true,
            'hierarchical' => true,
            'show_in_rest' => true,
        ] );
        register_taxonomy( 'dev_property_feature', 'dev_property', [
            'label'        => __( 'Features', 'dev-property-listings' ),
            'public'       => true,
            'hierarchical' => false,
            'show_in_rest' => true,
        ] );
    }

    /**
     * Enqueue admin styles and scripts
     */
    public function dev_admin_assets() {
        $screen = get_current_screen();
        
        if ( $screen && $screen->post_type === 'dev_property' ) {
            // Ensure media scripts are available
            wp_enqueue_media();

            wp_enqueue_style( 'dev-property-admin', DEV_PROP_PLUGIN_URL . 'includes/assets/admin.css', [], '1.0' );
            wp_enqueue_script( 'dev-property-admin', DEV_PROP_PLUGIN_URL . 'includes/assets/admin.js', [ 'jquery' ], '1.0', true );
            
            // Localize script for AJAX
            wp_localize_script( 'dev-property-admin', 'devPropertyAdmin', [
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'dev_property_admin_nonce' ),
                'strings' => [
                    'selectMedia' => __( 'Select Media', 'dev-property-listings' ),
                    'selectGallery' => __( 'Select Gallery', 'dev-property-listings' ),
                    'remove' => __( 'Remove', 'dev-property-listings' ),
                ]
            ]);
        }
    }

    /**
     * Add meta box
     */
    public function dev_register_meta_boxes() {
        add_meta_box(
            'dev_property_details',
            __( 'Property Details', 'dev-property-listings' ),
            [ $this, 'dev_render_meta_box' ],
            'dev_property',
            'normal',
            'high'
        );
    }

    /**
     * Enqueue frontend assets only on single property pages
     */
    public function dev_frontend_assets() {
        if ( is_singular( 'dev_property' ) || is_post_type_archive( 'dev_property' ) || is_search() ) {
            wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3' );
            wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], '5.3.3', true );
            wp_enqueue_style( 'dev-property-frontend', DEV_PROP_PLUGIN_URL . 'includes/assets/frontend.css', [], '1.0' );
        }
    }

    /**
     * Provide a single template for dev_property from the plugin
     */
    public function dev_single_template( $template ) {
        if ( is_singular( 'dev_property' ) ) {
            $plugin_template = trailingslashit( plugin_dir_path( __FILE__ ) ) . '../templates/single-dev_property.php';
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }
        return $template;
    }

    /**
     * Provide an archive template from the plugin
     */
    public function dev_archive_template( $template ) {
        if ( is_post_type_archive( 'dev_property' ) ) {
            $plugin_template = trailingslashit( plugin_dir_path( __FILE__ ) ) . '../templates/archive-dev_property.php';
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }
        return $template;
    }

    /**
     * Use our Bootstrap grid for search results too
     */
    public function dev_search_template( $template ) {
        if ( is_search() ) {
            $plugin_template = trailingslashit( plugin_dir_path( __FILE__ ) ) . '../templates/search.php';
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }
        return $template;
    }

    /**
     * Make search smarter for dev_property: map common keywords to meta filters
     */
    public function dev_adjust_search_query( $query ) {
        if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) return;

        // Only search properties
        $query->set( 'post_type', [ 'dev_property' ] );

        $search_term = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
        $meta_query = (array) $query->get( 'meta_query' );
        if ( empty( $meta_query ) ) { $meta_query = [ 'relation' => 'AND' ]; }

        // If "type" GET is present, prioritize exact type match
        $type_param = isset( $_GET['type'] ) ? sanitize_text_field( wp_unslash( $_GET['type'] ) ) : '';
        if ( $type_param !== '' ) {
            $meta_query[] = [ 'key' => '_dev_property_type', 'value' => $type_param, 'compare' => '=' ];
        } else if ( $search_term !== '' ) {
            // Map keyword to property_type when it matches known options
            $known_types = [ 'House','Apartment','Villa','Studio','Townhouse','Land','Commercial','Office','Retail','Industrial','Warehouse','Hotel','Restaurant' ];
            foreach ( $known_types as $known ) {
                if ( strcasecmp( $search_term, $known ) === 0 ) {
                    $meta_query[] = [ 'key' => '_dev_property_type', 'value' => $known, 'compare' => '=' ];
                    break;
                }
            }
        }

        // Apply meta_query if we added conditions
        if ( count( $meta_query ) > 1 || ( isset($meta_query['relation']) && count($meta_query) > 1 ) ) {
            $query->set( 'meta_query', $meta_query );
        }
    }

    /**
     * Shortcodes
     */
    public function dev_register_shortcodes() {
        add_shortcode( 'dev_property_listings', [ $this, 'shortcode_property_listings' ] );
    }

    public function shortcode_property_listings( $atts ) {
        $atts = shortcode_atts([
            'per_page' => 9,
            'orderby' => 'date',
            'order' => 'DESC',
            'city' => '',
            'type' => '',
            'status' => '',
            'min_price' => '',
            'max_price' => '',
            'keywords' => '',
        ], $atts, 'dev_property_listings' );

        $meta_query = [ 'relation' => 'AND' ];
        if ( $atts['city'] !== '' ) {
            $meta_query[] = [ 'key' => '_dev_city', 'value' => $atts['city'], 'compare' => 'LIKE' ];
        }
        if ( $atts['type'] !== '' ) {
            $meta_query[] = [ 'key' => '_dev_property_type', 'value' => $atts['type'], 'compare' => '=' ];
        }
        if ( $atts['status'] !== '' ) {
            $meta_query[] = [ 'key' => '_dev_listing_status', 'value' => $atts['status'], 'compare' => '=' ];
        }
        if ( $atts['min_price'] !== '' ) {
            $meta_query[] = [ 'key' => '_dev_price', 'value' => floatval( $atts['min_price'] ), 'type' => 'NUMERIC', 'compare' => '>=' ];
        }
        if ( $atts['max_price'] !== '' ) {
            $meta_query[] = [ 'key' => '_dev_price', 'value' => floatval( $atts['max_price'] ), 'type' => 'NUMERIC', 'compare' => '<=' ];
        }

        $args = [
            'post_type' => 'dev_property',
            'post_status' => 'publish',
            'posts_per_page' => intval( $atts['per_page'] ),
            'orderby' => $atts['orderby'],
            'order' => $atts['order'],
            's' => $atts['keywords'],
        ];
        if ( count( $meta_query ) > 1 ) {
            $args['meta_query'] = $meta_query;
        }

        ob_start();
        $q = new \WP_Query( $args );
        if ( $q->have_posts() ) {
            echo '<div class="container my-4"><div class="row g-4">';
            while ( $q->have_posts() ) { $q->the_post();
                $price = get_post_meta( get_the_ID(), '_dev_price', true );
                $city = get_post_meta( get_the_ID(), '_dev_city', true );
                echo '<div class="col-12 col-sm-6 col-lg-4">';
                echo '<div class="card h-100">';
                if ( has_post_thumbnail() ) {
                    echo '<a href="' . esc_url( get_permalink() ) . '" class="ratio ratio-16x9">' . get_the_post_thumbnail( get_the_ID(), 'medium_large', [ 'class' => 'card-img-top object-fit-cover' ] ) . '</a>';
                }
                echo '<div class="card-body">';
                echo '<h5 class="card-title"><a class="text-decoration-none" href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h5>';
                if ( $city ) echo '<div class="text-muted small mb-2">' . esc_html( $city ) . '</div>';
                if ( $price !== '' ) echo '<div class="fw-bold">' . esc_html( number_format_i18n( floatval( $price ) ) ) . '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div></div>';
            wp_reset_postdata();
        } else {
            echo '<div class="container my-4"><div class="alert alert-info">No properties found.</div></div>';
        }
        return ob_get_clean();
    }

    /**
     * Render meta box HTML with organized sections
     */
    public function dev_render_meta_box( $post ) {
        wp_nonce_field( 'dev_property_save_meta', 'dev_property_nonce' );
        
        echo '<div class="dev-property-meta-container">';
        
        foreach ( $this->field_groups as $group_key => $group ) {
            echo '<div class="dev-property-section" data-section="' . esc_attr( $group_key ) . '">';
            echo '<h3 class="dev-section-title">' . esc_html( $group['title'] ) . '</h3>';
            echo '<div class="dev-section-content">';
        echo '<table class="form-table dev-property-table">';
            
            foreach ( $group['fields'] as $key => $field ) {
            $value = get_post_meta( $post->ID, "_dev_$key", true );
                echo '<tr><th><label for="dev_' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';
                
                $this->render_field( $key, $field, $value );
                
                echo '</td></tr>';
            }
            
            echo '</table>';
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
    }

    /**
     * Render individual field based on type
     */
    private function render_field( $key, $field, $value ) {
        $type = $field['type'];
        $field_name = "dev_$key";
        $field_id = "dev_$key";
        
        switch ( $type ) {
            case 'select':
                if ( !empty( $field['options'] ) ) {
                    echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="regular-text">';
                    echo '<option value="">-- Select --</option>';
                foreach ( $field['options'] as $option ) {
                    printf(
                        '<option value="%s" %s>%s</option>',
                        esc_attr( $option ),
                        selected( $value, $option, false ),
                        esc_html( $option )
                    );
                }
                echo '</select>';
                }
                break;
                
            case 'textarea':
                printf(
                    '<textarea name="%s" id="%s" rows="4" cols="50" class="large-text">%s</textarea>',
                    esc_attr( $field_name ),
                    esc_attr( $field_id ),
                    esc_textarea( $value )
                );
                break;
                
            case 'checkbox':
                printf(
                    '<input type="checkbox" name="%s" id="%s" value="1" %s />',
                    esc_attr( $field_name ),
                    esc_attr( $field_id ),
                    checked( $value, '1', false )
                );
                break;
                
            case 'media':
                echo '<div class="dev-media-field">';
                printf(
                    '<input type="hidden" name="%s" id="%s" value="%s" />',
                    esc_attr( $field_name ),
                    esc_attr( $field_id ),
                    esc_attr( $value )
                );
                echo '<button type="button" class="button dev-media-upload" data-target="' . esc_attr( $field_id ) . '">Select Media</button>';
                echo '<button type="button" class="button dev-media-remove" data-target="' . esc_attr( $field_id ) . '" style="display:none;">Remove</button>';
                echo '<div class="dev-media-preview" id="' . esc_attr( $field_id ) . '_preview"></div>';
                echo '</div>';
                break;
                
            case 'gallery':
                echo '<div class="dev-gallery-field">';
                printf(
                    '<input type="hidden" name="%s" id="%s" value="%s" />',
                    esc_attr( $field_name ),
                    esc_attr( $field_id ),
                    esc_attr( $value )
                );
                echo '<button type="button" class="button dev-gallery-upload" data-target="' . esc_attr( $field_id ) . '">Select Gallery</button>';
                echo '<div class="dev-gallery-preview" id="' . esc_attr( $field_id ) . '_preview"></div>';
                echo '</div>';
                break;
                
            case 'url':
            case 'email':
            case 'tel':
            case 'date':
            case 'time':
            case 'datetime-local':
                printf(
                    '<input type="%s" name="%s" id="%s" value="%s" class="regular-text" />',
                    esc_attr( $type ),
                    esc_attr( $field_name ),
                    esc_attr( $field_id ),
                    esc_attr( $value )
                );
                break;
                
            case 'number':
                printf(
                    '<input type="number" name="%s" id="%s" value="%s" class="small-text" step="any" />',
                    esc_attr( $field_name ),
                    esc_attr( $field_id ),
                    esc_attr( $value )
                );
                break;
                
            default: // text
                printf(
                    '<input type="text" name="%s" id="%s" value="%s" class="regular-text" />',
                    esc_attr( $field_name ),
                    esc_attr( $field_id ),
                    esc_attr( $value )
                );
                break;
        }
    }

    /**
     * Save all meta fields securely with proper validation
     */
    public function dev_save_property_meta( $post_id ) {

        if ( ! isset( $_POST['dev_property_nonce'] ) ||
             ! wp_verify_nonce( $_POST['dev_property_nonce'], 'dev_property_save_meta' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;

        foreach ( $this->field_groups as $group ) {
            foreach ( $group['fields'] as $key => $field ) {
                $field_name = "dev_$key";
                
                if ( isset( $_POST[ $field_name ] ) ) {
                    $value = $this->sanitize_field_value( $_POST[ $field_name ], $field['type'] );
                update_post_meta( $post_id, "_dev_$key", $value );
                } else {
                    // For checkboxes, if not set, save as empty
                    if ( $field['type'] === 'checkbox' ) {
                        update_post_meta( $post_id, "_dev_$key", '' );
            } else {
                delete_post_meta( $post_id, "_dev_$key" );
            }
        }
            }
        }

        // Sync custom Featured Image field to the actual post featured image
        $custom_featured = get_post_meta( $post_id, '_dev_featured_image', true );
        if ( $custom_featured !== '' ) {
            $attachment_id = absint( $custom_featured );
            if ( $attachment_id > 0 ) {
                update_post_meta( $post_id, '_thumbnail_id', $attachment_id );
            }
        }
    }

    /**
     * Sanitize field values based on field type
     */
    private function sanitize_field_value( $value, $type ) {
        switch ( $type ) {
            case 'email':
                return sanitize_email( $value );
                
            case 'url':
                return esc_url_raw( $value );
                
            case 'number':
                if ($value === '' || $value === null) {
                    return '';
                }
                return is_numeric( $value ) ? floatval( $value ) : '';
                
            case 'textarea':
                return sanitize_textarea_field( $value );
                
            case 'checkbox':
                return $value ? '1' : '';
                
            case 'date':
            case 'time':
            case 'datetime-local':
                return sanitize_text_field( $value );
                
            case 'tel':
                return sanitize_text_field( $value );
                
            case 'media':
                if ($value === '' || $value === null) {
                    return '';
                }
                return absint( $value );

            case 'gallery':
                // Accept comma-separated IDs, sanitize each, and re-join
                if ( is_array( $value ) ) {
                    $ids = array_map( 'absint', $value );
                } else {
                    $ids = array_map( 'absint', array_filter( array_map( 'trim', explode( ',', (string) $value ) ) ) );
                }
                $ids = array_filter( $ids );
                return implode( ',', $ids );
                
            case 'select':
                return sanitize_text_field( $value );
                
            default: // text
                return sanitize_text_field( $value );
        }
    }

    /**
     * AJAX handler for auto-save functionality
     */
    public function dev_ajax_auto_save() {
        check_ajax_referer( 'dev_property_admin_nonce', 'nonce' );
        
        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Unauthorized' );
        }

        $post_id = intval( $_POST['post_id'] );
        $form_data = $_POST['form_data'];
        
        // Parse form data
        parse_str( $form_data, $parsed_data );
        
        // Save meta fields
        foreach ( $this->field_groups as $group ) {
            foreach ( $group['fields'] as $key => $field ) {
                $field_name = "dev_$key";
                
                if ( isset( $parsed_data[ $field_name ] ) ) {
                    $value = $this->sanitize_field_value( $parsed_data[ $field_name ], $field['type'] );
                    update_post_meta( $post_id, "_dev_$key", $value );
                }
            }
        }

        wp_send_json_success( [ 'message' => 'Auto-saved successfully' ] );
    }

    /**
     * AJAX handler to get attachment data
     */
    public function dev_ajax_get_attachment_data() {
        check_ajax_referer( 'dev_property_admin_nonce', 'nonce' );
        
        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Unauthorized' );
        }

        $attachment_id = intval( $_POST['attachment_id'] );
        $attachment = get_post( $attachment_id );
        
        if ( ! $attachment || $attachment->post_type !== 'attachment' ) {
            wp_send_json_error( [ 'message' => 'Invalid attachment' ] );
        }

        $thumbnail = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
        $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
        
        wp_send_json_success( [
            'thumbnail' => $thumbnail ? $thumbnail[0] : '',
            'alt' => $alt,
            'title' => $attachment->post_title
        ] );
    }
}
