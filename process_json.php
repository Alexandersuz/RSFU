<?php
header('Content-Type: application/json');

// Получаем JSON из POST-запроса
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Проверяем, есть ли заказы
if (isset($data['orderItems']) && is_array($data['orderItems'])) {
    $result = [];

foreach ($data['orderItems'] as $item) {
    // Проверяем значения
    $dateIssued = $item['dateIssued'] ?? null;
    
    // Форматируем даты
    $orderDate = date('d.m.Y, H:i', (int)($item['date'] / 1000));
    $issuedDate = $dateIssued ? date('d.m.Y, H:i', (int)($dateIssued / 1000)) : 'нет информации';
        
        // Извлекаем изображение
        $productImage = $item['productImage']['photo']['240']['high'] ?? '';

        // Собираем данные для строки таблицы
        $result[] = [
            'Статус' => $item['status'],
            'Дата заказа' => $orderDate,
            'Номер заказа' => $item['orderId'],
            'SKU' => $item['skuTitle'],
            'ID продукта' => $item['productId'],
            'Фото продукта' => $productImage,
            'ID магазина' => $item['shopId'],
            'Дата отказа' => $issuedDate,
            'Цена продажи' => $item['sellPrice'],
            'Себес' => $item['purchasePrice'],
            'Наименование товара' => $item['productTitle'],
            'Причина возврата' => $item['returnCause'],
            'Комментарий' => $item['comment'] ?? 'нет информации', // Обработка комментария
        ];
    }

    // Получаем общее количество возвратов
    $totalElements = $data['totalElements'] ?? 0;

    // Формируем ответ
    $response = [
        'items' => $result,
        'totalElements' => $totalElements
    ];

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'No order items found']);
}
?>
