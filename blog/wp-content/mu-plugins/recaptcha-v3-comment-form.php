<?php
/**
 * Plugin Name: Custom reCAPTCHA v3 for Comment Form
 * Plugin URI: https://thecreativecoders.com/
 * Description: Adds Google reCAPTCHA v3 to the WordPress comment form.
 * Author: Yashvir Pal
 * Author URI: https://yashvirpal.com
 * Version: 1.0
 */

// Enqueue reCAPTCHA v3 script
function mu_recaptcha_v3_enqueue_script() {
    wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js?render=6LfGzF0qAAAAAEl-iJcPpJG3U0zsS7qPD7cfQAe6', [], null, false );
}
add_action( 'wp_enqueue_scripts', 'mu_recaptcha_v3_enqueue_script' );

// Add reCAPTCHA v3 token to the comment form
function mu_recaptcha_v3_comment_form() {
    ?>
    <script type="text/javascript">
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfGzF0qAAAAAEl-iJcPpJG3U0zsS7qPD7cfQAe6', {action: 'comment'}).then(function(token) {
                var recaptchaResponse = document.getElementById('g-recaptcha-response');
                recaptchaResponse.value = token;
            });
        });
    </script>
    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
    <?php
}
add_action( 'comment_form', 'mu_recaptcha_v3_comment_form' );

// Verify the reCAPTCHA response during comment submission
function mu_verify_recaptcha_v3( $commentdata ) {
    $recaptcha_secret = '6LfGzF0qAAAAANEaE84AX4I6WzlzorvkHjEn3IJI'; // Replace with your secret key
    $recaptcha_response = isset($_POST['g-recaptcha-response']) ? sanitize_text_field($_POST['g-recaptcha-response']) : '';

    // Verify the reCAPTCHA response with Google
    $response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', [
        'body' => [
            'secret'   => $recaptcha_secret,
            'response' => $recaptcha_response,
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ],
    ] );

    $response_body = wp_remote_retrieve_body( $response );
    $result = json_decode( $response_body, true );

    if ( !$result['success'] || $result['score'] < 0.5 ) {
        wp_die( __( 'reCAPTCHA verification failed. Please try again.', 'codenskills' ) );
    }

    return $commentdata;
}
add_action( 'pre_comment_on_post', 'mu_verify_recaptcha_v3' );
