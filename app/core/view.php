<?php

class View {

	// $template_view = "view_template.php";

	function render($content_view, $template_view, $data = null){
		// header('Location: app/views/'.$template_view);
		// echo ("view");
		include 'app/views/'.$template_view;
	}
}

?>
