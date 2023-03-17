<!DOCTYPE html>
<html>

<head>
	<title>QR Code Scanner</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		body {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			overflow: hidden;
			background: linear-gradient(to bottom, #B8D3FF, #A6F3AB, orange);
			background-size: 400% 400%;
			animation: gradient 5s ease infinite;
		}

		@keyframes gradient {
			0% {
				background-position: 0% 50%;
			}

			50% {
				background-position: 100% 50%;
			}

			100% {
				background-position: 0% 50%;
			}
		}

		.box {
			display: flex;
			flex-direction: column;
			align-items: center;
			padding: 30px;
			background-color: #ffffff;
			box-shadow: 0px 0px 20px #cccccc;
		}

		.box h1 {
			margin-top: 0;
			margin-bottom: 30px;
			font-size: 30px;
			color: #333333;
		}

		#preview {
			width: 100%;
			height: 100%;
			object-fit: cover;
			margin-bottom: 20px;
		}

		@media (max-width: 768px) {
			.box {
				padding: 15px;
			}

			.box h1 {
				font-size: 24px;
			}
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<div class="box">
			<h1>Scan QR Code</h1>
			<video id="preview"></video>
		</div>
	</div>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

	<script>
		let box = document.querySelector('.box');
		let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
		scanner.addListener('scan', function (content) {
			let data = content.split(', ');

			// Extract the event ID from the QR code data
			// Extract the event ID from the QR code data
			let eventId = data[0].trim().split('Event Name')[0].split(': ')[1];


			// Create a URL with the event ID as a parameter
			let url = 'process_qr.php?eventId=' + eventId;

			// Create a hidden form
			let form = document.createElement('form');
			form.method = 'POST';
			form.action = url;

			// Loop through the data from the URL query string and create a hidden field for each key-value pair
			let queryString = window.location.search.substring(1);
			let queryParams = new URLSearchParams(queryString);
			queryParams.forEach(function (value, key) {
				let input = document.createElement('input');
				input.type = 'hidden';
				input.name = 'data[' + key + ']';
				input.value = value;
				form.appendChild(input);
			});

			// Create hidden fields for the remaining data
			let lastname = document.createElement('input');
			lastname.type = 'hidden';
			lastname.name = 'data[lastname]';
			lastname.value = data[2];
			form.appendChild(lastname);

			let email = document.createElement('input');
			email.type = 'hidden';
			email.name = 'data[email]';
			email.value = data[3];
			form.appendChild(email);

			// Add the form to the page and submit it
			document.body.appendChild(form);
			form.submit();
		});



		Instascan.Camera.getCameras().then(function (cameras) {
			if (cameras.length > 0) {
				let backCamera = cameras.find(camera => camera.name.includes('back'));
				let camera = backCamera || cameras[0];
				scanner.start(camera, { video: { facingMode: { exact: "environment" }, width: { exact: box.offsetWidth }, height: { exact: box.offsetHeight } } });
			} else {
				alert('No camera found');
			}
		}).catch(function (e) {
			console.error(e);
		});

	</script>


</body>

</html>