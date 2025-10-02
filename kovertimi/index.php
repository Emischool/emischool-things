<?php
$amount = $_POST['amount'];
$from = $_POST['from'];
$to = $_POST['to'];


// Simple hardcoded rates (relative to USD)
$rates = [
'USD' => 1,
'EUR' => 0.9
];


if(isset($rates[$from]) && isset($rates[$to])){
// Convert amount to USD first
$usd = $amount / $rates[$from];
$converted = $usd * $rates[$to];
echo "$amount $from = $converted $to";
} else {
echo "Unsupported currency.";
}
?>