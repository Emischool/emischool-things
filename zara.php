<?php
// Hedhja e zarit për lojtarin 1 dhe lojtarin 2
$lojtari1 = rand(1, 6);
$lojtari2 = rand(1, 6);

// Shfaq vlerat e hedhura
echo "Lojtari 1 hodhi: $lojtari1 \n";
echo "Lojtari 2 hodhi: $lojtari2 \n";

// Krahasimi me if-else
if ($lojtari1 > $lojtari2) {
    echo "Lojtari 1 fiton lojen!";
} else
if ($lojtari2 > $lojtari1) {
    echo "Lojtari 2 fiton lojen!";
} else {
    echo "Dy lojtaret jane barazim!";
}
?>
