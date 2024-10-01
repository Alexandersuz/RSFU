<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статусы возвратов с UZUM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #121212; /* Тёмный фон страницы */
            color: #ffffff; /* Белый цвет текста */
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center; /* Выравнивание по центру */
            border: 1px solid #333; /* Тёмные границы */
        }

        th {
            background-color: #1e1e1e; /* Тёмный фон заголовков */
            color: #ffffff; /* Белый цвет текста заголовков */
        }

        tr:nth-child(even) {
            background-color: #2a2a2a; /* Тёмный фон для чётных строк */
        }

        tr:hover {
            background-color: #3c3c3c; /* Фон при наведении на строку */
        }

         /* Стили для форм */
.form-container {
    background-color: #1e1e1e; /* Тёмный фон формы */
    border-radius: 5px; /* Закругление углов */
    padding: 20px; /* Отступы внутри формы */
    margin-top: 20px; /* Отступ сверху */
    width: 600px; /* Ширина формы */
    display: inline-block; /* Размещаем формы рядом */
    margin: 0 10px; /* Отступы по горизонтали между формами */
    height: 330px; /* Установите фиксированную высоту для формы */
    overflow: auto; /* Добавьте прокрутку, если содержимое превышает высоту */
}
        
        .form-header {
            font-size: 18px;
            margin-bottom: 10px;
            text-align: center; /* Центрируем заголовок формы */
        }
                
        .section-container {
    margin-bottom: 20px; /* Отступ между секциями */
    padding: 10px;
    border-radius: 8px;
    background-color: #2c2c2c; /* Цвет фона для тёмной темы */
}
        
        #dynamicReasonsContainer {
    margin-top: 10px; /* Отступ сверху 10px */
    padding: 10px; /* Отступы внутри */
    border-radius: 8px; /* Закругление углов */
    background-color: #2c2c2c; /* Цвет фона для тёмной темы */
    text-align: left; /* Выравнивание текста по левому краю */
}
        
