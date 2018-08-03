<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= $title ?></title>

	<link rel="icon" type="image/png" href="<?= base_url('asset/images/fav.png'); ?>"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

	<script src="https://unpkg.com/vue@2.5.16/dist/vue.min.js"></script>
	<script src="https://underscorejs.org/underscore-min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://momentjs.com/downloads/moment.min.js"></script>
	<script src="https://js.pusher.com/4.2/pusher.min.js"></script>
	<style>
		html {
			overflow: auto;
		}

		.chat-box {
			height: 300px;
			overflow: auto;
		}

		.mb-5 {
			margin-bottom: 5 !important;
		}
	</style>
</head>
<body>
	<?php $this->load->view($page) ?>
</body>
</html>
