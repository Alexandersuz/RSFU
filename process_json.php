<?php
header('Content-Type: application/json');

// Получаем JSON из POST-запроса
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Проверяем, есть ли заказы
if (isset($data['orderItems']) && is_array($data['orderItems'])) {
    $result = []; // Массив для хранения результатов

    // Обрабатываем каждый элемент заказа
    foreach ($data['orderItems'] as $item) {
        // Проверяем и форматируем значения
        $dateIssued = $item['dateIssued'] ?? null; // Дата отказа
        
        // Форматируем даты для отображения
        $orderDate = date('d.m.Y, H:i', (int)($item['date'] / 1000)); // Дата заказа
        $issuedDate = $dateIssued ? date('d.m.Y, H:i', (int)($dateIssued / 1000)) : 'нет информации'; // Дата отказа или сообщение о ее отсутствии
        
        // Извлекаем изображение продукта
        $productImage = $item['productImage']['photo']['240']['high'] ?? '';

        // Собираем данные для строки таблицы
        $result[] = [
            'Статус' => $item['status'], // Статус заказа
            'Дата заказа' => $orderDate, // Форматированная дата заказа
            'Номер заказа' => $item['orderId'], // Номер заказа
            'SKU' => $item['skuTitle'], // SKU товара
            'ID продукта' => $item['productId'], // ID продукта
            'Фото продукта' => $productImage, // Ссылка на изображение продукта
            'ID магазина' => $item['shopId'], // ID магазина
            'Дата отказа' => $issuedDate, // Форматированная дата отказа
            'Цена продажи' => $item['sellPrice'], // Цена продажи
            'Себестоимость' => $item['purchasePrice'], // Себестоимость
            'Наименование товара' => $item['productTitle'], // Наименование товара
            'Причина возврата' => $item['returnCause'], // Причина возврата
            'Комментарий' => $item['comment'] ?? 'нет информации', // Комментарий или сообщение об отсутствии
        ];
    }

    // Получаем общее количество возвратов
    $totalElements = $data['totalElements'] ?? 0;

    // Формируем ответ
    $response = [
        'items' => $result, // Список обработанных заказов
        'totalElements' => $totalElements // Общее количество возвратов
    ];

    // Возвращаем ответ в формате JSON
    echo json_encode($response);
} else {
    // Если нет заказов, возвращаем сообщение об ошибке
    echo json_encode(['error' => 'No order items found']);
}
?>