#dynamicCommentsContainer {
    margin-top: 10px; /* Отступ сверху 10px */
    padding: 10px; /* Отступы внутри */
    border-radius: 8px; /* Закругление углов */
    background-color: #2c2c2c; /* Цвет фона для тёмной темы */
    text-align: left; /* Выравнивание текста по левому краю */
}
        
                    .form-wrapper {
        display: flex; /* Используем flexbox для размещения форм */
        justify-content: center; /* Центрируем формы по горизонтали */
        margin-top: 20px; /* Отступ сверху для формы */
        margin-bottom: 20px;
    }


        #jsonInput {
            width: 40%; /* Уменьшаем ширину поля ввода до 40% */
            min-height: 150px; /* Минимальная высота для удобства ввода текста */
            padding: 10px;
            margin: 20px auto; /* Отступы сверху и снизу, авто по горизонтали для центрирования */
            background-color: #1e1e1e; /* Тёмный фон для поля ввода */
            color: #ffffff; /* Белый цвет текста */
            border: 1px solid #444; /* Тёмные границы */
            border-radius: 5px; /* Закругление углов */
            display: block; /* Делаем элемент блочным для центрирования */
            resize: vertical; /* Разрешаем изменять размер только по вертикали */
        }

        #submitButton {
            width: 40%; /* Ширина кнопки равна ширине поля ввода */
            background-color: #007bff; /* Синий фон кнопки */
            color: white; /* Белый цвет текста кнопки */
            padding: 10px 15px;
            border: none; /* Без границ */
            border-radius: 5px; /* Закругление углов */
            cursor: pointer; /* Указатель при наведении */
            transition: background-color 0.3s;
            margin: 10px auto; /* Центрируем кнопку */
            display: block; /* Делаем кнопку блочной для центрирования */
        }

        #submitButton:hover {
            background-color: #0056b3; /* Темнее синий при наведении */
        }

        #totalReturns {
            position: absolute; /* Позиционирование относительно окна */
            top: 20px; /* Отступ сверху */
            right: 20px; /* Отступ справа */
            color: white; /* Белый цвет текста */
            font-size: 18px; /* Размер шрифта */
        }

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

        #pagination {
            display: flex;
            align-items: center;
            justify-content: flex-end; /* Выровнять элементы по правому краю */
            background-color: #2e2e2e; /* Темный фон для пагинации */
            padding: 10px; /* Отступы вокруг */
            border-radius: 5px; /* Закругление углов */
        }

        .pagination-button {
            background-color: #007bff; /* Синий фон для кнопок */
            color: white; /* Белый цвет текста кнопок */
            padding: 10px 15px;
            border: none; /* Без границ */
            border-radius: 5px; /* Закругление углов */
            cursor: pointer; /* Указатель при наведении */
            margin: 0 5px; /* Отступы между кнопками */
            transition: background-color 0.3s;
        }

        .pagination-button:hover {
            background-color: #0056b3; /* Темнее синий при наведении */
        }

        label {
            color: #ffffff; /* Белый цвет для текста */
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
        Всего возвратов: <span id="returnsCount"></span>
    </div>
    <h1>Статусы возвратов с UZUM</h1>

    <table id="ordersTable">
        <thead>
            <tr>
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
        <label for="rowsPerPage" style="color: #ffffff;">Строк на странице:</label>
        <select id="rowsPerPage">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
        </select>

        <button id="prevPage" class="pagination-button">Назад</button>
        <span id="currentPage" style="color: #ffffff;">1</span>
        <button id="nextPage" class="pagination-button">Вперед</button>
    </div>

    <div style="text-align: center;">
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
    <div class="form-item">Комментарии оставленные в ПВЗ или при отмене товара "онлайн":</div>
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
        <div class="form-item">Потенциальная прибыль, упущенная из-за проблемы, оценивается в <strong><span id="potentialRevenueTotal">0</span> сум. </strong>(без учёта комиссии UZUM).</div>
            </div>
    </div>
    
        <!-- Вывод текущей версии проекта -->
    <div class="version">Версия: <span id="version-number"></span></div>
</div>

<script>
    $(document).ready(function () {
        let currentPage = 1;
        let rowsPerPage = 10; // По умолчанию 10 строк
        let totalData = []; // Массив для хранения всех данных

        $('#rowsPerPage').on('change', function () {
            rowsPerPage = parseInt($(this).val());
            currentPage = 1; // Сбрасываем на первую страницу
            renderTable();
        });

        $('#submitButton').on('click', function () {
            const jsonData = $('#jsonInput').val();

            $.ajax({
                url: 'process_json.php',
                type: 'POST',
                contentType: 'application/json',
                data: jsonData,
                success: function (data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    totalData = data.items; // Сохраняем все данные
                    $('#returnsCount').text(data.totalElements);
                    $('#totalReturns').show(); // Показываем блок с количеством возвратов
                    updateSummary(); // Обновляем информацию в формах
                    renderTable(); // Отображаем первую страницу
                },
                error: function (error) {
                    console.error('Ошибка:', error);
                    alert('Произошла ошибка при обработке запроса.');
                }
            });
        });

        function renderTable() {
            const tbody = $('#ordersTable tbody');
            tbody.empty(); // Очищаем предыдущие данные

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = totalData.slice(start, end); // Получаем нужные строки для текущей страницы

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
                        <td>${formatCurrency(item['Себес'])}</td>
                        <td>${item['Наименование товара']}</td>
                        <td>${item['Причина возврата']}</td>
                        <td>${comment}</td> <!-- Используем обновлённое значение комментария -->
                    </tr>
                `;
                tbody.append(row); // Добавляем новую строку
            });

            updatePagination();
        }

        function updatePagination() {
            const totalPages = Math.ceil(totalData.length / rowsPerPage);
            $('#currentPage').text(currentPage);
            $('#prevPage').prop('disabled', currentPage === 1);
            $('#nextPage').prop('disabled', currentPage === totalPages);
        }

        $('#prevPage').on('click', function () {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });

        $('#nextPage').on('click', function () {
            const totalPages = Math.ceil(totalData.length / rowsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        });

function updateSummary() {
    const reasonCounts = {};
    const commentCounts = {};
    let totalReturnsCount = 0;
    let totalLostCost = 0;
    let totalPotentialRevenue = 0;

    totalData.forEach(item => {
        totalReturnsCount++;
        const reason = item['Причина возврата'];
        const comment = item['Комментарий'] === 'null' ? 'Нет комментария' : item['Комментарий']; // Заменяем 'null' на текст

        // Подсчет причин возврата
        if (reason) {
            reasonCounts[reason] = (reasonCounts[reason] || 0) + 1;
        }

        // Подсчет комментариев
        if (comment) {
            commentCounts[comment] = (commentCounts[comment] || 0) + 1;
        }

        // Считаем потерянные деньги и потенциальный доход
        if (reason === "Товара не оказалось в заказе") {
            totalLostCost += parseFloat(item['Себес']) || 0;
            totalPotentialRevenue += parseFloat(item['Цена продажи']) || 0;
        }
    });

    // Обновляем отображение данных по возвратам
    $('#totalReturnsCount').text(totalReturnsCount);
    $('#totalReasonsCount').text(Object.keys(reasonCounts).length);

// Обновляем причины возвратов
$('#dynamicReasonsContainer').empty();
for (const [reason, count] of Object.entries(reasonCounts)) {
    $('#dynamicReasonsContainer').append(`<div>${reason}: <strong>${count} шт.</strong></div>`);
}

// Обновляем динамические комментарии
$('#dynamicCommentsContainer').empty();
for (const [comment, count] of Object.entries(commentCounts)) {
    $('#dynamicCommentsContainer').append(`<div> Комментарий с ПВЗ - (${comment}): <strong>${count} шт.</strong></div>`);
}

    // Обновляем статистику по "Товара не оказалось в заказе"
    $('#reasonProductNotFoundTotalCount').text(reasonCounts['Товара не оказалось в заказе'] || 0);
    $('#lostCostTotal').text(formatCurrency(totalLostCost));
    $('#potentialRevenueTotal').text(formatCurrency(totalPotentialRevenue));
}

        function formatCurrency(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "); // Форматирование с пробелами
        }
    });
    
    
    
// Задайте актуальную версию проекта
const CURRENT_VERSION = '0.0.3'; 

// Обновление версии на странице после загрузки DOM
document.addEventListener('DOMContentLoaded', () => {
    const versionElement = document.getElementById('version-number');
    if (versionElement) {
        versionElement.textContent = CURRENT_VERSION;
    } else {
        console.error('Элемент с id "version-number" не найден.');
    }
});
</script>
</body>
</html>
