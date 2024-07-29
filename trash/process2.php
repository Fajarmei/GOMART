<?php
function factorial($n) {
    if ($n == 0) return 1;
    $fact = 1;
    for ($i = 1; $i <= $n; $i++) {
        $fact *= $i;
    }
    return $fact;
}

function calculate_queue_parameters($lambda, $mu, $s) {
    $rho = $lambda / ($s * $mu);
    
    // Cek jika rho melebihi 1
    if ($rho >= 1) {
        return [null, null, null, null, null, null];
    }
    
    $sum_terms = 0;
    for ($n = 0; $n < $s; $n++) {
        $sum_terms += pow($lambda / $mu, $n) / factorial($n);
    }
    $p0_last_term = pow($lambda / $mu, $s) / (factorial($s) * (1 - $rho));
    $P0 = 1 / ($sum_terms + $p0_last_term);
    $Lq = ($P0 * pow($lambda / $mu, $s) * $rho) / (factorial($s) * pow(1 - $rho, 2));
    $Ls = $Lq + ($lambda / $mu);
    $Wq = $Lq / $lambda;
    $Ws = $Wq + (1 / $mu);
    return [$rho, $P0, $Lq, $Ls, $Wq, $Ws];
}

function optimize_cashiers($lambda, $mu, $s) {
    list($rho, , $Lq, , $Wq, ) = calculate_queue_parameters($lambda, $mu, $s);
    
    if (is_null($rho)) {
        return -1; // Menandakan bahwa jumlah kasir awal terlalu rendah untuk dihitung.
    }
    
    $Wq_minutes = $Wq * 60;
    
    while ($rho >= 0.8 || $Wq_minutes > 5) {
        $s++;
        list($rho, , $Lq, , $Wq, ) = calculate_queue_parameters($lambda, $mu, $s);
        if (is_null($rho)) {
            return -1;
        }
        $Wq_minutes = $Wq * 60;
    }
    return $s;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lambda = floatval($_POST['lambda']);
    $mu = floatval($_POST['mu']);
    $s = intval($_POST['s']);

    $before = calculate_queue_parameters($lambda, $mu, $s);
    $optimal_s = optimize_cashiers($lambda, $mu, $s);
    $after = calculate_queue_parameters($lambda, $mu, $optimal_s);

    // Tampilkan hasil perhitungan sebelum dan sesudah
    echo "<h3>Before Adding Cashiers</h3>";
    if (is_null($before[0])) {
        echo "Initial number of cashiers is too low. System is unstable.<br>";
    } else {
        echo "Intensity (rho): " . number_format($before[0], 4) . "<br>";
        echo "Probability of no customers (P0): " . number_format($before[1], 4) . "<br>";
        echo "Average number of customers in queue (Lq): " . number_format($before[2], 4) . "<br>";
        echo "Average number of customers in system (Ls): " . number_format($before[3], 4) . "<br>";
        echo "Average time a customer spends in queue (Wq): " . number_format($before[4], 4) . " hours<br>";
        echo "Average time a customer spends in system (Ws): " . number_format($before[5], 4) . " hours<br>";
    }

    echo "<h3>After Adding Cashiers</h3>";
    if ($optimal_s == -1) {
        echo "Unable to calculate optimal number of cashiers due to system instability.";
    } else {
        echo "Optimal number of cashiers: " . $optimal_s . "<br>";
        if (is_null($after[0])) {
            echo "System is unstable after adding cashiers.<br>";
        } else {
            echo "Intensity (rho): " . number_format($after[0], 4) . "<br>";
            echo "Probability of no customers (P0): " . number_format($after[1], 4) . "<br>";
            echo "Average number of customers in queue (Lq): " . number_format($after[2], 4) . "<br>";
            echo "Average number of customers in system (Ls): " . number_format($after[3], 4) . "<br>";
            echo "Average time a customer spends in queue (Wq): " . number_format($after[4], 4) . " hours<br>";
            echo "Average time a customer spends in system (Ws): " . number_format($after[5], 4) . " hours<br>";
        }
    }
}
?>
