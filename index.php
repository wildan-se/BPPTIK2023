<?php
session_start(); // Memulai sesi

// Data kendaraan
$kendaraan = ["Sedan", "Minivan", "Minibus", "Sepeda Motor", "Pickup"];
sort($kendaraan);

function hitung_sewa($biaya_platform, $jarak, $biaya_per_km)
{
	$nilai_sewa = $biaya_platform + ($jarak * $biaya_per_km);
	return $nilai_sewa;
}

// Menangani data pemesanan
if (isset($_POST['Pesan'])) {
	$dataPesanan = [
		'nama' => $_POST['nama'],
		'noHP' => $_POST['noHP'],
		'kendaraan' => $_POST['kendaraan'],
		'jarak' => $_POST['jarak']
	];

	$jarak_tempuh = $dataPesanan['jarak'];
	$biaya_platform = 0;
	$biaya_per_km = 0;

	switch ($dataPesanan['kendaraan']) {
		case 'Sedan':
			$biaya_platform = 10000;
			$biaya_per_km = 5000;
			break;
		case 'Minivan':
			$biaya_platform = 12000;
			$biaya_per_km = 6000;
			break;
		case 'Minibus':
			$biaya_platform = 15000;
			$biaya_per_km = 10000;
			break;
		case 'Sepeda Motor':
			$biaya_platform = 5000;
			$biaya_per_km = 3000;
			break;
		case 'Pickup':
			$biaya_platform = 15000;
			$biaya_per_km = 8000;
			break;
	}

	$dataPesanan['total'] = hitung_sewa($biaya_platform, $jarak_tempuh, $biaya_per_km);

	$_SESSION['pesanan'] = $dataPesanan; // Menyimpan data ke sesi
}

// Menghapus sesi data pemesanan
if (isset($_POST['HapusData'])) {
	unset($_SESSION['pesanan']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pemesanan kendaraan Online</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<style>
		.container-border {
			background: #fff;
			border-radius: 12px;
			padding: 40px 25px;
			max-width: 450px;
			width: 100%;
			box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
		}

		/* Centering form on initial load */
		.centered-container {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
		}
	</style>
</head>

<body>
	<div class="container <?php echo isset($_SESSION['pesanan']) ? 'mt-5' : 'centered-container'; ?>">
		<div class="row <?php echo isset($_SESSION['pesanan']) ? '' : 'justify-content-center'; ?>">
			<!-- Form Pemesanan -->
			<div class="col-lg-<?php echo isset($_SESSION['pesanan']) ? '6' : '12'; ?> mb-4">
				<div class="container-border p-4">
					<h3>Pemesanan kendaraan Online</h3>
					<img src="logo.jpg" alt="Taxi Online Logo" class="d-block mx-auto my-3" width="60">

					<form action="index.php" method="post" id="formPemesanan">
						<div class="form-group">
							<label for="nama">Nama Pelanggan:</label>
							<input type="text" class="form-control" id="nama" name="nama" required>
						</div>
						<div class="form-group">
							<label for="noHP">Nomor HP:</label>
							<input type="text" class="form-control" id="noHP" name="noHP" maxlength="16" required>
						</div>
						<div class="form-group">
							<label for="kendaraan">Jenis Kendaraan:</label>
							<select class="form-control" id="kendaraan" name="kendaraan" required>
								<option value="" disabled selected>- Pilih jenis kendaraan -</option>
								<?php
								foreach ($kendaraan as $jenis) {
									echo '<option value="' . $jenis . '">' . $jenis . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="jarak">Jarak (km):</label>
							<input type="number" class="form-control" id="jarak" name="jarak" maxlength="4" required>
						</div>
						<button class="btn btn-primary btn-submit" type="submit" form="formPemesanan" value="Pesan" name="Pesan">Pesan</button>
					</form>
				</div>
			</div>

			<!-- Hasil Pemesanan -->
			<?php if (isset($_SESSION['pesanan'])) : ?>
				<div class="col-lg-6">
					<div class="container-border p-4 result-container">
						<h4>Hasil Pemesanan</h4>
						<div><strong>Nama Pelanggan:</strong> <?= $_SESSION['pesanan']['nama'] ?></div>
						<div><strong>Nomor HP:</strong> <?= $_SESSION['pesanan']['noHP'] ?></div>
						<div><strong>Jenis Kendaraan:</strong> <?= $_SESSION['pesanan']['kendaraan'] ?></div>
						<div><strong>Jarak (km):</strong> <?= $_SESSION['pesanan']['jarak'] ?> km</div>
						<div><strong>Total:</strong> Rp<?= number_format($_SESSION['pesanan']['total'], 0, ",", ".") ?>,-</div>

						<form action="index.php" method="post" class="mt-3">
							<button type="submit" name="HapusData" class="btn btn-danger btn-submit">Hapus Data</button>
						</form>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</body>

</html>