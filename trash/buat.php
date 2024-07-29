<?php
    function faktorial($n){
        if($n == 0){
            return 1;
        }
        $fakta = 1;
        for($i=1; $i<=$n; $i++){
            $fakta *= $n;
        }
        return $fakta;
    }

    function hitung_parameter_antrian($lambda, $mu, $s){
        $P = $lambda / ($s * $mu);
        //cek jika P melebihi 1 atau 100%
        if($P >= 1){
            echo "Intensitas melebihi 100%";
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

    function rekomendasi_kasir_optimal($lambda, $mu, $s){
        list($P, $P0, $Lq, $Ls, $Wq, $Ws) = hitung_parameter_antrian($lambda, $mu, $s);

        //cek intensitas | tidak boleh lebih dari 80% atau antrian > 5 menit
        $waktu_antri = $Wq * 60;
        while($P >= 0.8 || $waktu_antri > 5){
            list($P, $P0, $Lq, $Ls, $Wq, $Ws) = hitung_parameter_antrian($lambda, $mu, $s);
            $waktu_antri = $Wq * 60;
            $s++;
        }
        while($P <= 0.5){
            list($P, $P0, $Lq, $Ls, $Wq, $Ws) = hitung_parameter_antrian($lambda, $mu, $s);
            $waktu_antri = $Wq * 60;
            $s--;
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
        <button type="submit" name="">Calculate</button>
    </form>
    <?php
    if(isset($_POST["submit"])){
        $lambda = ($_POST['lambda']);
        $mu = ($_POST['mu']);
        $s = ($_POST['s']);

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
            $sebelum = hitung_parameter_antrian($lambda, $mu, $s);
            $optimal_kasir = rekomendasi_kasir_optimal($lambda, $mu, $s);
            $setelah = hitung_parameter_antrian($lambda, $mu, $optimal_kasir);
    
            // Tampilkan hasil perhitungan sebelum dan sesudah
            echo "<h3>Before Adding Cashiers</h3>";
            echo "Intensity (P): " . number_format($sebelum[0], 4) . "<br>";
            echo "Probability of no customers (P0): " . number_format($sebelum[1], 4) . "<br>";
            echo "Average number of customers in queue (Lq): " . number_format($sebelum[2], 4) . "<br>";
            echo "Average number of customers in system (Ls): " . number_format($sebelum[3], 4) . "<br>";
            echo "Average time a customer spends in queue (Wq): " . number_format($sebelum[4], 4) . " hours<br>";
            echo "Average time a customer spends in system (Ws): " . number_format($sebelum[5], 4) . " hours<br>";
    
            echo "<h3>After Adding Cashiers</h3>";
            if ($optimal_kasir == -1) {
                echo "Unable to calculate optimal number of cashiers due to system instability.";
            } else {
                echo "Optimal number of cashiers: " . $optimal_kasir . "<br>";
                if (is_null($setelah[0])) {
                    echo "System is unstable after adding cashiers.<br>";
                } else {
                    echo "Intensity (rho): " . number_format($setelah[0], 4) . "<br>";
                    echo "Probability of no customers (P0): " . number_format($setelah[1], 4) . "<br>";
                    echo "Average number of customers in queue (Lq): " . number_format($setelah[2], 4) . "<br>";
                    echo "Average number of customers in system (Ls): " . number_format($setelah[3], 4) . "<br>";
                    echo "Average time a customer spends in queue (Wq): " . number_format($setelah[4], 4) . " hours<br>";
                    echo "Average time a customer spends in system (Ws): " . number_format($setelah[5], 4) . " hours<br>";
                }
            }
        }

        



    }?>
</body>
</html>