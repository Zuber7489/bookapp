# Jim Vieira Website - WordPress Installation Guide

## 📦 Package Contents

This package contains a production-ready static HTML/CSS/JS website for Jim Vieira. All files are optimized for WordPress deployment.

### Files Included:
- `index.html` - Main HTML file
- `styles.css` - Complete stylesheet
- `script.js` - Interactive JavaScript
- `images/` folder - All image assets (see below)
- `README.md` - This file

## 🖼️ Required Images

Before uploading, you need to add these images to the `images/` folder:

1. **hero-egypt.jpg** - Hero section background (1920x1080px recommended)
2. **cuneiform-pattern.jpg** - Background pattern for About & Speaking sections
3. **jim-vieira-portrait.jpg** - Jim's portrait photo (800x1280px recommended)
4. **giants-on-record-cover.jpg** - Book cover image (600x900px recommended)

Copy these from: `src/assets/` in your original project

## 📤 WordPress Installation Methods

### Method 1: Custom Page Template (Recommended)

1. **Create a custom page template:**
   ```php
   <?php
   /*
   Template Name: Jim Vieira Homepage
   */
   ?>
   <!DOCTYPE html>
   <?php
   // Include the content of index.html here
   include(get_template_directory() . '/jim-vieira/index.html');
   ?>
   ```

2. **Upload files to your theme:**
   - Create folder: `wp-content/themes/your-theme/jim-vieira/`
   - Upload `index.html`, `styles.css`, `script.js`
   - Upload `images/` folder
   
3. **Update paths in index.html:**
   ```html
   <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/jim-vieira/styles.css">
   <script src="<?php echo get_template_directory_uri(); ?>/jim-vieira/script.js"></script>
   ```

4. **Create new page in WordPress:**
   - Pages → Add New
   - Select "Jim Vieira Homepage" template
   - Publish

### Method 2: Upload to Root Directory

1. **Upload via FTP/cPanel:**
   - Upload all files to a subfolder: `/public_html/jim-vieira/`
   - Ensure `images/` folder is uploaded
   
2. **Access directly:**
   - Visit: `https://yoursite.com/jim-vieira/`

3. **Set as homepage (optional):**
   - Use `.htaccess` redirect or WordPress settings

### Method 3: Use as Landing Page

1. **Create landing page plugin or child theme**
2. **Override homepage template**
3. **Include the HTML content**

## 🎨 Customization Guide

### Update Social Media Links

In `index.html`, find and replace:

```html
<!-- Navigation & Footer -->
<a href="https://youtube.com" target="_blank">  <!-- Replace with actual YouTube URL -->
<a href="https://instagram.com" target="_blank">  <!-- Replace with actual Instagram URL -->
<a href="https://facebook.com" target="_blank">  <!-- Replace with actual Facebook URL -->
```

### Update Email Address

Replace `contact@jimvieira.com` throughout the file with the actual email.

### Update Book Purchase Links

In `script.js`, add affiliate links:

```javascript
// Book Purchase Buttons (line ~200)
if (platform.includes('Amazon')) {
    window.open('YOUR_AMAZON_AFFILIATE_LINK', '_blank');
} else if (platform.includes('Audible')) {
    window.open('YOUR_AUDIBLE_AFFILIATE_LINK', '_blank');
}
```

### Update Video IDs

Replace placeholder video thumbnails with actual YouTube embeds:

```html
<!-- In index.html, Videos Section -->
<div class="video-thumbnail" data-video-id="YOUR_YOUTUBE_ID">
```

## 📧 Contact Form Integration

The contact form currently shows a success message. To make it functional:

### Option 1: Contact Form 7 (Recommended)
1. Install Contact Form 7 plugin
2. Create a form with matching fields
3. Replace the form HTML with Contact Form 7 shortcode

### Option 2: Custom PHP Handler
Create `form-handler.php`:

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $organization = sanitize_text_field($_POST['organization']);
    $message = sanitize_textarea_field($_POST['message']);
    
    $to = 'contact@jimvieira.com';
    $subject = 'New Contact Form Submission from ' . $name;
    $body = "Name: $name\nEmail: $email\nOrganization: $organization\n\nMessage:\n$message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    if (wp_mail($to, $subject, $body, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
