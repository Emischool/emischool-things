<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Loja me dyer</title>
    <style>
        .dere {
            width: 100px;
            height: 150px;
            margin: 20px;
            background-color: brown;
            display: inline-block;
            text-align: center;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Zgjidh një derë:</h2>
    <form method="post">
        <div class="dere"><button name="zgjedhje" value="1">Dera 1</button></div>
        <div class="dere"><button name="zgjedhje" value="2">Dera 2</button></div>
        <div class="dere"><button name="zgjedhje" value="3">Dera 3</button></div>
    </form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $zgjedhje = $_POST["zgjedhje"];
        switch ($zgjedhje) {
            case "1": echo "<p>🚪 Dhoma me pasqyrë magjike!</p>"; break;
            case "2": echo "<p>📖 Dhoma me libër të lashtë!</p>"; break;
            case "3": echo "<p>💰 Dhoma me thesarin e fshehur!</p>"; break;
            default: echo "<p>Nuk ka dhomë me këtë numër!</p>";
        }
    }
    ?>
</body>
</html>
