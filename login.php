<?php
header('Content-Type: application/json');

// Datos de conexión obtenidos de tu captura de MonsterASP
$host     = 'db45754.databaseasp.net'; 
$db       = 'db45754';
$user     = 'db45754';
$password = '7k%N#Wr29s_J'; 
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=3306";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (\PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Error de conexión al servidor de base de datos."
    ]);
    exit;
}

$alias = isset($_GET['alias']) ? trim($_GET['alias']) : '';
$clave = isset($_GET['clave']) ? trim($_GET['clave']) : '';

if (empty($alias) || empty($clave)) {
    echo json_encode([
        "status" => "error",
        "message" => "Por favor, ingresa el alias y la clave."
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE alias = ? AND clave = ?');
    $stmt->execute([$alias, $clave]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        echo json_encode([
            "status" => "success",
            "message" => "Acceso concedido. ¡Bienvenido " . $usuario['alias'] . "!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "El alias o la clave son incorrectos."
        ]);
    }
} catch (\PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Error al realizar la consulta en la base de datos."
    ]);
}
exit;
?>
