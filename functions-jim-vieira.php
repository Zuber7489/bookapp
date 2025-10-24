<?php
/**
 * Jim Vieira Website - WordPress Functions
 * Add this code to your theme's functions.php file or create a custom plugin
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Jim Vieira assets for the custom page template
 */
function jim_vieira_enqueue_assets() {
    // Only load on the custom page template
    if (is_page_template('page-jim-vieira.php')) {
        // Google Fonts
        wp_enqueue_style(
            'jim-vieira-fonts',
            'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&display=swap',
            array(),
            null
        );
        
        // Custom styles
        wp_enqueue_style(
            'jim-vieira-styles',
            get_template_directory_uri() . '/jim-vieira/styles.css',
            array('jim-vieira-fonts'),
            '1.0.0'
        );
        
        // Lucide Icons
        wp_enqueue_script(
            'lucide-icons',
            'https://unpkg.com/lucide@latest',
            array(),
            null,
            true
        );
        
        // Custom JavaScript
        wp_enqueue_script(
            'jim-vieira-script',
            get_template_directory_uri() . '/jim-vieira/script.js',
            array('lucide-icons'),
            '1.0.0',
            true
        );
        
        // Localize script for AJAX
        wp_localize_script('jim-vieira-script', 'jimVieiraAjax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('jim_vieira_contact_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'jim_vieira_enqueue_assets');

/**
 * Handle contact form submission via AJAX
 */
function jim_vieira_handle_contact_form() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'jim_vieira_contact_nonce')) {
        wp_die('Security check failed');
    }
    
    // Sanitize form data
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $organization = sanitize_text_field($_POST['organization']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('Please fill in all required fields.');
    }
    
    // Validate email
    if (!is_email($email)) {
        wp_send_json_error('Please enter a valid email address.');
    }
    
    // Prepare email
    $to = get_option('admin_email'); // or use a specific email
    $subject = 'New Contact Form Submission from ' . $name;
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Organization: $organization\n\n";
    $body .= "Message:\n$message";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );
    
    // Send email
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        // Log the submission (optional)
        error_log("Jim Vieira contact form submitted by: $name ($email)");
        
        wp_send_json_success('Message sent successfully! We\'ll be in touch soon.');
    } else {
        wp_send_json_error('Failed to send message. Please try again later.');
    }
}
add_action('wp_ajax_jim_vieira_contact_form', 'jim_vieira_handle_contact_form');
add_action('wp_ajax_nopriv_jim_vieira_contact_form', 'jim_vieira_handle_contact_form');

/**
 * Add custom body class for Jim Vieira page
 */
function jim_vieira_body_class($classes) {
    if (is_page_template('page-jim-vieira.php')) {
        $classes[] = 'jim-vieira-page';
    }
    return $classes;
}
add_filter('body_class', 'jim_vieira_body_class');

/**
 * Disable WordPress admin bar on Jim Vieira page (optional)
 */
function jim_vieira_disable_admin_bar() {
    if (is_page_template('page-jim-vieira.php')) {
        show_admin_bar(false);
    }
}
add_action('wp_loaded', 'jim_vieira_disable_admin_bar');

/**
 * Add custom meta tags for SEO
 */
function jim_vieira_meta_tags() {
    if (is_page_template('page-jim-vieira.php')) {
        echo '<meta name="robots" content="index, follow">' . "\n";
        echo '<link rel="canonical" href="' . get_permalink() . '">' . "\n";
    }
}
add_action('wp_head', 'jim_vieira_meta_tags');

/**
 * Custom excerpt length for Jim Vieira content
 */
function jim_vieira_excerpt_length($length) {
    if (is_page_template('page-jim-vieira.php')) {
        return 30;
    }
    return $length;
}
add_filter('excerpt_length', 'jim_vieira_excerpt_length');

/**
 * Add schema.org markup for Jim Vieira (Author/Person)
 */
function jim_vieira_schema_markup() {
    if (is_page_template('page-jim-vieira.php')) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Jim Vieira',
            'jobTitle' => 'Author, Researcher, Explorer',
            'description' => 'Author, researcher, and History Channel explorer sharing groundbreaking insights into giants, lost civilizations, and hidden history.',
            'url' => get_permalink(),
            'sameAs' => array(
                'https://youtube.com',
                'https://instagram.com',
                'https://facebook.com'
            ),
            'knowsAbout' => array(
                'Ancient Civilizations',
                'Giant Skeletons',
                'Alternative Archaeology',
                'Lost History',
                'Megalithic Structures'
            )
        );
        
        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>' . "\n";
    }
}
add_action('wp_head', 'jim_vieira_schema_markup');

/**
 * Optimize images for Jim Vieira page
 */
function jim_vieira_image_optimization() {
    if (is_page_template('page-jim-vieira.php')) {
        // Add WebP support detection
        echo '<script>
        if (window.Modernizr && Modernizr.webp) {
            document.documentElement.classList.add("webp");
        }
        </script>' . "\n";
    }
}
add_action('wp_head', 'jim_vieira_image_optimization');

/**
 * Add custom CSS for WordPress integration
 */
function jim_vieira_custom_css() {
    if (is_page_template('page-jim-vieira.php')) {
        echo '<style>
        /* Hide WordPress admin elements */
        .jim-vieira-page #wpadminbar,
        .jim-vieira-page .wp-block-navigation,
        .jim-vieira-page .wp-block-site-title,
        .jim-vieira-page .wp-block-site-tagline {
            display: none !important;
        }
        
        /* Ensure full-width layout */
        .jim-vieira-page .site-content {
            margin: 0;
            padding: 0;
            max-width: none;
        }
        
        /* Fix any theme conflicts */
        .jim-vieira-page .entry-content {
            padding: 0;
            margin: 0;
        }
        </style>' . "\n";
    }
}
add_action('wp_head', 'jim_vieira_custom_css');
