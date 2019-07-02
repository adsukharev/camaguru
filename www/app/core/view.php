<?php

class View {

	public $template_view = "view_template.php";

	function render($content_view, $template_view, $data = null){

		include 'app/views/'.$template_view;
	}
}

?>
