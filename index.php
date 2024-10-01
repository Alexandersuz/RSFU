<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Устанавливаем кодировку страницы -->
    <meta charset="UTF-8">
    <!-- Устанавливаем параметры для адаптивного дизайна -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статусы возвратов с UZUM</title>

    <!-- Подключаем иконки Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Подключаем библиотеку jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Общие стили страницы */
        body {
            background-color: #121212; /* Тёмный фон страницы */
            color: #ffffff; /* Белый цвет текста */
            font-family: Arial, sans-serif; /* Шрифт для текста */
        }

        /* Стили таблицы */
        table {
            width: 100%; /* Ширина таблицы 100% */
            border-collapse: collapse; /* Убираем промежутки между ячейками */
            margin-top: 20px; /* Отступ сверху */
        }

        th, td {
            padding: 10px; /* Отступы внутри ячеек */
            text-align: center; /* Выравнивание текста по центру */
            border: 1px solid #333; /* Тёмные границы ячеек */
        }

        th {
            background-color: #1e1e1e; /* Тёмный фон заголовков */
            color: #ffffff; /* Белый цвет текста заголовков */
        }

        /* Зебра для строк таблицы */
        tr:nth-child(even) {
            background-color: #2a2a2a; /* Тёмный фон для чётных строк */
        }

        /* Эффект при наведении на строку */
        tr:hover {
            background-color: #3c3c3c; /* Фон при наведении на строку */
        }

        /* Стили для форм */
        .form-container {
            background-color: #1e1e1e; /* Тёмный фон формы */
            border-radius: 5px; /* Закругление углов формы */
            padding: 20px; /* Отступы внутри формы */
            margin-top: 20px; /* Отступ сверху */
            width: 600px; /* Ширина формы */
            display: inline-block; /* Размещаем формы рядом */
            margin: 0 10px; /* Отступы по горизонтали между формами */
            height: 330px; /* Фиксированная высота для формы */
            overflow: auto; /* Прокрутка, если содержимое превышает высоту */
        }
        
        .form-header {
            font-size: 18px; /* Размер шрифта заголовка формы */
            margin-bottom: 10px; /* Отступ снизу заголовка */
            text-align: center; /* Центрируем заголовок формы */
        }
                
        .section-container {
            margin-bottom: 20px; /* Отступ между секциями */
            padding: 10px; /* Отступы внутри секции */
            border-radius: 8px; /* Закругление углов секции */
            background-color: #2c2c2c; /* Цвет фона для секций */
        }
        
        #dynamicReasonsContainer,
        #dynamicCommentsContainer {
            margin-top: 10px; /* Отступ сверху */
            padding: 10px; /* Отступы внутри контейнера */
            border-radius: 8px; /* Закругление углов контейнера */
            background-color: #2c2c2c; /* Цвет фона для контейнеров */
            text-align: left; /* Выравнивание текста по левому краю */
        }
        
        .form-wrapper {
            display: flex; /* Используем flexbox для размещения форм */
            justify-content: center; /* Центрируем формы по горизонтали */
            margin-top: 20px; /* Отступ сверху для формы */
            margin-bottom: 20px; /* Отступ снизу для формы */
        }

        /* Стили для текстового поля ввода JSON */
        #jsonInput {
            width: 40%; /* Ширина поля ввода 40% */
            min-height: 150px; /* Минимальная высота поля ввода */
            padding: 10px; /* Отступы внутри поля ввода */
            margin: 20px auto; /* Центрирование поля ввода */
            background-color: #1e1e1e; /* Тёмный фон для поля ввода */
            color: #ffffff; /* Белый цвет текста */
            border: 1px solid #444; /* Темные границы */
            border-radius: 5px; /* Закругление углов */
            display: block; /* Блочный элемент для центрирования */
            resize: vertical; /* Разрешаем изменять размер только по вертикали */
        }

        /* Стили для кнопки отправки */
        #submitButton {
            width: 40%; /* Ширина кнопки равна ширине поля ввода */
            background-color: #007bff; /* Синий фон кнопки */
            color: white; /* Белый цвет текста кнопки */
            padding: 10px 15px; /* Отступы внутри кнопки */
            border: none; /* Без границ */
            border-radius: 5px; /* Закругление углов */
            cursor: pointer; /* Указатель при наведении */
            transition: background-color 0.3s; /* Плавный переход цвета фона */
            margin: 10px auto; /* Центрируем кнопку */
            display: block; /* Блочный элемент для центрирования */
        }

        #submitButton:hover {
            background-color: #0056b3; /* Темнее синий при наведении */
        }

        /* Стили для отображения общего количества возвратов */
        #totalReturns {
            position: absolute; /* Позиционирование относительно окна */
            top: 20px; /* Отступ сверху */
            right: 20px; /* Отступ справа */
            color: white; /* Белый цвет текста */
            font-size: 18px; /* Размер шрифта */
        }

        /* Стили для выпадающего списка выбора количества строк на странице */
        #rowsPerPage {
            background-color: #1e1e1e; /* Темный фон */
            color: #ffffff; /* Белый цвет текста */
            border: 1px solid #444; /* Темные границы */
            border-radius: 5px; /* Закругление углов */
            padding: 10px; /* Отступы внутри */
            margin-left: 10px; /* Отступ слева */
            cursor: pointer; /* Указатель при наведении */
            appearance: none; /* Убираем стандартный стиль */
            -webkit-appearance: none; /* Для Safari */
            -moz-appearance: none; /* Для Firefox */
        }

        /* Стили для блока пагинации */
        #pagination {
            display: flex; /* Используем flexbox для размещения элементов пагинации */
            align-items: center; /* Вертикальное выравнивание по центру */
            justify-content: flex-end; /* Выровнять элементы по правому краю */
            background-color: #2e2e2e; /* Темный фон для пагинации */
            padding: 10px; /* Отступы вокруг */
            border-radius: 5px; /* Закругление углов */
        }

        /* Стили для кнопок пагинации */
        .pagination-button {
            background-color: #007bff; /* Синий фон для кнопок */
            color: white; /* Белый цвет текста кнопок */
            padding: 10px 15px; /* Отступы внутри кнопок */
            border: none; /* Без границ */
            border-radius: 5px; /* Закругление углов */
            cursor: pointer; /* Указатель при наведении */
            margin: 0 5px; /* Отступы между кнопками */
            transition: background-color 0.3s; /* Плавный переход цвета фона */
        }

        .pagination-button:hover {
            background-color: #0056b3; /* Темнее синий при наведении */
        }

        /* Стили для меток */
        label {
            color: #ffffff; /* Белый цвет текста */
        }

        /* Стили для отображения версии */
        .version {
            position: fixed; /* Фиксированное положение для версии */
            bottom: 10px; /* Отступ от низа */
            right: 10px; /* Отступ от правого края */
            font-size: 12px; /* Размер текста для версии */
            color: #666666; /* Цвет текста версии */
            background: rgba(0, 0, 0, 0.8); /* Цвет фона версии */
            padding: 5px 10px; /* Отступы вокруг текста */
            border-radius: 3px; /* Скругление углов */
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.1); /* Тень для блока версии */
            z-index: 1000; /* Уровень слоя для отображения версии над другими элементами */
        }
    </style>
