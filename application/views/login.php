<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page - MCI Telkomsel </title>
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets') ?>/images/favicon.png">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

	<style>
		body,
		input,
		button,
		textarea {
			font-family: 'Poppins', sans-serif;
			font-size: 14px;
			/* Sesuaikan sesuai kebutuhan */
			line-height: 1.5;
			/* Sesuaikan sesuai kebutuhan */
		}

		input,
		button {
			padding: 8px 10px;
			/* Sesuaikan padding untuk mengkompensasi perubahan ukuran */
			margin-bottom: 10px;
			/* Sesuaikan margin jika perlu */
		}

		.login-section p,
		.login-section h1,
		.login-section h3 {
			margin-bottom: 15px;
			/* Sesuaikan margin untuk mengontrol spacing */
		}

		body {
			margin: 0;
			/* font-family: Arial, sans-serif; */
			display: flex;
			height: 100vh;
			align-items: center;
			justify-content: center;
			background: #f5f5f5;
		}

		.container {
			display: flex;
			width: 80%;
			max-width: 1000px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
			overflow: hidden;
			position: relative;
			/* Ensure the container maintains its position */
			z-index: 1;
			max-height: 90vh;
			/* Adjust as needed */
			overflow: auto;
			/* Higher z-index to keep it above any other positioned elements */
		}

		.login-section {
			flex: 1;
			background: #fff;
			padding: 40px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			text-align: center;
			max-height: 90vh;
			/* Adjust as needed */
			overflow: auto;
			/* Center text horizontally */
		}

		.login-section h1 {
			margin: 0 0 20px;
			font-size: 24px;
			font-weight: bold;
		}

		.login-section p {
			margin: 0 0 20px;
			color: #888;
		}

		.login-section input {
			width: 80%;
			padding: 10px;
			margin: 10px 0;
			border: 1px solid #ccc;
			border-radius: 10px;
			outline: none;
		}

		.login-section button {
			width: 80%;
			padding: 10px;
			background: #E11C1C;
			border: none;
			border-radius: 10px;
			color: #fff;
			font-size: 16px;
			cursor: pointer;
			margin-bottom: 10px;
			margin-top: 30px;
		}

		.login-section .google-login {
			width: 71%;
			margin: 10px 0;
			padding: 10px;
			background: #000000;
			/* Changed to black color */
			border: 1px solid #ccc;
			border-radius: 10px;
			/* Removed rounded corners */
			font-size: 16px;
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			color: #fff;
			/* Changed text color to white */
			margin: 0 auto;
		}

		.login-section .google-login img {
			margin-right: 10px;
		}

		.login-section .or {
			display: flex;
			align-items: center;
			text-align: center;
			color: #888;
			margin: 20px 0;
			width: 75%;
			margin: 0 auto;
			/* Center horizontally */
		}

		.login-section .or::before,
		.login-section .or::after {
			content: '';
			flex: 1;
			border-bottom: 1px solid #ccc;
		}

		.login-section .or:not(:empty)::before {
			margin-right: .25em;
		}

		.login-section .or:not(:empty)::after {
			margin-left: .25em;
		}

		.login-section .social-login {
			margin: 20px 0;
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		.image-section {
			flex: 1;
			background: #ff0000;
			/* Updated to red color */
			display: flex;
			align-items: center;
			justify-content: center;
			position: relative;
		}

		.image-section img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			border-radius: 0 10px 10px 0;
		}

		.login-logo {
			width: 80%;
			/* Sesuaikan lebar dengan input dan teks */
			margin: 0 auto 20px;
			/* Centering secara horizontal dan tambahkan margin bawah */
			display: flex;
			justify-content: left;
			/* Rata kiri */
			align-items: center;
			/* Tengah secara vertikal */
		}

		.login-logo img {
			width: 90px;
		}

		.google-login {
			text-decoration: none;
			color: inherit;
		}

		.left-align {
			text-align: left;
			/* Align text to the left */
		}

		.login-section h1,
		.login-section p {
			width: 80%;
			/* Sesuaikan lebar dengan input */
			margin: 0 auto 10px;
			/* Kurangi margin bawah untuk mengurangi jarak */
			text-align: left;
			/* Pastikan teks rata kiri */
			padding: 0;
			/* Pastikan tidak ada padding yang tidak diinginkan */
		}

		.login-section input,
		.login-section button {
			width: 75%;
			/* Pastikan semua elemen form memiliki lebar yang sama */
			margin: 10px auto;
			/* Centering secara horizontal */
			display: block;
			/* Pastikan elemen ini block untuk menghormati width dan margin */
			padding: 10px;
			/* Sesuaikan padding jika perlu */
		}

		.login-section form {
			width: 100%;
			/* Pastikan form menggunakan seluruh lebar section */
			display: flex;
			flex-direction: column;
			align-items: center;
			/* Tengahkan elemen secara vertikal */
		}

		.login-section p {
			margin: 0 auto 10px;
			/* Jaga jarak vertikal antar paragraf */
			color: #888;
			/* Warna teks */
			width: 80%;
			/* Lebar sama dengan input dan tombol */
			text-align: left;
			/* Rata kiri */
		}

		.login-section h3 {
			margin: 0 auto 20px;
			/* Jaga jarak vertikal */
			text-align: left;
			/* Rata kiri */
			width: 80%;
			/* Lebar sama dengan input dan tombol */
		}

		.login-section label {
			margin: 0 auto 0px;
			/* Jaga jarak vertikal */
			text-align: left;
			/* Rata kiri */
			width: 78%;
			/* Lebar sama dengan input dan tombol */
		}

		.login-section h3 small {
			font-size: larger;
			/* Membuat teks MCI Repository Portal sedikit lebih besar */
			font-weight: bold;
			/* Membuat teks ini bold */
		}
	</style>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
	<div class="container">
		<div class="login-section">
			<form action="<?= base_url('login') ?>" method="POST">
				<br><br>
				<div class="login-logo">
					<img src="<?= base_url('assets') ?>/images/telko.png" width="30" alt="logo-img">
				</div>
				<p class="left-align" style="color: #000000;">Selamat datang di</p>
				<p class="left-align" style="color: #E11C1C; font-weight: bold; font-size: 24px;"><b>MCI Repository Portal</b></p>

				<p class="left-align" style="color: #888;"><b>Masuk aplikasi untuk mengakses akun kamu</b></p>
				<p class="left-align">Login to access your account</p>
				<br>
				<label for="email" class="left-align"><b>Email</b>
					<span style="color: #E11C1C;"><b>*</b></span>
				</label>
				<input type="text" name="email" placeholder="Masukkan email / Enter your email" value="<?= $this->session->flashdata('email') ?>" autocomplete="off" required>
				<br>
				<label for="email" class="left-align"><b>Password</b>
					<span style="color: #E11C1C;"><b>*</b></span>
				</label>
				<input type="password" name="password" placeholder="Masukkan password / Enter your password" required>
				<br>
				<button type="submit">Login</button>
				<br>
				<div class="or"><b>OR</b></div>
				<br>
				<a href="javascript:void(0)" class="google-login">
					<img src="<?= base_url('assets') ?>/images/microsoft.png" width="20" alt="Google Icon"> Sign in with Microsoft
				</a>
			</form>
		</div>
		<div class="image-section">
			<img src="<?= base_url('assets') ?>/images/banner.png" alt="Login Image">
		</div>
	</div>
</body>

</html>

<?php if ($this->session->flashdata('success')) : ?>
	<script>
		Swal.fire({
			position: 'top-end',
			icon: 'success',
			title: 'Success!',
			text: '<?= $this->session->flashdata('success'); ?>',
			timer: 3000,
			timerProgressBar: true,
			showConfirmButton: false,
			toast: true
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('error')) : ?>
	<script>
		Swal.fire({
			position: 'top-end',
			icon: 'error',
			title: 'Oopss...!',
			text: '<?= $this->session->flashdata('error'); ?>',
			timer: 3000,
			timerProgressBar: true,
			showConfirmButton: false,
			toast: true
		});
	</script>
<?php endif; ?>