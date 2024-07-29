<?php
    function faktorial($n){
        if($n == 0){
            return 1;
        }
        $fakta = 1;
        for($i=1; $i<=$n; $i++){
            $fakta *= $i;
        }
        return $fakta;
    }

    function hitung_parameter_antrian($lambda, $mu, $s){
        $P = (float)$lambda / ($s * $mu);
        //cek jika P melebihi 1 atau 100%
        // if($P >= 1){
        //     echo "Intensitas melebihi 100%";
        //     return false;
        // }

        if (1 - $P == 0) {
            echo "Error: Pembagian dengan nol pada (1 - P).<br>";
            return false;
        }

        $hasil_terminasi = 0;
        for ($n = 0; $n < $s; $n++) {
            $hasil_terminasi += pow($lambda / $mu, $n) / faktorial($n);
        }
        $hasil_terminasi_2 = pow($lambda / $mu, $s) / (faktorial($s) * (1 - $P));
        $P0 = 1 / ($hasil_terminasi + $hasil_terminasi_2);
        $Lq = ($P0 * pow($lambda / $mu, $s) * $P) / (faktorial($s) * pow(1 - $P, 2));
        $Ls = $Lq + ($lambda / $mu);
        $Wq = $Lq / $lambda;
        $Ws = $Wq + (1 / $mu);
        return [$P, $P0, $Lq, $Ls, $Wq, $Ws];
    }

    function rekomendasi_kasir_optimal($lambda, $mu, $s) {
        $params = hitung_parameter_antrian($lambda, $mu, $s);
        if ($params === false) {
            return -1;
        }
        list($P, $P0, $Lq, $Ls, $Wq, $Ws) = $params;
    
        // Cek intensitas | tidak boleh lebih dari 80% atau antrian > 5 menit
        while ($P >= 0.8) {
            $s++;
            $params = hitung_parameter_antrian($lambda, $mu, $s);
            if ($params === false) {
                return $s +=1;
            }
            list($P, $P0, $Lq, $Ls, $Wq, $Ws) = $params;
        }
    
        while ($P <= 0.5 && $s > 1) {
            $s--;
            $params = hitung_parameter_antrian($lambda, $mu, $s);
            if ($params === false) {
                return -1;
            }
            list($P, $P0, $Lq, $Ls, $Wq, $Ws) = $params;
        }
        return $s;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Queue System Analysis</title>
</head>
<body>
    <h2>Queue System Analysis</h2>
    <form method="post" action="">
        <label for="lambda">Lambda (rata-rata kedatangan pelanggan):</label><br>
        <input type="text" id="lambda" name="lambda"><br>
        <label for="mu">Mu (service rate):</label><br>
        <input type="text" id="mu" name="mu"><br>
        <label for="s">Number of servers (s):</label><br>
        <input type="text" id="s" name="s"><br><br>
        <button type="submit" name="submit">Calculate</button>
    </form>
    <?php
    if(isset($_POST["submit"])){
        $lambda = (float)$_POST['lambda'];
        $mu = (float)$_POST['mu'];
        $s = (int)$_POST['s'];

        if($lambda <= 0){
            echo "<script>alert('Invalid! Lambda Tidak Boleh Kurang dari NOL')</script>";
            return false;
        }
        if($mu <= 0){
            echo "<script>alert('Invalid! Mu Tidak Boleh Kurang dari NOL')</script>";
            return false;
        }
        if($s <= 0){
            echo "<script>alert('Invalid! s Tidak Boleh Kurang dari NOL')</script>";
            return false;
        }

        $sebelum = hitung_parameter_antrian($lambda, $mu, $s);
        if ($sebelum === false) {
            echo "INVALID<br>";
            return;
        }
        $optimal_kasir = rekomendasi_kasir_optimal($lambda, $mu, $s);
        $setelah = hitung_parameter_antrian($lambda, $mu, $optimal_kasir);

        // Tampilkan hasil perhitungan sebelum dan sesudah
        echo "<h3>Sebelum Penambahan Fasililtas Layanan</h3>";
        echo "Intensitas Karyawan (P): " . number_format($sebelum[0], 4) . "<br>";
        echo "Peluang Tidak ada Pelanggan (P0): " . number_format($sebelum[1], 4) . "<br>";
        echo "Rata-rata Pelanggan di Dalam Antrian (Lq): " . number_format($sebelum[2], 4) . "<br>";
        echo "Rata-rata Pelanggan di Dalam Sistem (Ls): " . number_format($sebelum[3], 4) . "<br>";
        echo "Rata-rata Waktu Antri (Wq): " . number_format($sebelum[4], 4) . " hours<br>";
        echo "Rata-rata Waktu Sistem (Ws): " . number_format($sebelum[5], 4) . " hours<br>";

        echo "<h3>Hasil Analisis</h3>";

        echo "Rekomendasi Jumlah Kasir:" . $optimal_kasir . "<br><br>";
        if ($setelah === false) {
            echo "INVALID<br>";
            return;
        } else {
            echo "Intensitas Karyawan (P): " . number_format($setelah[0], 4) . "<br>";
        echo "Peluang Tidak ada Pelanggan (P0): " . number_format($setelah[1], 4) . "<br>";
        echo "Rata-rata Pelanggan di Dalam Antrian (Lq): " . number_format($setelah[2], 4) . "<br>";
        echo "Rata-rata Pelanggan di Dalam Sistem (Ls): " . number_format($setelah[3], 4) . "<br>";
        echo "Rata-rata Waktu Antri (Wq): " . number_format($setelah[4], 4) . " hours<br>";
        echo "Rata-rata Waktu Sistem (Ws): " . number_format($setelah[5], 4) . " hours<br>";
        }
    }
    ?>
</body>
</html>
