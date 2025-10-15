<?php
echo"Sheno çmimin e produktit: ";
$cmimi = readline();

$zbritje = readline("Sheno vleren e zbritjes");

if ($zbritje > 0) {
    $cmimi_final = $cmimi - $zbritje;
    echo "Çmimi me zbritje është: $cmimi_final EUR";
} else {
    echo "Nuk ka zbritje. Çmimi është: $cmimi EUR";
}
?>
