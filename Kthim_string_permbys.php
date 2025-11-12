<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Përmbys me strrev()</title>
</head>
<body>

<form method="post">
    <input type="text" name="tekst" placeholder="Shkruaj këtu..." required>
    <button type="submit">Përmbys</button>
</form>

<?php
if ($_POST['tekst'] ?? false) {
    echo '<hr><strong>' . strrev($_POST['tekst']) . '</strong>';
}
?>
</body>
</html>