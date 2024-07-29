<?php
    require "./public/function.php";
?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
    <title>GOMART</title>
    <link rel="stylesheet" href="./dist/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
        html {
    scroll-behavior: smooth;
    }
    </style>
</head>
<body class="font-nunito dark:bg-slate-800 dark:text-slate-200">
    <!-- NAVBAR -->
    <nav class=" shadow-lg border border-slate-300 rounded-2xl m-3 hover:border-sky-500 dark:border-slate-700 dark:bg-slate-700 dark:shadow-sm dark:shadow-slate-700 dark:hover:border-slate-500">
    <h2 class="text-3xl text-center text-sky-700 mb-6 font-black pt-4 dark:text-slate-200">Analisis Sistem Antrian <span class=" text-sky-500">GOMART</span></h2>
    </nav>
    <!-- END NAVBAR -->

    <!-- TOGGLE -->
    <div class="flex justify-end m-5 ">
        <span class="text-sm text-slate-500 mr-2 font-bold dark:text-slate-200">Light</span>
        <input type="checkbox" id="toggle" class="hidden">
        <label for="toggle">
            <div class="w-9 h-5 bg-slate-500 rounded-full flex items-center p-1 cursor-pointer dark:shadow-sm dark:shadow-slate-500">
                <div class=" w-4 h-4 bg-white rounded-full toggle-circle"></div>
            </div>
        </label>
        <span class="text-sm text-slate-500 ml-2 font-bold dark:text-slate-200">Dark</span>
    </div>
    <!-- END TOGGLE -->

    <!-- KETERANGAN -->
    <div class=" max-w-full mx-10 border bg-sky-500 text-white p-4 rounded-lg shadow-lg dark:bg-gray-600 dark:border-slate-400">
        <p class=" font-bold text-lg mb-3">Keterangan</p>
        <p class=" mb-1"><span class=" font-bold">λ (Lambda) :</span> Jumlah Rata-rata Pelanggan yang Datang per Satuan Waktu</p>
        <p class=" mb-2"><span class=" font-bold">µ (mu) :</span> Jumlah Rata-rata Pelanggan yang Dilayani per Satuan Waktu</p>
        <p class=" mb-2"><span class=" font-bold">s (Kasir) :</span> Jumlah Fasilitas Layanan</p>
    </div>
    <!-- END KETERANGAN -->

    <!-- FORM INPUT -->
    <div class="container mx-auto max-w-full">
        <?php
        if(isset($_POST["submit"])) {?>  
            <div class=" max-w-xl my-6 bg-white border border-gray-500 hover:border-sky-500 rounded-xl mx-auto p-5 font-nunito shadow-lg">
                <form action="" method="post">
                    <label for="lambda" class="block font-semibold mb-4 text-slate-700">
                        <span class="block font-semibold mb-1 text-slate-700">(λ) Lambda / Jam</span>
                        <input type="number" name="lambda" id="lambda" placeholder="Masukkan Lambda" min="0" step="0.1" class=" px-3 py-2 border shadow-md rounded-md w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder: mb-4 dark:text-black" required autocomplete="off" value="<?= $_POST["lambda"] ?>">
                    </label>

                    <label for="mu" class="block font-semibold mb-4 text-slate-700">
                        <span class="block font-semibold mb-1 text-slate-700">(μ) mu / Jam</span>
                        <input type="number" name="mu" id="mu" placeholder="Masukkan Mu" min="0" step="0.1" class=" px-3 py-2 border shadow-md rounded-md w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder: mb-4" required autocomplete="off" value="<?= $_POST["mu"] ?>">
                    </label>

                    <label for="s" class="block font-semibold mb-4 text-slate-700">
                        <span class="block font-semibold mb-1 text-slate-700">(s) Kasir</span>
                        <input type="number" name="s" id="s" placeholder="Masukkan Jumlah Kasir" min="0" class=" px-3 py-2 border shadow-md rounded-md w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder: mb-4" required autocomplete="off" value="<?= $_POST["s"] ?>">
                    </label>

                    <button type="submit" name="submit"  class="my-10 bg-sky-500 px-10 py-1 rounded-lg shadow-lg text-white font font-bold font-nunito block m-auto hover:bg-sky-700 active:bg-sky-900 focus:ring">Hitung</button>
                    
                </form>
            </div>
            <div class="max-w-lg m-auto flex font-bold text-lg text-red-500">
            <a href="index.php#section1" class=" mx-auto py-1">Lihat Hasil</a>
            </div>
        <?php 
        }else{?>
            <div class="max-w-xl my-6 bg-white border border-gray-500 hover:border-sky-500 rounded-xl mx-auto p-5 font-nunito shadow-lg">
                <form action="" method="post">
                    <label for="lambda" class="block font-semibold mb-4 text-slate-700 dark:text-slate-300">
                        <span class="block font-semibold mb-1 text-slate-700">(λ) Lambda / Jam</span>
                        <input type="number" name="lambda" id="lambda" placeholder="Masukkan Lambda" min="0" step="0.1" class=" px-3 py-2 border shadow-md rounded-md w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder: mb-4" required autocomplete="off">
                    </label>

                    <label for="mu" class="block font-semibold mb-4 text-slate-700 dark:text-slate-300">
                        <span class="block font-semibold mb-1 text-slate-700">(μ) mu / Jam</span>
                        <input type="number" name="mu" id="mu" placeholder="Masukkan mu" min="0" step="0.1" class=" px-3 py-2 border shadow-md rounded-md w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder: mb-4" required autocomplete="off">
                    </label>

                    <label for="s" class="block font-semibold mb-4 text-slate-700 dark:text-slate-300">
                        <span class="block font-semibold mb-1 text-slate-700">(s) Kasir</span>
                        <input type="number" name="s" id="s" placeholder="Masukkan Jumlah Kasir" min="0" class=" px-3 py-2 border shadow-md rounded-md w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder: mb-4" required autocomplete="off">
                    </label>

                    <button type="submit" name="submit"  class="my-10 bg-sky-500 px-10 py-1 rounded-lg shadow-lg text-white font font-bold font-nunito block m-auto hover:bg-sky-700 active:bg-sky-900 focus:ring">Hitung</button>
                </form>
            </div>
            <div class=" w-full h-96"></div>
        <?php }?>
        <hr class="my-24 border-t-4">
        <!-- END FORM INPUT -->

        <!-- OUTPUT -->
        <?php
        if(isset($_POST["submit"])){
            $lambda = (float)$_POST['lambda'];
            $mu = (float)$_POST['mu'];
            $s = (int)$_POST['s'];

            if($lambda < 1){
                echo "<script>alert('Invalid! Lambda Tidak Boleh Kurang dari 1')</script>";
                return false;
            }
            if($mu < 1){
                echo "<script>alert('Invalid! Mu Tidak Boleh Kurang dari 1')</script>";
                return false;
            }
            if($s < 1){
                echo "<script>alert('Invalid! s Tidak Boleh Kurang dari 1')</script>";
                return false;
            }

            $sebelum = hitung_parameter_antrian($lambda, $mu, $s);
            if ($sebelum === false) {
                return;
            }
            $optimal_kasir = rekomendasi_kasir_optimal($lambda, $mu, $s);
            $setelah = hitung_parameter_antrian($lambda, $mu, $optimal_kasir);

            // Tampilkan hasil perhitungan sebelum dan sesudah
            ?>
            <section id="section1">
            <div class=" max-w-lg border-2 border-slate-300 m-auto rounded-lg p-2 dark:bg-slate-900"><p class=" text-center font-extrabold text-3xl text-sky-500">Hasil Perhitungan</p></div>

            <div class="max-w-full m-10 border bg-slate-50 text-slate-700 p-4 rounded-lg shadow-lg hover:bg-sky-500 hover:text-slate-200 dark:bg-slate-600 dark:border-slate-400">
            <?php
            if ($sebelum !== false) {?>
                <p class=" font-bold dark:text-slate-200">Jumlah Kasir : <?= $s ?></p>
                <p class=" font-bold dark:text-slate-200">Intensitas Kasir (P) : <?= number_format($sebelum[0] * 100, 2)?> %</p>
                <p class=" font-bold dark:text-slate-200">Peluang Tidak ada Pelanggan (P0) : <?= number_format($sebelum[1] * 100, 2)?> %</p>
                <p class=" font-bold dark:text-slate-200">Jumlah Rata-rata Pelanggan di Dalam Antrian (Lq) : <?= number_format($sebelum[2], 3)?> ≈ <?= number_format($sebelum[2], 0)?> Orang</p>
                <p class=" font-bold dark:text-slate-200">Jumlah Rata-rata Pelanggan di Dalam Sistem (Ls) : <?= number_format($sebelum[3], 3)?> ≈ <?= number_format($sebelum[3], 0)?> Orang</p>
                <p class=" font-bold dark:text-slate-200">Rata-rata Waktu Antri (Wq) : <?= number_format($sebelum[4], 3)?> Jam ≈ <?= number_format($sebelum[4] * 60, 0) ?> Menit</p>
                <p class=" font-bold dark:text-slate-200">Rata-rata Waktu Sistem (Ws) : <?= number_format($sebelum[5], 3)?> Jam ≈ <?= number_format($sebelum[5] * 60, 0) ?> Menit</p>
            </div>
            
            <?php  
            }
            ?>
            <?php
            if ($optimal_kasir == -1) {
                echo "<p>Unable to calculate optimal number of cashiers due to system instability.</p>";
            } else { ?>
                <div class=" max-w-lg border-2 border-slate-300 m-auto rounded-lg p-2 dark:bg-slate-900"><p class=" text-center font-extrabold text-3xl text-sky-500">Hasil Analisis</p></div>
                <div class="max-w-full m-10 border bg-slate-50 text-slate-700 p-4 rounded-lg shadow-lg hover:bg-sky-500 hover:text-white dark:bg-slate-600 dark:border-slate-400">
                    <p class=" font-bold mb-3 text dark:text-slate-200">Rekomendasi Jumlah Kasir : <?= $optimal_kasir?></p>
                <?php
                if ($setelah === false) {
                    echo '<p style="color: red;">Error Jumlah Pelanggan Terlalu Rendah.</p>';
                } else { ?>
                    <p class=" font-bold dark:text-slate-200">Intensitas Kasir (P) : <?= number_format($setelah[0] * 100, 2) ?> %</p>
                    <p class=" font-bold dark:text-slate-200">Peluang Tidak ada Pelanggan (P0) : <?= number_format($setelah[1] * 100, 2)?> %</p>
                    <p class=" font-bold dark:text-slate-200">Jumlah Rata-rata Pelanggan di Dalam Antrian (Lq) : <?= number_format($setelah[2], 3)?> ≈ <?= number_format($setelah[2], 0)?> Orang</p>
                    <p class=" font-bold dark:text-slate-200">Jumlah Rata-rata Pelanggan di Dalam Sistem (Ls) : <?= number_format($setelah[3], 3)?> ≈ <?= number_format($setelah[3], 0)?> Orang</p>
                    <p class=" font-bold dark:text-slate-200">Rata-rata Waktu Antri (Wq) : <?= number_format($setelah[4], 3)?> Jam ≈ <?= number_format($setelah[4] * 60, 0) ?> Menit</p>
                    <p class=" font-bold dark:text-slate-200">Rata-rata Waktu Sistem (Ws) : <?= number_format($setelah[5], 3)?> Jam ≈ <?= number_format($setelah[5] * 60, 0) ?> Menit</p>
                </div>
                <div class="max-w-lg m-auto flex font-bold text-lg text-red-500 mb-6">
                <a href="#" class=" mx-auto py-1">Kembali</a>
                </div>
                </section>
                <?php
                }   
                // END OUTPUT
            }
        }
            ?>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const checkbox = document.querySelector('#toggle');
        const html = document.querySelector('html');
        const currentTheme = localStorage.getItem('theme');

        // Set the theme based on localStorage
        if (currentTheme === 'dark') {
            html.classList.add('dark');
            checkbox.checked = true;
        } else {
            html.classList.remove('dark');
            checkbox.checked = false;
        }

        // Add event listener to toggle the theme
        checkbox.addEventListener('click', function () {
            if (checkbox.checked) {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        });
    });
</script>

</body>
</html>
