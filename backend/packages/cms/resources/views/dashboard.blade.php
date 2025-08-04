<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" 
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" 
			crossorigin="anonymous" 
			referrerpolicy="no-referrer"/>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    @vite(['resources/css/cms.css', 'resources/js/cms.js'])
	</head>
	<body class="cms-primary-color text-white">
		<div id='app' data-view="{{ $view }}" data-props='@json($data)'></div>
	</body>
</html>