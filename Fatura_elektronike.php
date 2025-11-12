<?php
echo "Voltazhi: ";
$voltazhi = floatval(trim(fgets(STDIN)));
echo "Koeficienti: ";
$koeficienti = floatval(trim(fgets(STDIN)));
$rezultati = $voltazhi * $koeficienti;

echo "\n--- Fatura Elektronike ---\n";
echo "Voltazhi: $voltazhi V\n";
echo "Koeficienti për voltazhin: $koeficienti\n";
echo "Rezultati: " . round($rezultati, 2) . "\n";
?>