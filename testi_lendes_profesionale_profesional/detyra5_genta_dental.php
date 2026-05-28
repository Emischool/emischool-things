<?php
session_start();

/* =========================
   STRINGJE & FUNKSIONE
========================= */

function formatoEmrin($emri, $mbiemri) {
    $emri = trim(ucfirst(strtolower($emri)));
    $mbiemri = trim(ucfirst(strtolower($mbiemri)));
    return $emri . " " . $mbiemri;
}

function validoEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function formatoData($data) {
    $muajt = [
        "Janar", "Shkurt", "Mars", "Prill",
        "Maj", "Qershor", "Korrik", "Gusht",
        "Shtator", "Tetor", "Nëntor", "Dhjetor"
    ];

    $ts = strtotime($data);

    return date("d", $ts) . " " .
           $muajt[date("n", $ts)-1] . " " .
           date("Y", $ts);
}

function llogaritMoshen($ditelindja) {
    $sot = new DateTime();
    $lindje = new DateTime($ditelindja);
    return $sot->diff($lindje)->y . " vjeç";
}

function gjenerojKodVizite($id) {
    return "GD-" . date("Ymd") . "-" . str_pad($id, 4, "0", STR_PAD_LEFT);
}

/* =========================
   VEKTORE & MATRICA
========================= */

$sherbimet = [
    "Kontroll",
    "Pastrimi",
    "Plombë",
    "Heqje dhëmbi",
    "Zbardhim"
];

array_push($sherbimet, "Implant");
sort($sherbimet);

$pacientet = [
    ["id" => 1, "emri" => "Andi Bala", "vizita" => 5],
    ["id" => 2, "emri" => "Mira Koci", "vizita" => 3],
    ["id" => 3, "emri" => "Erind Hoxha", "vizita" => 8]
];

usort($pacientet, fn($a, $b) => $b['vizita'] - $a['vizita']);

$aktive = array_filter($pacientet, fn($p) => $p['vizita'] > 4);
$totalVizita = array_sum(array_column($pacientet, 'vizita'));

/* =========================
   SESSION & COOKIE LOGIN
========================= */

$loginMessage = "";

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $perdorues_valid = [
        "admin" => password_hash("Dental@2025", PASSWORD_BCRYPT)
    ];

    if(
        isset($perdorues_valid[$username]) &&
        password_verify($password, $perdorues_valid[$username])
    ) {
        $_SESSION['user'] = $username;
        $_SESSION['roli'] = 'admin';

        if(isset($_POST['remember'])) {
            setcookie(
                'remember_user',
                $username,
                time() + (30 * 24 * 60 * 60)
            );
        }

        $loginMessage = "Hyrja u krye me sukses!";

    } else {
        $loginMessage = "Username ose password gabim!";
    }
}

/* =========================
   VIZITAT
========================= */

if(!isset($_SESSION['vizitat'])) {

    $_SESSION['vizitat'] = [
        [
            'kodi' => 'GD-20250510-0001',
            'pacienti' => 'Andi Bala',
            'sherbimi' => 'Kontroll',
            'data' => '2025-05-10',
            'statusi' => 'Kryer'
        ],
        [
            'kodi' => 'GD-20250515-0002',
            'pacienti' => 'Mira Koci',
            'sherbimi' => 'Pastrimi',
            'data' => '2025-05-15',
            'statusi' => 'Kryer'
        ]
    ];
}

if(isset($_POST['shto_vizite'])) {

    $id = count($_SESSION['vizitat']) + 1;

    $vizita = [
        'kodi' => gjenerojKodVizite($id),
        'pacienti' => $_POST['pacienti'],
        'sherbimi' => $_POST['sherbimi'],
        'data' => $_POST['data'],
        'statusi' => 'Planifikuar'
    ];

    $_SESSION['vizitat'][] = $vizita;
}

