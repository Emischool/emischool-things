<?php
// Merr input nga tastiera (në terminal)
$v = (float)readline("Voltazhi (V): ");
$k = (float)readline("Koeficienti: ");

// Llogarit rezultatin
$r = round($v * $k, 2);

// Shfaq rezultatin
echo "Voltazhi: $v V\n";
echo "Koeficienti: $k\n";
echo "Rezultati: $r V\n";
?>