</head>

<body>
<div id="totalReturns" style="display: none;">
    <!-- Скрытый блок для отображения общего количества возвратов -->
    Всего возвратов: <span id="returnsCount"></span>
</div>

<h1>Статусы возвратов с UZUM</h1>

<table id="ordersTable">
    <thead>
        <tr>
            <!-- Заголовки таблицы для отображения информации о возвратах -->
            <th>Статус</th>
            <th>Дата заказа</th>
            <th>Номер заказа</th>
            <th>SKU</th>
            <th>ID продукта</th>
            <th>Фото продукта</th>
            <th>ID магазина</th>
            <th>Дата отказа</th>
            <th>Цена продажи</th>
            <th>Себестоимость</th>
            <th>Наименование товара</th>
            <th>Причина возврата</th>
            <th>Комментарий</th>
        </tr>
    </thead>
    <tbody>
        <!-- Данные будут добавлены здесь через JavaScript -->
    </tbody>
</table>

<div id="pagination" style="text-align: right; margin-top: 20px;">
    <!-- Элементы управления для пагинации -->
    <label for="rowsPerPage" style="color: #ffffff;">Строк на странице:</label>
    <select id="rowsPerPage">
        <option value="5">5</option>
        <option value="10" selected>10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>

    <button id="prevPage" class="pagination-button">Назад</button>
    <span id="currentPage" style="color: #ffffff;">1</span>
    <button id="nextPage" class="pagination-button">Вперед</button>
</div>

<div style="text-align: center;">
    <!-- Поле ввода для JSON и кнопка отправки -->
    <textarea id="jsonInput" rows="10" placeholder="Вставьте JSON здесь..."></textarea>
    <button id="submitButton">Отправить</button>
</div>

