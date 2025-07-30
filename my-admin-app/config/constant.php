<?php

return [

    /**
     * Contact Detials of website
     */
    'contact_details' => [
        'email' => env('EMAIL', 'contact@localhoast.com'),
        'phone' => env('PHONE', '1234567890'),
        'address' => env('ADDRESS', 'Sector 22 Gurgaon, Haryana, India'),
        'facebook' => env('FACEBOOK', 'https://www.facebook.com/'),
        'instagram' => env('INSTAGRAM', 'https://www.instagram.com/'),
        'linkedin' => env('LINKEDIN', 'https://linkedin.com/'),
        'button_url' => env('BUTTON_URL', 'http://yashvirpal.com'),
        'button_text' => env('BUTTON_TEXT', 'Visit Now'),
    ],

    /**
     * Pagination records per page
     */
    'pagination_records_per_page' => env('PAGINATION_RECORDS_PER_PAGE', 10),
    'admin_email' => env('ADMIN_EMAIL', 'admin@localhost.com'),


    /**
     * Pagination links on each side of current page
     */
    'pagination_links_each_side' => env('PAGINATION_LINKS_EACH_SIDE', 1),

    /**
     * Log database queries into log file
     */
    'log_db_queries' => env('LOG_DB_QUERY', false),

    /**
     * Display date format
     * Allowed date format: any php valid date format like "m-d-Y" for 10-23-2022
     * 
     * PHP Datetime format: https://www.php.net/manual/en/datetime.format.php
     * Note:- This date format used to display date in UI
     */
    'display_date_format' => env('DISPLAY_DATE_FORMAT', 'd-m-Y'),
    'event_display_date_format' => env('EVENT_DISPLAY_DATE_FORMAT', 'd-m-Y h:i A'),
    /**
     * Currency
     */
    'currency_symbol' => env('CURRENCY_SYMBOL', "₹"),
    'currency' => env('CURRENCY', "INR"),

    /**
     * Allowed file extension must be comma seperated
     */
    'column_status' => env('COLUMN_STATUS', 'active,inactive'),

    /**
     * Database date format to store date into database
     * or filter date from database
     *
     * Valid php date format
     */
    'db_date_format' => env('DB_DATE_FORMAT', 'Y-m-d'),

    /**
     * Validation date format
     * Single php date format or comma seperated list of valid php date formats
     *
     * Note:- This date format used for all request date validation
     */
    'validation_datetime_formats' => env('VALIDATION_DATE_FORMATS', '"d-m-Y H:i","Y-n-j H:i","Y-n-d H:i","Y-m-j H:i","Y-m-d H:i"'),

    /**
     * Image Valid Types
     */
    'image_valid_types' => env('IMAGE_VALID_TYPES', 'jpg,png,webp'),
    /**
     * True if Image Size Aspect Ratio is to be maintained
     */
    'maintain_crop_ratio' => env('MAINTAIN_ASPECT_RATIO', true),


    /* Blogs Image Height and Width Define */

    'blogs' => [
        'disk' => env('BLOGS_DISK', 'public'),
        'path' => env('BLOGS_PATH', 'uploads/blogs/'),
        'thumb_width' => env('BLOGS_THUMB_WIDTH', 550),
        'thumb_height' => env('BLOGS_THUMB_HEIGHT', 550),
        'width' => env('BLOGS_WIDTH', 800),
        'height' => env('BLOGS_HEIGHT', 800),
    ],
    'pages' => [
        'disk' => env('PAGES_DISK', 'public'),
        'path' => env('PAGES_PATH', 'uploads/pages/'),
        'thumb_width' => env('PAGES_THUMB_WIDTH', 600),
        'thumb_height' => env('PAGES_THUMB_HEIGHT', 600),
        'width' => env('PAGES_WIDTH', 1200),
        'height' => env('PAGES_HEIGHT', 800),
    ],


    /* Product Category Image Height and Width Define */
    'product_category_thumb_width' => env('PRODUCT_CATEGORY_THUMB_WIDTH', 550),
    'product_category_thumb_height' => env('PRODUCT_CATEGORY_THUMB_HEIGHT', 550),
    'product_category_width' => env('PRODUCT_CATEGORY_WIDTH', 800),
    'product_category_height' => env('PRODUCT_CATEGORY_HEIGHT', 800),
    'product_category_path' => env('PRODUCT_CATEGORY_PATH', 'public/uploads/product-category/'),

    /* Products Image Height and Width Define */
    'products_thumb_width' => env('PRODUCTS_THUMB_WIDTH', 550),
    'products_thumb_height' => env('PRODUCTS_THUMB_HEIGHT', 550),
    'products_width' => env('PRODUCTS_WIDTH', 800),
    'products_height' => env('PRODUCTS_HEIGHT', 800),
    'products_path' => env('PRODUCTS_PATH', 'public/uploads/products/'),
    'products_gallery_width' => env('PRODUCTS_GALLERY_WIDTH', 800),
    'products_gallery_height' => env('PRODUCTS_GALLERY_HEIGHT', 800),


    /* Pages Image Height and Width Define */
    'pages_thumb_width' => env('PAGES_THUMB_WIDTH', 550),
    'pages_thumb_height' => env('PAGES_THUMB_HEIGHT', 550),
    'pages_width' => env('PAGES_WIDTH', 800),
    'pages_height' => env('PAGES_HEIGHT', 800),
    'pages_path' => env('PAGES_PATH', 'public/uploads/pages/'),

    /* Testimonials Image Height and Width Define */
    'testimonials_thumb_width' => env('TESTIMONIALS_THUMB_WIDTH', 265),
    'testimonials_thumb_height' => env('TESTIMONIALS_THUMB_HEIGHT', 166),
    'testimonials_width' => env('TESTIMONIALS_WIDTH', 265),
    'testimonials_height' => env('TESTIMONIALS_HEIGHT', 166),
    'testimonials_path' => env('TESTIMONIALS_PATH', 'public/uploads/testimonials/'),

    /* Users Profile Height and Width Define */
    'users_thumb_width' => env('USERS_THUMB_WIDTH', 150),
    'users_thumb_height' => env('USERS_THUMB_HEIGHT', 150),
    'users_width' => env('USERS_WIDTH', 300),
    'users_height' => env('USERS_HEIGHT', 300),
    'users_path' => env('USERS_PATH', 'public/uploads/users/'),




];
