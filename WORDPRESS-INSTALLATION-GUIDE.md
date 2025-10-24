# 🚀 WordPress Installation Guide - Jim Vieira Website

## 📋 **Complete Setup Instructions**

### **Step 1: Upload Files to WordPress**

1. **Create the directory structure:**
   ```
   wp-content/themes/your-theme-name/jim-vieira/
   ```

2. **Upload these files to the `jim-vieira/` folder:**
   - `styles.css`
   - `script.js`
   - `images/` folder (with all 4 images)
   - `index-content.php`

3. **Upload the page template to your theme root:**
   - `page-jim-vieira.php` → `wp-content/themes/your-theme-name/`

### **Step 2: Add WordPress Functions**

**Option A: Add to functions.php (Recommended)**
```php
// Add this code to your theme's functions.php file
require_once get_template_directory() . '/functions-jim-vieira.php';
```

**Option B: Create a custom plugin**
1. Create folder: `wp-content/plugins/jim-vieira-website/`
2. Create file: `jim-vieira-website.php`
3. Add plugin header and include the functions

### **Step 3: Create the Page in WordPress**

1. **Go to WordPress Admin:**
   - Pages → Add New
   - Title: "Jim Vieira" (or your preferred title)
   - Page Attributes → Template: Select "Jim Vieira Homepage"
   - Publish

2. **Set as Homepage (Optional):**
   - Settings → Reading
   - "Your homepage displays" → "A static page"
   - Select your Jim Vieira page

### **Step 4: Update Configuration**

#### **Update Social Media Links**
In `index-content.php`, find and replace:
```php
// Replace these URLs with actual social media links
<a href="https://youtube.com" target="_blank">
<a href="https://instagram.com" target="_blank">
<a href="https://facebook.com" target="_blank">
```

#### **Update Email Address**
Replace `contact@jimvieira.com` with the actual email address.

#### **Update Book Purchase Links**
In `script.js`, uncomment and update the book purchase section:
```javascript
// Book Purchase Buttons (around line 220)
if (platform.includes('Amazon')) {
    window.open('YOUR_AMAZON_AFFILIATE_LINK', '_blank');
} else if (platform.includes('Audible')) {
    window.open('YOUR_AUDIBLE_AFFILIATE_LINK', '_blank');
}
```

### **Step 5: Test Everything**

#### **✅ Pre-Launch Checklist:**
- [ ] Page loads without errors
- [ ] All images display correctly
- [ ] Navigation works (smooth scrolling)
- [ ] Mobile menu functions
- [ ] Contact form submits successfully
- [ ] Social media links work
- [ ] Book purchase buttons work
- [ ] Responsive design works on mobile
- [ ] No console errors

#### **🔧 Troubleshooting:**

**Images not loading:**
- Check file paths in `index-content.php`
- Verify images are in `/jim-vieira/images/` folder
- Check file permissions (644 for files, 755 for folders)

**Styles not applying:**
- Clear browser cache
- Check if `styles.css` is in correct location
- Verify WordPress is loading the custom template

**Contact form not working:**
- Check WordPress error logs
- Verify email configuration in WordPress
- Test with a simple email first

**JavaScript errors:**
- Check browser console for errors
- Verify Lucide Icons CDN is loading
- Ensure `script.js` is loaded after DOM

### **Step 6: Performance Optimization**

#### **Enable Caching:**
- Install a caching plugin (WP Rocket, W3 Total Cache)
- Enable GZIP compression
- Optimize images (use WebP format)

#### **SEO Setup:**
- Install Yoast SEO or RankMath
- Add Google Analytics
- Submit sitemap to Google Search Console

### **Step 7: Security Considerations**

#### **Form Security:**
- The contact form includes WordPress nonce verification
- All inputs are sanitized
- Email validation is implemented

#### **Additional Security:**
- Keep WordPress updated
- Use strong passwords
- Install security plugins
- Enable SSL certificate

### **Step 8: Customization Options**

#### **Change Colors/Styles:**
Edit CSS variables in `styles.css`:
```css
:root {
    --primary: hsl(45, 65%, 58%);     /* Gold color */
    --secondary: hsl(25, 60%, 50%);   /* Bronze color */
    --background: hsl(42, 55%, 88%);  /* Background */
}
```

#### **Add More Sections:**
- Duplicate existing sections in `index-content.php`
- Add corresponding CSS in `styles.css`
- Update navigation links

#### **Integrate with WordPress Features:**
- Add WordPress widgets
- Include blog posts
- Add WordPress menus
- Use WordPress custom fields

### **Step 9: Maintenance**

#### **Regular Updates:**
- Keep WordPress core updated
- Update plugins regularly
- Monitor website performance
- Check for broken links

#### **Backup Strategy:**
- Set up automatic backups
- Test backup restoration
- Store backups off-site

### **Step 10: Go Live!**

1. **Final Testing:**
   - Test on multiple devices
   - Check all functionality
   - Verify contact form works
   - Test page loading speed

2. **Launch:**
   - Update DNS if needed
   - Set up monitoring
   - Announce the new website

---

## 🎯 **Quick Start Summary**

1. Upload files to `/wp-content/themes/your-theme/jim-vieira/`
2. Add `page-jim-vieira.php` to theme root
3. Add functions to `functions.php`
4. Create new page with custom template
5. Update social links and email
6. Test everything
7. Go live!

---

## 📞 **Support**

If you encounter issues:
1. Check WordPress error logs
2. Test in different browsers
3. Verify all file paths
4. Check file permissions
5. Clear all caches

**Your Jim Vieira website is now ready for WordPress!** 🎉
