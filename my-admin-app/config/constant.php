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
    'maintain_photo_crop_ratio' => env('MAINTAIN_PHOTO_ASPECT_RATIO', true),

    /* Product Category Image Height and Width Define */
    'product_category_photo_thumb_width'=>env('PRODUCT_CATEGORY_PHOTO_THUMB_WIDTH',550),
    'product_category_photo_thumb_height'=>env('PRODUCT_CATEGORY_PHOTO_THUMB_HEIGHT',550),
    'product_category_photo_large_width'=>env('PRODUCT_CATEGORY_PHOTO_LARGE_WIDTH',800),
    'product_category_photo_large_height'=>env('PRODUCT_CATEGORY_PHOTO_LARGE_HEIGHT',800),
    'product_category_photo_path'=>env('PRODUCT_CATEGORY_PHOTO_PATH','public/uploads/product-category/'),

    /* Offers Image Height and Width Define */
    'offer_photo_thumb_width'=>env('OFFER_PHOTO_THUMB_WIDTH',550),
    'offer_photo_thumb_height'=>env('OFFER_PHOTO_THUMB_HEIGHT',550),
    'offer_photo_large_width'=>env('OFFER_PHOTO_LARGE_WIDTH',800),
    'offer_photo_large_height'=>env('OFFER_PHOTO_LARGE_HEIGHT',800),
    'offer_photo_path'=>env('OFFER_PHOTO_PATH','public/uploads/offer/'),

    /* Meat Type Image Height and Width Define */
    'meat_types_photo_thumb_width'=>env('MEAT_TYPES_PHOTO_THUMB_WIDTH',550),
    'meat_types_photo_thumb_height'=>env('MEAT_TYPES_PHOTO_THUMB_HEIGHT',550),
    'meat_types_photo_large_width'=>env('MEAT_TYPES_PHOTO_LARGE_WIDTH',800),
    'meat_types_photo_large_height'=>env('MEAT_TYPES_PHOTO_LARGE_HEIGHT',800),
    'meat_types_photo_path'=>env('MEAT_TYPES_PHOTO_PATH','public/uploads/meat-types/'),

    /* Products Image Height and Width Define */
    'products_photo_thumb_width'=>env('PRODUCTS_PHOTO_THUMB_WIDTH',550),
    'products_photo_thumb_height'=>env('PRODUCTS_PHOTO_THUMB_HEIGHT',550),
    'products_photo_large_width'=>env('PRODUCTS_PHOTO_LARGE_WIDTH',800),
    'products_photo_large_height'=>env('PRODUCTS_PHOTO_LARGE_HEIGHT',800),
    'products_photo_path'=>env('PRODUCTS_PHOTO_PATH','public/uploads/products/'),
    'products_gallery_photo_large_width'=>env('PRODUCTS_GALLERY_PHOTO_LARGE_WIDTH',800),
    'products_gallery_photo_large_height'=>env('PRODUCTS_GALLERY_PHOTO_LARGE_HEIGHT',800),


     /* Pages Image Height and Width Define */
     'pages_photo_thumb_width'=>env('PAGES_PHOTO_THUMB_WIDTH',550),
     'pages_photo_thumb_height'=>env('PAGES_PHOTO_THUMB_HEIGHT',550),
     'pages_photo_large_width'=>env('PAGES_PHOTO_LARGE_WIDTH',800),
     'pages_photo_large_height'=>env('PAGES_PHOTO_LARGE_HEIGHT',800),
     'pages_photo_path'=>env('PAGES_PHOTO_PATH','public/uploads/pages/'),

     /* Testimonials Image Height and Width Define */
     'testimonials_photo_thumb_width'=>env('TESTIMONIALS_PHOTO_THUMB_WIDTH',265),
     'testimonials_photo_thumb_height'=>env('TESTIMONIALS_PHOTO_THUMB_HEIGHT',166),
     'testimonials_photo_large_width'=>env('TESTIMONIALS_PHOTO_LARGE_WIDTH',265),
     'testimonials_photo_large_height'=>env('TESTIMONIALS_PHOTO_LARGE_HEIGHT',166),
     'testimonials_photo_path'=>env('TESTIMONIALS_PHOTO_PATH','public/uploads/testimonials/'),

      /* Users Profile Height and Width Define */
      'users_photo_thumb_width'=>env('USERS_PHOTO_THUMB_WIDTH',150),
      'users_photo_thumb_height'=>env('USERS_PHOTO_THUMB_HEIGHT',150),
      'users_photo_large_width'=>env('USERS_PHOTO_LARGE_WIDTH',300),
      'users_photo_large_height'=>env('USERS_PHOTO_LARGE_HEIGHT',300),
      'users_photo_path'=>env('USERS_PHOTO_PATH','public/uploads/users/'),

     /* global Sections Image Height and Width Define */
     'global_sections_photo_thumb_width'=>env('GLOBAL_SECTIONS_PHOTO_THUMB_WIDTH',550),
     'global_sections_photo_thumb_height'=>env('GLOBAL_SECTIONS_PHOTO_THUMB_HEIGHT',550),
     'global_sections_photo_large_width'=>env('GLOBAL_SECTIONS_PHOTO_LARGE_WIDTH',800),
     'global_sections_photo_large_height'=>env('GLOBAL_SECTIONS_PHOTO_LARGE_HEIGHT',800),
     'global_sections_photo_path'=>env('GLOBAL_SECTIONS_PHOTO_PATH','public/uploads/global-sections/'),

     /* What We Deliver Image Height and Width Define */
     'what_we_deliver_photo_thumb_width'=>env('WHAT_WE_DELIVER_PHOTO_THUMB_WIDTH',550),
     'what_we_deliver_photo_thumb_height'=>env('WHAT_WE_DELIVER_PHOTO_THUMB_HEIGHT',550),
     'what_we_deliver_photo_large_width'=>env('WHAT_WE_DELIVER_PHOTO_LARGE_WIDTH',800),
     'what_we_deliver_photo_large_height'=>env('WHAT_WE_DELIVER_PHOTO_LARGE_HEIGHT',800),
     'what_we_deliver_photo_path'=>env('WHAT_WE_DELIVER_PHOTO_PATH','public/uploads/what-we-deliver/'),
    

];