if(isset($_GET['fshi'])) {

    $index = $_GET['fshi'];

    if(isset($_SESSION['vizitat'][$index])) {
        unset($_SESSION['vizitat'][$index]);
        $_SESSION['vizitat'] = array_values($_SESSION['vizitat']);
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detyra 5 PHP – Genta Dental</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f4f6f9;
    color:#333;
}

header{
    background:#1e293b;
    color:white;
    padding:20px;
}

header h1{
    margin-bottom:8px;
}

.container{
    width:95%;
    max-width:1200px;
    margin:30px auto;
}

.card{
    background:white;
    padding:25px;
    border-radius:10px;
    margin-bottom:25px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

h2{
    margin-bottom:15px;
    color:#1e293b;
}

p{
    line-height:1.7;
}

ul{
    padding-left:20px;
}

li{
    margin-bottom:10px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th, td{
    border:1px solid #ddd;
    padding:12px;
    text-align:left;
}

th{
    background:#1e293b;
    color:white;
}

form{
    margin-top:20px;
}

input, select{
    width:100%;
    padding:10px;
    margin-top:8px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:6px;
}

button{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

.success{
    background:#dcfce7;
    color:#166534;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
}

.error{
    background:#fee2e2;
    color:#991b1b;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
}

.badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:13px;
    font-weight:bold;
}

.kryer{
    background:#dcfce7;
    color:#166534;
}

.plan{
    background:#fef3c7;
    color:#92400e;
}

.delete-btn{
    background:#dc2626;
    text-decoration:none;
    color:white;
    padding:7px 12px;
    border-radius:5px;
}

.delete-btn:hover{
    background:#b91c1c;
}
</style>
</head>
<body>

<header>
    <h1>🖥️ Backend PHP – Menaxhimi i Vizitave</h1>
    <p>Detyra 5 · Klinika Genta Dental</p>
</header>

<div class="container">

    <div class="card">
        <h2>⚙️ Instalimi i XAMPP</h2>

        <ul>
            <li>Shkarko XAMPP nga apachefriends.org</li>
            <li>Instalo Apache + MySQL</li>
            <li>Krijo folderin: xampp/htdocs/genta_dental</li>
            <li>Ruaj këtë file si index.php</li>
            <li>Hap: http://localhost/genta_dental</li>
        </ul>
    </div>

    <div class="card">
        <h2>📝 Stringje & Funksione</h2>

        <p><strong>Formato Emrin:</strong>
            <?php echo formatoEmrin('andi', 'bala'); ?>
        </p>

        <p><strong>Email Valid:</strong>
            <?php echo validoEmail('test@gmail.com') ? 'Po' : 'Jo'; ?>
        </p>

        <p><strong>Data:</strong>
            <?php echo formatoData('2026-05-28'); ?>
        </p>

        <p><strong>Mosha:</strong>
            <?php echo llogaritMoshen('2005-04-10'); ?>
        </p>

        <p><strong>Kodi Vizitës:</strong>
            <?php echo gjenerojKodVizite(7); ?>
        </p>
    </div>

    <div class="card">
        <h2>📊 Vektorë & Matrica</h2>

        <h3>Shërbimet</h3>

        <ul>
            <?php foreach($sherbimet as $s): ?>
                <li><?php echo $s; ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>Pacientët Aktivë</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Emri</th>
                <th>Vizita</th>
            </tr>

            <?php foreach($aktive as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo $p['emri']; ?></td>
                    <td><?php echo $p['vizita']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p style="margin-top:15px;">
            <strong>Total Vizita:</strong>
            <?php echo $totalVizita; ?>
        </p>
    </div>

    <div class="card">
        <h2>🔐 Login me Session & Cookie</h2>

        <?php if($loginMessage): ?>

            <div class="<?php echo strpos($loginMessage, 'sukses') !== false ? 'success' : 'error'; ?>">
                <?php echo $loginMessage; ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>
                <input type="checkbox" name="remember" style="width:auto;">
                Mbaj mend hyrjen
            </label>

            <br><br>

            <button type="submit" name="login">
                Login
            </button>

        </form>

        <br>

        <p>
            <strong>User:</strong> admin
        </p>

        <p>
            <strong>Password:</strong> Dental@2025
        </p>
    </div>

    <div class="card">
        <h2>📅 Menaxhimi i Vizitave</h2>

        <form method="POST">

            <label>Pacienti</label>
            <select name="pacienti">
                <option>Andi Bala</option>
                <option>Mira Koci</option>
                <option>Erind Hoxha</option>
            </select>

            <label>Shërbimi</label>
            <select name="sherbimi">
                <option>Kontroll</option>
                <option>Pastrimi</option>
                <option>Plombë</option>
                <option>Heqje dhëmbi</option>
                <option>Zbardhim</option>
            </select>

            <label>Data</label>
            <input type="date" name="data" required>

            <button type="submit" name="shto_vizite">
                + Regjistro Vizitën
            </button>

        </form>

        <table>
            <tr>
                <th>Kodi</th>
                <th>Pacienti</th>
                <th>Shërbimi</th>
                <th>Data</th>
                <th>Statusi</th>
                <th>Veprimi</th>
            </tr>

            <?php foreach($_SESSION['vizitat'] as $index => $v): ?>
                <tr>
                    <td><?php echo $v['kodi']; ?></td>
                    <td><?php echo $v['pacienti']; ?></td>
                    <td><?php echo $v['sherbimi']; ?></td>
                    <td><?php echo formatoData($v['data']); ?></td>
                    <td>
                        <span class="badge <?php echo $v['statusi'] == 'Kryer' ? 'kryer' : 'plan'; ?>">
                            <?php echo $v['statusi']; ?>
                        </span>
                    </td>
                    <td>
                        <a class="delete-btn" href="?fshi=<?php echo $index; ?>">
                            Fshi
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>

</div>

</body>
</html>