<!-- Родительский контейнер для форм -->
<div class="form-wrapper">
    <!-- Первая форма - Общая информация о возвратах -->
    <div class="form-container">
        <div class="form-header">Общая информация о возвратах</div>
        <div class="section-container">
            <div class="form-item">Количество возвратов: <span id="totalReturnsCount">0</span> шт.</div>
        </div>
        <div class="section-container">
            <div class="form-item">Причин возврата: <span id="totalReasonsCount">0</span> шт.</div>
        </div>
        <div class="section-container">
            <div class="form-item">Возвраты по причине:</div>
            <div id="dynamicReasonsContainer"></div>
        </div>
        <div class="section-container">
            <div class="form-item">Комментарии, оставленные в ПВЗ или при отмене товара "онлайн":</div>
            <div id="dynamicCommentsContainer"></div>
        </div>
    </div>

    <!-- Вторая форма - Статистика по причине "Товара не оказалось в заказе" -->
    <div class="form-container">
        <div class="form-header">Статистика по причине: Товара не оказалось в заказе</div>
        <div class="section-container">
            <div class="form-item">Зафиксировано <strong><span id="reasonProductNotFoundTotalCount">0</span> шт.</strong> из-за отсутствия позиций в заказах</div>
        </div>
        <div class="section-container">
            <div class="form-item">Прямые потери составили <strong><span id="lostCostTotal">0</span> сум.</strong> (себестоимость нереализованного товара).</div>
        </div>
        <div class="section-container">
            <div class="form-item">Потенциальная прибыль, упущенная из-за проблемы, оценивается в <strong><span id="potentialRevenueTotal">0</span> сум.</strong> (без учёта комиссии UZUM).</div>
        </div>
    </div>

    <!-- Вывод текущей версии проекта -->
    <div class="version">Версия: <span id="version-number"></span></div>
</div>

