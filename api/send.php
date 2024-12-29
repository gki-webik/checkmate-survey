<?php
try {
    $pdo = new PDO('sqlite:checkmate_db.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec("CREATE TABLE IF NOT EXISTS answers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR NOT NULL,
        telephone VARCHAR NOT NULL UNIQUE,
        email VARCHAR NOT NULL UNIQUE,
        data TEXT NOT NULL,
        date VARCHAR NOT NULL
    )");

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