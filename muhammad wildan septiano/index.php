<?php
// Instruksi Kerja Nomor 1.
$kendaraan = ["Sedan", "Minivan", "Minibus", "Sepeda Motor", "Pickup"];
sort($kendaraan);

function hitung_sewa($biaya_platform, $jarak, $biaya_per_km)
{
	$nilai_sewa = $biaya_platform + ($jarak * $biaya_per_km);
	return $nilai_sewa;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pemesanan Taxi Online</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			background-color: #f8f9fa;
		}

		.container-border {
			border: 1px solid #ced4da;
			border-radius: 8px;
			padding: 20px;
			margin-top: 20px;
		}

		img {
			margin-left: 10px;
		}

		.btn-submit {
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<div class="container container-border">
		<h3>Pemesanan Taxi Online</h3>
		<img src="logo.jpg" alt="Taxi Online Logo" width="70">

		<form action="index.php" method="post" id="formPemesanan">
			<div class="form-group row">
				<label for="nama" class="col-lg-2 col-form-label">Nama Pelanggan:</label>
				<div class="col-lg-4">
					<input type="text" class="form-control" id="nama" name="nama" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="noHP" class="col-lg-2 col-form-label">Nomor HP:</label>
				<div class="col-lg-4">
					<input type="text" class="form-control" id="noHP" name="noHP" maxlength="16" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="kendaraan" class="col-lg-2 col-form-label">Jenis Kendaraan:</label>
				<div class="col-lg-4">
					<select class="form-control" id="kendaraan" name="kendaraan" required>
						<option value="" disabled selected>- Pilih jenis kendaraan -</option>
						<?php
						foreach ($kendaraan as $jenis) {
							echo '<option value="' . $jenis . '">' . $jenis . '</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="jarak" class="col-lg-2 col-form-label">Jarak (km):</label>
				<div class="col-lg-4">
					<input type="number" class="form-control" id="jarak" name="jarak" maxlength="4" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-2">
					<button class="btn btn-primary btn-submit" type="submit" form="formPemesanan" value="Pesan" name="Pesan">Pesan</button>
				</div>
			</div>
		</form>
	</div>

	<?php
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

		$biaya_sewa = hitung_sewa($biaya_platform, $jarak_tempuh, $biaya_per_km);

		$berkas = "data.json";
		$dataJson = json_encode($dataPesanan, JSON_PRETTY_PRINT);
		file_put_contents($berkas, $dataJson);

		echo "
        <div class='container container-border'>
            <div class='row'>
                <div class='col-lg-2'><strong>Nama Pelanggan:</strong></div>
                <div class='col-lg-4'>" . $dataPesanan['nama'] . "</div>
            </div>
            <div class='row'>
                <div class='col-lg-2'><strong>Nomor HP:</strong></div>
                <div class='col-lg-4'>" . $dataPesanan['noHP'] . "</div>
            </div>
            <div class='row'>
                <div class='col-lg-2'><strong>Jenis Kendaraan:</strong></div>
                <div class='col-lg-4'>" . $dataPesanan['kendaraan'] . "</div>
            </div>
            <div class='row'>
                <div class='col-lg-2'><strong>Jarak (km):</strong></div>
                <div class='col-lg-4'>" . $dataPesanan['jarak'] . " km</div>
            </div>
            <div class='row'>
                <div class='col-lg-2'><strong>Total:</strong></div>
                <div class='col-lg-4'>Rp" . number_format($biaya_sewa, 0, ",", ".") . ",-</div>
            </div>
        </div>";
	}
	?>
</body>

</html>