<?php
// Funksioni për të kthyer një shumë nga një monedhë në tjetrën
function exchange($shuma, $nga, $ne) {
    // Kurset e këmbimit (shembull)
    $kurset = [
        'EUR' => ['LEK' => 120, 'USD' => 1.1],
        'LEK' => ['EUR' => 0.0083, 'USD' => 0.0092],
        'USD' => ['EUR' => 0.91, 'LEK' => 109]
    ];

    if (isset($kurset[$nga][$ne])) {
        return $shuma * $kurset[$nga][$ne];
    } else {
        return "Kurs këmbimi i panjohur!";
    }
}

// Shembull përdorimi
$shuma = 100; // Shuma për të kthyer
$nga = 'EUR'; // Monedha fillestare
$ne = 'LEK'; // Monedha e synuar

$rezultati = exchange($shuma, $nga, $ne);

if (is_numeric($rezultati)) {
    echo "$shuma $nga është e barabartë me $rezultati $ne";
} else {
    echo $rezultati;
}
?>