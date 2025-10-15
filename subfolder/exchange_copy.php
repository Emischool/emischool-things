<?php
$currencies = [
    'EUR' => 'Euro',
    'USD' => 'Dollar Amerikan',
    'CAD' => 'Dollar Kanadez',
    'AUD' => 'Dollar Australian',
    'NZD' => 'Dollar Zelanda e Re',
    'GBP' => 'Pound Britanik',
    'CHF' => 'Franga Zviceriane',
    'SEK' => 'Korona Suedeze',
    'DKK' => 'Korona Daneze',
    'NOK' => 'Korona Norvegjeze',
    'JPY' => 'Jen Japonez',
    'CNY' => 'Yan Kinez',
    'TRY' => 'Lira Turke',
    'HUF' => 'Forint Hungarez'
];

$result = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = floatval($_POST['amount']);
    $from = $_POST['from'];
    $to = $_POST['to'];

    $url = "https://api.exchangerate.host/convert?from=$from&to=$to&amount=$amount";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data && isset($data['result'])) {
        $converted = number_format($data['result'], 2);
        $result = "$amount $from = $converted $to";
    } else {
        $result = "Gabim gjatë konvertimit.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Këmbimi Valutor</title>
</head>
<body>
    <h2>Këmbimi Valutor</h2>
    <form method="POST">
        Shuma: <input type="number" step="0.01" name="amount" required><br><br>
        Nga:
        <select name="from">
            <?php foreach ($currencies as $code => $name): ?>
                <option value="<?= $code ?>"><?= "$code - $name" ?></option>
            <?php endforeach; ?>
        </select><br><br>
        Në:
        <select name="to">
            <?php foreach ($currencies as $code => $name): ?>
                <option value="<?= $code ?>"><?= "$code - $name" ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="Konverto">
    </form>

    <h3>Rezultati:</h3>
    <p><?= $result ?></p>
</body>
</html>
