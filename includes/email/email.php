<?php
function sendContactMail( WP_REST_Request $request ) {
    $response = array(
        'status'  => 304,
        'message' => 'There was an error sending the form.'
    );

    $siteName = wp_strip_all_tags( trim( get_option( 'blogname' ) ) );
    $contactName = $request['contact_name'];
    $contactEmail = $request['contact_email'];
    $contactMessage = $request['contact_message'];

    $subject = "[$siteName] (testing) New message from $contactName";
//  $body = "<h3>$subject</h3><br/>";
    $body = "<p><b>Name:</b> $contactName</p>";
    $body .= "<p><b>Email:</b> $contactEmail</p>";
    $body .= "<p><b>Message:</b> $contactMessage</p>";

    $to = 'rossmacdonald3411@gmail.com' ;
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        "Reply-To: $contactName <$contactEmail>",
    );

    if ( wp_mail( $to, $subject, $body, $headers ) ) {
        $response['status'] = 200;
        $response['message'] = 'Form sent successfully.';
        $response['test'] = $body;
    }

    return new WP_REST_Response( $response );
}


function log_error(WP_Error $error){
    error_log($error->get_error_message());
}

add_action('wp_mail_failed' ,'log_error');

add_action( 'rest_api_init', function () {
    register_rest_route( 'contact/v1', 'send', array(
        'methods'             => 'POST',
        'callback'            => 'sendContactMail',
        'permission_callback' => '__return_true',
        'args'                => array(
            'contact_name'    => array(
                'required'          => true,
                'validate_callback' => function ( $value ) {
                    return preg_match( '/[a-z0-9]{2,}/i', $value ) ? true :
                        new WP_Error( 'invalid_contact_name', 'Your custom error.' );
                },
                'sanitize_callback' => 'sanitize_text_field',
            ),
            'contact_email'   => array(
                'required'          => true,
                'validate_callback' => 'is_email',
                'sanitize_callback' => 'sanitize_email',
            ),
            'contact_message' => array(
                'required'          => true,
                'sanitize_callback' => 'sanitize_textarea_field',
            ),
        ),
    ) );
} );