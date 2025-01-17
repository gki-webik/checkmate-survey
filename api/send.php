<?php
$dbo = 'mysql:host=localhost;dbname=webik;charset=utf8mb4';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dbo, 'root', "W0qdqPwl4QcVhNtT", $options);

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $post_name = $data['name'] ?? 'Не указано';
    $post_telephone = $data['telephone'] ?? 'Не указано';
    $post_email = $data['email'] ?? 'Не указано';
    $post_data = json_encode($data['questions']);
    $post_date = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("INSERT INTO answers (name, telephone, email, data, date) VALUES (:name, :telephone, :email, :data, :date)");
    $stmt->execute([
        ':name' => $post_name,
        ':telephone' => $post_telephone,
        ':email' => $post_email,
        ':data' => $post_data,
        ':date' => $post_date,
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Данные успешно сохранены.']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Ошибка: ' . $e->getMessage()]);
}
?>