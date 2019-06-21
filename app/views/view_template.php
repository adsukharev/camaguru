
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Template</title>
	<link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/header.css">
	<link rel="stylesheet" href="/css/main.css">
</head>

<body>
	<header>
		<div class="container header">
			<div>
				header1
			</div>

			<div>
				header2
			</div>

		</div>
	</header>

	<main>
		 <div class="container main">
			<?php include 'app/views/'.$content_view; ?>
		 </div>
	</main>

	<footer>

	</footer>
</body>

</html>
