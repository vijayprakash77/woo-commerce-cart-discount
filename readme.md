## WooCommerce Conditional Discount on Cart
**Contributors:** Vijay Prakash Mahato  
**Tags:** wordpress, woocommerce, discount, cart, conditional, accessories  
**Requires at least:** 6.8.1  
**Tested up to:** 6.4  
**Requires PHP:** 7.4  
**Stable tag:** 0.0.1  

Automatically applies 15% discount when cart contains accessories products and total is ₹2000 or more.
and show discount message on top of cart table
## Plugin Demo Video

https://github.com/user-attachments/assets/dd004dc4-cfcc-4ed9-a8c0-febb87f46e51


## Description

WooCommerce Conditional Discount is a lightweight plugin that automatically applies a 15% discount to your WooCommerce cart when specific conditions are met:

**Key Features:**
* Automatic discount application (no coupon codes needed)
* Non-intrusive implementation (works with existing coupons)
* Clear messaging to customers about discount status
* Responsive design with attractive styling

**Condition to apply discount:**
* Cart contains at least one product from the "Accessories" category
* Total cart value is ₹2000 or more

**How it works:**
1. Customer adds products to cart
2. Plugin checks if conditions are met
3. If conditions are satisfied, 15% discount is automatically applied
4. Customer sees confirmation message and discount amount on cart page

## Installation 

**Requirement to Install this Plugin on Wordpress:**
1. Must have woo commerce plugin to be install

**How to install in wordpress:**
1. Download the plugin ZIP file or Clone it from this repo
2. Log in to your WordPress admin dashboard
3. Navigate to Plugins > Install Plugins > Add Plugin 
4. Click "Upload Plugin" button
5. Choose the ZIP file and click "Install Now"
6. Activate the plugin

**Requirements:**
* WordPress 6.8.1 or higher
* WooCommerce 9.9.5 or higher
* PHP 7.4 or higher

## Setup Instructions

**1. Create Accessories Category**
1. Go to Products > Categories in your WordPress admin
2. Create a category named "Accessories"

**2. Add Products to Accessories Category**
1. Edit your accessory products
2. Assign them to the "Accessories" category
3. Save the products

**3. Test the Plugin**
1. Add an accessories product to cart
2. Add other products to reach ₹2000 total
3. Visit cart page to see the discount applied

## Assumptions Made 

**Category Recognition:**
* Plugin looks for categories with slugs: "accessories"
* Category matching is case-insensitive
* Plugin checks product categories, not variations

**Currency:**
* Plugin assumes Indian Rupees (₹) as primary currency
* Minimum amount check is ₹2000

**Discount Calculation:**
* 15% discount is calculated on cart subtotal (before taxes/shipping)
* Discount is applied as a negative fee
* Does not interfere with existing coupons or other discounts

**Compatibility:**
* Designed for standard WooCommerce installations
* Compatible with most themes and plugins
* Uses WooCommerce hooks and filters

## Frequently Asked Questions

**Q: Does this plugin interfere with existing coupons?**
A: No, the plugin applies discount as a fee, not a coupon, so it works alongside existing coupons.

**Q: Can I change the discount percentage?**
A: Yes, modify the value `0.15` in the code (line with `$discount_amount = $cart_total * 0.15;`)

**Q: Can I change the minimum cart amount?**
A: Yes, modify the value `2000` in the condition check (line with `if ($cart_total < 2000)`)

**Q: What if my accessories category has a different name?**
A: Edit the `$accessories_slugs` array in the `add_custom_message_before_cart()` and `wcd_apply_conditional_discount()` function

**Q: Does it work with variable products?**
A: Yes, the plugin checks the main product categories for variations

**Q: Can I customize the discount message?**
A: Yes, modify the text in the `$discount_message` variable

## Technical Details 

**Plugin Architecture:**
* Uses procedural PHP (no OOP)
* Implements WooCommerce hooks and filters
* Session-independent (recalculates on each page load)

**Key Functions:**
* `wcd_apply_conditional_discount()` - Main discount logic
* `wcd_display_discount_message()` - Shows customer messages

**Hooks Used:**
* `woocommerce_cart_calculate_fees` - Applies discount
* `render_block_woocommerce/cart` - Shows cart messages

**Security Features:**
* Prevents direct file access
* Sanitizes all outputs
* Uses WordPress/WooCommerce best practices

## Troubleshooting 

**Discount not applying:**
1. Ensure WooCommerce is active
2. Check if products are in "Accessories" category
3. Verify cart total is ₹2000 or more
4. Check for plugin conflicts

**Message not showing:**
1. Clear any caching plugins
2. Check theme compatibility
3. Ensure you're on cart pages

**Category not recognized:**
1. Check category slug (should be "accessories" or similar)
2. Verify products are properly categorized
3. Check for typos in category names

## Changelog 

= 0.0.1 =
* Initial release
* Automatic 15% discount for accessories + ₹2000 minimum
* Customer messaging system
* WooCommerce compatibility

## Upgrade Notice 

= 0.0.1 =
Initial release of WooCommerce Conditional Discount plugin.

## Development Notes 

**Code Structure:**
* Single file plugin for simplicity
* All functions prefixed with `wcd_` to avoid conflicts
* Follows WordPress coding standards

**Customization Options:**
* Easy to modify discount percentage
* Simple to change minimum amount
* Category names easily configurable
* Messages can be customized

**Performance Considerations:**
* Lightweight implementation
* Minimal database queries
* Efficient category checking
* No external dependencies

## Support 

For support, feature requests, or bug reports, please contact me [vijayprakashmh@gmail.com](mailto:vijayprakashmh@gmail.com).

**Plugin Information:**
* Version: 0.0.1
* Tested with: WooCommerce 9.9.5, WordPress 6.8.1
* License: MIT License
