<?php

// Instruksi Kerja Nomor 1.
// Variabel $kendaraan berisi data jenis kendaraan yang dipesan dalam bentuk array satu dimensi.
$kendaraan = ["Sedan", "Minivan", "Minibus", "Sepeda Motor", "Pickup",];

// Instruksi Kerja Nomor 2.
// Mengurutkan array $kendaraan secara Ascending.
sort($kendaraan);

// Instruksi Kerja Nomor 6.
// Membuat fungsi untuk menghitung biaya sewa taxi
function hitung_sewa($biaya_platform, $jarak, $biaya_per_km)
{
	$nilai_sewa = $biaya_platform + ($jarak * $biaya_per_km);
	return $nilai_sewa;
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>Pemesanan Taxi Online</title>
	<!-- Instruksi Kerja Nomor 4. -->
	<!-- Menghubungkan dengan library/berkas CSS. -->
	<link rel="stylesheet" href="bootstrap.css">
</head>

<body>
	<div class="container border">
		<!-- Menampilkan judul halaman -->
		<h3>Pemesanan Taxi Online</h3>

		<!-- Instruksi Kerja Nomor 5. -->
		<!-- Menampilkan logo Taxi Online -->
		<img src="logo.jpg" alt="" width="70">


		<!-- Form untuk memasukkan data pemesanan. -->
		<form action="index.php" method="post" id="formPemesanan">
			<div class="row">
				<!-- Masukan data nama pelanggan. Tipe data text. -->
				<div class="col-lg-2"><label for="nama">Nama Pelanggan:</label></div>
				<div class="col-lg-2"><input type="text" id="nama" name="nama"></div>
			</div>
			<div class="row">
				<!-- Masukan data nomor HP pelanggan. Tipe data number. -->
				<div class="col-lg-2"><label for="noHP">Nomor HP:</label></div>
				<div class="col-lg-2"><input type="text" id="noHP" name="noHP" maxlength="16"></div>
			</div>
			<div class="row">
				<!-- Masukan pilihan jenis kendaraan. -->
				<div class="col-lg-2"><label for="kendaraan">Jenis Kendaraan:</label></div>
				<div class="col-lg-2">
					<select id="kendaraan" name="kendaraan">
						<option value="kendaraan">- Jenis kendaraan -</option>
						<?php
						// Instruksi Kerja Nomor 3.
						// Menampilkan dropdown pilihan jenis kendaraan berdasarkan data pada array $kendaraan menggunakan perulangan.
						foreach ($kendaraan as $jenis) {
							echo '<option value="' . $jenis . '">' . $jenis . '</option>';
						}
						?>
					</select>
				</div>
			</div>

			<div class="row">
				<!-- Masukan data Jarak Tempuh. Tipe data number. -->
				<div class="col-lg-2"><label for="jarak">Jarak:</label></div>
				<div class="col-lg-2"><input type="number" id="jarak" name="jarak" maxlength="4"></div>
			</div>
			<div class="row">
				<!-- Tombol Submit -->
				<div class="col-lg-2"><button class="btn btn-primary" type="submit" form="formPemesanan" value="Pesan" name="Pesan">Pesan</button></div>
				<div class="col-lg-2"></div>
			</div>
		</form>
	</div>
	<?php

	if (isset($_POST['Pesan'])) {

		// Variabel $dataPesanan berisi data-data pemesanan dari form dalam bentuk array.
		$dataPesanan = [
			'nama' => $_POST['nama'],
			'noHP' => $_POST['noHP'],
			'kendaraan' => $_POST['kendaraan'],
			'jarak' => $_POST['jarak']
		];

		// Instruksi Kerja Nomor 7
		// Simpan jarak yang telah dimasukkan oleh pengguna dalam variabel $jarak_tempuh
		$jarak_tempuh = $dataPesanan['jarak'];

		// Instruksi Kerja Nomor 8 (Percabangan)
		// Gunakan pencabangan untuk menentukan biaya platform dan biaya sewa per kilometer
		// Simpan biaya platform dan biaya sewa per kilometer dalam variabel $biaya_platform dan $biaya_per_km
		if ($dataPesanan['kendaraan'] == 'Sedan') {
			$biaya_platform = 10000;
			$biaya_per_km = 5000;
		} elseif ($dataPesanan['kendaraan'] == 'Minivan') {
			$biaya_platform = 12000;
			$biaya_per_km = 6000;
		} elseif ($dataPesanan['kendaraan'] == 'Minibus') {
			$biaya_platform = 15000;
			$biaya_per_km = 10000;
		} elseif ($dataPesanan['kendaraan'] == 'Sepeda Motor') {
			$biaya_platform = 5000;
			$biaya_per_km = 3000;
		} elseif ($dataPesanan['kendaraan'] == 'Pickup') {
			$biaya_platform = 15000;
			$biaya_per_km = 8000;
		}

		// Instruksi kerja Nomor 9
		// Gunakan fungsi hitung_sewa untuk menghitung biaya sewa
		$biaya_sewa = hitung_sewa($biaya_platform, $jarak_tempuh, $biaya_per_km);

		// Instruksi Kerja Nomor 10.
		// Simpan data pemesanan yang ke dalam file JSON
		$berkas = "data.json";
		$dataJson = json_encode($dataPesanan, JSON_PRETTY_PRINT);
		file_put_contents($berkas, $dataJson);



		// Menampilkan data pemesanan dan total biaya sewa.
		// KODE DI BAWAH INI TIDAK PERLU DIMODIFIKASI!!!
		echo "
            <br/>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-2'>Nama Pelanggan:</div>
                    <div class='col-lg-2'>" . $dataPesanan['nama'] . "</div>
                </div>
                <div class='row'>
                    <div class='col-lg-2'>Nomor HP:</div>
                    <div class='col-lg-2'>" . $dataPesanan['noHP'] . "</div>
                </div>
                <div class='row'>
                    <div class='col-lg-2'>Jenis Kendaraan:</div>
                    <div class='col-lg-2'>" . $dataPesanan['kendaraan'] . "</div>
                </div>
                <div class='row'>
                    <div class='col-lg-2'>Jarak(km):</div>
                    <div class='col-lg-2'>" . $dataPesanan['jarak'] . " km</div>
                </div>
                <div class='row'>
                    <div class='col-lg-2'>Total:</div>
                    <div class='col-lg-2'>Rp" . number_format($biaya_sewa, 0, ",", ".") . ",-</div>
                </div>
            </div>";
	}
	?>
</body>

</html>