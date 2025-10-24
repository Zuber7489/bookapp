<?php
/*
Template Name: Jim Vieira Homepage
Description: Custom template for Jim Vieira's author website
Version: 1.0
*/

get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Jim Vieira - Author, researcher, and History Channel explorer sharing groundbreaking insights into giants, lost civilizations, and hidden history.">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="keywords" content="Jim Vieira, giants, lost civilizations, hidden history, archaeology, History Channel, ancient mysteries">
    <meta name="author" content="Jim Vieira">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Jim Vieira | Unveiling the Mysteries of Humanity's Origins">
    <meta property="og:description" content="Author, researcher, and History Channel explorer sharing groundbreaking insights into giants, lost civilizations, and hidden history.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/jim-vieira/styles.css">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
// Include the main content from index.html
include(get_template_directory() . '/jim-vieira/index-content.php');
?>

<?php wp_footer(); ?>

<!-- Custom Scripts -->
<script src="<?php echo get_template_directory_uri(); ?>/jim-vieira/script.js"></script>
<script>
    lucide.createIcons();
</script>

</body>
</html>

<?php get_footer(); ?>