<script>
    // Ждем полной загрузки DOM перед выполнением скрипта
    $(document).ready(function () {
        let currentPage = 1; // Текущая страница
        let rowsPerPage = 10; // Количество строк на странице по умолчанию
        let totalData = []; // Массив для хранения всех полученных данных

        // Обработчик изменения количества строк на странице
        $('#rowsPerPage').on('change', function () {
            rowsPerPage = parseInt($(this).val()); // Получаем новое количество строк
            currentPage = 1; // Сбрасываем текущую страницу на первую
            renderTable(); // Перерисовываем таблицу
        });

        // Обработчик клика по кнопке отправки
        $('#submitButton').on('click', function () {
            const jsonData = $('#jsonInput').val(); // Получаем данные из текстового поля

            // Отправка AJAX-запроса на сервер
            $.ajax({
                url: 'process_json.php', // URL для обработки данных
                type: 'POST', // Метод запроса
                contentType: 'application/json', // Тип содержимого
                data: jsonData, // Данные, которые отправляем
                success: function (data) {
                    if (data.error) {
                        alert(data.error); // Показываем ошибку, если она есть
                        return;
                    }

                    totalData = data.items; // Сохраняем все полученные данные
                    $('#returnsCount').text(data.totalElements); // Обновляем количество возвратов
                    $('#totalReturns').show(); // Показываем блок с количеством возвратов
                    updateSummary(); // Обновляем сводную информацию
                    renderTable(); // Отображаем первую страницу
                },
                error: function (error) {
                    console.error('Ошибка:', error); // Логируем ошибку в консоль
                    alert('Произошла ошибка при обработке запроса.'); // Сообщение об ошибке
                }
            });
        });

        // Функция для отрисовки таблицы
        function renderTable() {
            const tbody = $('#ordersTable tbody');
            tbody.empty(); // Очищаем предыдущие данные

            // Вычисляем диапазон для текущей страницы
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = totalData.slice(start, end); // Получаем данные для текущей страницы

            // Добавляем строки в таблицу
            paginatedData.forEach(item => {
                const comment = item['Комментарий'] === 'null' ? 'Нет комментария' : item['Комментарий']; // Заменяем 'null' на текст

                const row = `
                    <tr>
                        <td>${item['Статус']}</td>
                        <td>${item['Дата заказа']}</td>
                        <td>${item['Номер заказа']}</td>
                        <td>${item['SKU']}</td>
                        <td>${item['ID продукта']}</td>
                        <td><img src="${item['Фото продукта']}" alt="Фото" width="100"></td>
                        <td>${item['ID магазина']}</td>
                        <td>${item['Дата отказа']}</td>
                        <td>${formatCurrency(item['Цена продажи'])}</td>
                        <td>${formatCurrency(item['Себестоимость'])}</td>
                        <td>${item['Наименование товара']}</td>
                        <td>${item['Причина возврата']}</td>
                        <td>${comment}</td> <!-- Используем обновлённое значение комментария -->
                    </tr>
                `;
                tbody.append(row); // Добавляем новую строку в таблицу
            });

            updatePagination(); // Обновляем пагинацию
        }

        // Функция для обновления пагинации
        function updatePagination() {
            const totalPages = Math.ceil(totalData.length / rowsPerPage); // Общее количество страниц
            $('#currentPage').text(currentPage); // Обновляем отображение текущей страницы
            $('#prevPage').prop('disabled', currentPage === 1); // Деактивируем кнопку "Назад", если на первой странице
            $('#nextPage').prop('disabled', currentPage === totalPages); // Деактивируем кнопку "Вперёд", если на последней странице
        }

        // Обработчик клика по кнопке "Назад"
        $('#prevPage').on('click', function () {
            if (currentPage > 1) { // Проверяем, что текущая страница больше 1
                currentPage--; // Переходим на предыдущую страницу
                renderTable(); // Перерисовываем таблицу
            }
        });

        // Обработчик клика по кнопке "Вперёд"
        $('#nextPage').on('click', function () {
            const totalPages = Math.ceil(totalData.length / rowsPerPage); // Общее количество страниц
            if (currentPage < totalPages) { // Проверяем, что текущая страница меньше последней
                currentPage++; // Переходим на следующую страницу
                renderTable(); // Перерисовываем таблицу
            }
        });

        // Функция для обновления сводной информации по возвратам
        function updateSummary() {
            const reasonCounts = {}; // Объект для подсчёта причин возвратов
            const commentCounts = {}; // Объект для подсчёта комментариев
            let totalReturnsCount = 0; // Счетчик общего количества возвратов
            let totalLostCost = 0; // Сумма потерянных денег
            let totalPotentialRevenue = 0; // Сумма потенциального дохода

            // Подсчёт возвратов и анализ данных
            totalData.forEach(item => {
                totalReturnsCount++; // Увеличиваем счетчик возвратов
                const reason = item['Причина возврата']; // Получаем причину возврата
                const comment = item['Комментарий'] === 'null' ? 'Нет комментария' : item['Комментарий']; // Заменяем 'null' на текст

                // Подсчёт причин возврата
                if (reason) {
                    reasonCounts[reason] = (reasonCounts[reason] || 0) + 1;
                }

                // Подсчёт комментариев
                if (comment) {
                    commentCounts[comment] = (commentCounts[comment] || 0) + 1;
                }

                // Считаем потерянные деньги и потенциальный доход
                if (reason === "Товара не оказалось в заказе") {
                    totalLostCost += parseFloat(item['Себес']) || 0; // Добавляем себестоимость
                    totalPotentialRevenue += parseFloat(item['Цена продажи']) || 0; // Добавляем цену продажи
                }
            });

            // Обновляем отображение данных по возвратам
            $('#totalReturnsCount').text(totalReturnsCount); // Обновляем общее количество возвратов
            $('#totalReasonsCount').text(Object.keys(reasonCounts).length); // Обновляем количество уникальных причин возвратов

            // Обновляем причины возвратов
            $('#dynamicReasonsContainer').empty(); // Очищаем контейнер с причинами
            for (const [reason, count] of Object.entries(reasonCounts)) {
                $('#dynamicReasonsContainer').append(`<div>${reason}: <strong>${count} шт.</strong></div>`); // Добавляем причину и количество
            }

            // Обновляем динамические комментарии
            $('#dynamicCommentsContainer').empty(); // Очищаем контейнер с комментариями
            for (const [comment, count] of Object.entries(commentCounts)) {
                $('#dynamicCommentsContainer').append(`<div> Комментарий с ПВЗ - (${comment}): <strong>${count} шт.</strong></div>`); // Добавляем комментарий и количество
            }

            // Обновляем статистику по "Товара не оказалось в заказе"
            $('#reasonProductNotFoundTotalCount').text(reasonCounts['Товара не оказалось в заказе'] || 0); // Обновляем количество возвратов с этой причиной
            $('#lostCostTotal').text(formatCurrency(totalLostCost)); // Обновляем сумму потерянных денег
            $('#potentialRevenueTotal').text(formatCurrency(totalPotentialRevenue)); // Обновляем сумму потенциального дохода
        }

        // Функция для форматирования чисел в валюту
        function formatCurrency(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "); // Форматирование с пробелами
        }
    });

    // Задаём актуальную версию проекта
    const CURRENT_VERSION = '0.0.4'; 

    // Обновление версии на странице после загрузки DOM
    document.addEventListener('DOMContentLoaded', () => {
        const versionElement = document.getElementById('version-number'); // Находим элемент для отображения версии
        if (versionElement) {
            versionElement.textContent = CURRENT_VERSION; // Устанавливаем текст версии
        } else {
            console.error('Элемент с id "version-number" не найден.'); // Сообщение об ошибке, если элемент не найден
        }
    });
</script>
</body>
</html>
