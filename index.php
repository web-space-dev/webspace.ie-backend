<?php

wp_head();

?>

<body <?php body_class(); ?> style="margin: 0;">
<?php wp_body_open(); ?>
<iframe src="http://localhost:8000" style="display: block; width: 100%; height: 100%; border: none;"></iframe>

<?php wp_footer(); ?>
</body>