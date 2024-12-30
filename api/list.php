<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept");
header("Content-Security-Policy: default-src 'self'; script-src 'self'; object-src 'none';");

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");

$dbo = 'mysql:host=localhost;dbname=webik;charset=utf8mb4';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dbo, 'root', "W0qdqPwl4QcVhNtT", $options);

    $stmt = $pdo->query("SELECT * FROM answers");
    $answers = $stmt->fetchAll();

    $yesCount = 0;
    $noCount = 0;
    $totalCount = count($answers);

    foreach ($answers as $answer) {
        $questions = json_decode($answer['data'], true);
        foreach ($questions as $question) {
            if (isset($question['answer'])) {
                $answerText = strtolower(trim($question['answer']));
                if ($answerText === 'Да') {
                    $yesCount++;
                } elseif ($answerText === 'Нет') {
                    $noCount++;
                }
            }
        }
    }

    $data = [
        'totalCount' => $totalCount,
        'yesCount' => $yesCount,
        'noCount' => $noCount,
        'answers' => array_map(function ($answer) {
            return [
                'id' => $answer['id'],
                'name' => $answer['name'],
                'telephone' => $answer['telephone'],
                'email' => $answer['email'],
                'date' => $answer['date'],
                'data' => json_decode($answer['data'], true)
            ];
        }, $answers)
    ];

    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}