```

Update `script.js` to uncomment the AJAX section and point to this handler.

### Option 3: Third-Party Service
- Integrate with Mailchimp, SendGrid, or FormSpree
- Update the form action URL

## 🔧 WordPress-Specific Enhancements

### Add to functions.php:

```php
// Enqueue custom styles and scripts
function jim_vieira_enqueue_assets() {
    if (is_page_template('page-jim-vieira.php')) {
        wp_enqueue_style('jim-vieira-fonts', 'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&display=swap');
        wp_enqueue_style('jim-vieira-styles', get_template_directory_uri() . '/jim-vieira/styles.css');
        wp_enqueue_script('lucide-icons', 'https://unpkg.com/lucide@latest', array(), null, true);
        wp_enqueue_script('jim-vieira-script', get_template_directory_uri() . '/jim-vieira/script.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'jim_vieira_enqueue_assets');
```

## 📱 Mobile Optimization

The site is fully responsive and includes:
- Mobile-first design
- Touch-friendly navigation
- Optimized images for mobile devices
- Smooth scrolling on all devices

Test on:
- iPhone (Safari)
- Android (Chrome)
- iPad (Safari)

## 🚀 Performance Optimization

### Already Implemented:
- CSS minification ready
- Lazy loading for images
- Debounced scroll events
- Optimized animations
- Efficient selectors

### Additional Recommendations:
1. **Use a CDN** for images and assets
2. **Enable GZIP compression** on server
3. **Minimize HTTP requests**
4. **Cache static assets**
5. **Use WebP images** where supported

## 🔍 SEO Features

### Included:
- Semantic HTML5 structure
- Meta descriptions and keywords
- Open Graph tags
- Proper heading hierarchy (H1, H2, H3)
- Descriptive alt text for images
- Clean URLs
- Fast loading times

### To Add:
1. **Google Analytics:** Add tracking code before `</head>`
2. **Google Search Console:** Verify ownership
3. **Schema.org markup:** Already included for Person/Author
4. **XML Sitemap:** Use Yoast SEO or similar plugin
5. **Robots.txt:** Ensure proper configuration

## 🎥 Video Integration

To add actual YouTube videos:

1. **Get video IDs** from YouTube URLs
2. **Update HTML** with data attributes:
   ```html
   <div class="video-thumbnail" data-video-id="dQw4w9WgXcQ">
   ```

3. **Uncomment video modal code** in `script.js` (line ~250)

4. **Style the modal** (add to `styles.css`):
   ```css
   .video-modal {
       position: fixed;
       inset: 0;
       background: rgba(0,0,0,0.9);
       z-index: 9999;
       display: flex;
       align-items: center;
       justify-content: center;
   }
   ```

## 📊 Analytics & Tracking

Add Google Analytics:

```html
<!-- Add before </head> in index.html -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

Track events in `script.js`:
```javascript
gtag('event', 'button_click', {
    'event_category': 'engagement',
    'event_label': 'Book Jim'
});
```

## 🔐 Security Considerations

1. **Sanitize form inputs** (already done in PHP example)
2. **Use HTTPS** for all pages
3. **Add CSRF tokens** to forms
4. **Implement rate limiting** on contact form
5. **Keep WordPress updated**

## 🐛 Troubleshooting

### Images not loading:
- Check file paths in HTML
- Verify images are uploaded to correct folder
- Check file permissions (644 for files, 755 for folders)

### Styles not applying:
- Clear browser cache
- Check CSS file path
- Verify file is uploaded correctly
- Inspect element to check if styles are loaded

### JavaScript not working:
- Check browser console for errors
- Verify Lucide icons CDN is loading
- Ensure script.js is loaded after DOM elements

### Contact form not submitting:
- Check PHP mail configuration
- Verify email addresses
- Test with Contact Form 7 plugin
- Check spam folder

## 📞 Support & Updates

For questions or issues:
1. Check WordPress forums
2. Review browser console for errors
3. Test in different browsers
4. Verify all file paths

## ✅ Pre-Launch Checklist

- [ ] All images uploaded and displaying correctly
- [ ] Social media links updated
- [ ] Email addresses updated
- [ ] Book purchase links working
- [ ] Contact form tested and working
- [ ] Mobile responsiveness checked
- [ ] Page loading speed tested
- [ ] SEO meta tags verified
- [ ] Analytics installed
- [ ] Cross-browser tested (Chrome, Firefox, Safari, Edge)
- [ ] SSL certificate installed
- [ ] Backup created

## 📄 License & Credits

- **Fonts:** Google Fonts (Cinzel, Merriweather)
- **Icons:** Lucide Icons (MIT License)
- **Images:** Ensure you have rights to use all images

---

**Version:** 1.0  
**Last Updated:** 2025  
**Compatibility:** WordPress 5.0+, All modern browsers

For the best results, test thoroughly before going live!