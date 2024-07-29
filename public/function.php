<?php
    function faktorial($n){
        if($n == 0){
            return 1;
        }
        $fakta = 1;
        for($i=1; $i<=$n; $i++){
            $fakta *= $i; // Diperbaiki $n menjadi $i
        }
        return $fakta;
    }

    function hitung_parameter_antrian($lambda, $mu, $s){
        $P = $lambda / ($s * $mu);
        //cek jika P melebihi 1 atau 100%
        if($P >= 1){
            echo "<script> alert('Error | Intensitas Melebihi 100% Mohon untuk Melakukan Penambahan Kasir Terlebih Dahulu!');
                document.location.href = 'index.php';
                </script>;";
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
            $s++;
            list($P, $P0, $Lq, $Ls, $Wq, $Ws) = hitung_parameter_antrian($lambda, $mu, $s);
            $waktu_antri = $Wq * 60;
        }

        // Tambahan: hindari loop jika $s berkurang di bawah 1
        while($P <= 0.5 && $s > 1){
            $s--;
            list($P, $P0, $Lq, $Ls, $Wq, $Ws) = hitung_parameter_antrian($lambda, $mu, $s);
            $waktu_antri = $Wq * 60;
        }
        return $s;
    }
?>