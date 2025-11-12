<?php
function hapat() {
    $hapat = [
        "Vëzhgimi",
        "Pytja",
        "Hipoteza",
        "Eksperimenti",
        "Analiza e të dhënave",
        "Përfundimi",
        "Riprovimi",
        "Raportimi"
    ];
    
    echo "<ol start='1'>";
    foreach ($hapat as $i => $hap) {
        echo "<li>$hap</li>";
    }
    echo "</ol>";
}

hapat(); // Thirrje e thjeshtë
?>