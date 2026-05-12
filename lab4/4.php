<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Счастливые билеты</title>
</head>
<body>
    <?php
    $resultTickets = '';
    $inputStart = '';
    $inputEnd = '';

    // isset — это языковая конструкция, а не функция, поэтому допустима
    if (isset($_POST['start']) && isset($_POST['end'])) {
        $inputStart = $_POST['start'];
        $inputEnd = $_POST['end'];

        // 1. Ручная валидация: только цифры, строго 6 символов
        $startOk = true; 
        $endOk = true;
        $lenStart = 0; 
        $lenEnd = 0;

        // Проверяем посимвольно (максимум 7 проверок, чтобы отсечь длину > 6)
        for ($k = 0; $k < 7; $k++) {
            $sChar = $inputStart[$k] ?? '';
            $eChar = $inputEnd[$k] ?? '';

            if ($k < 6) {
                // Проверка, что символ является цифрой от '0' до '9'
                if ($sChar < '0' || $sChar > '9') $startOk = false;
                if ($eChar < '0' || $eChar > '9') $endOk = false;
                
                if ($sChar !== '') $lenStart++;
                if ($eChar !== '') $lenEnd++;
            } else {
                // Если есть 7-й символ — длина больше 6, билет невалиден
                if ($sChar !== '') $startOk = false;
                if ($eChar !== '') $endOk = false;
            }
        }

        if ($startOk && $endOk && $lenStart === 6 && $lenEnd === 6) {
            // Приведение типа — это оператор, а не функция
            $startNum = (int)$inputStart;
            $endNum = (int)$inputEnd;

            // Диапазон 000000 (или 000001) до 999999
            if ($startNum >= 0 && $endNum <= 999999 && $startNum <= $endNum) {
                for ($i = $startNum; $i <= $endNum; $i++) {
                    $temp = $i;
                    
                    // 2. Ручное извлечение цифр (без str_split/array_sum/intdiv)
                    // Деление с приведением к int работает как целочисленное
                    $d6 = $temp % 10; $temp = (int)($temp / 10);
                    $d5 = $temp % 10; $temp = (int)($temp / 10);
                    $d4 = $temp % 10; $temp = (int)($temp / 10);
                    $d3 = $temp % 10; $temp = (int)($temp / 10);
                    $d2 = $temp % 10; $temp = (int)($temp / 10);
                    $d1 = $temp; // Останется первая цифра (0 для чисел < 100000)

                    // 3. Сравнение сумм
                    if (($d1 + $d2 + $d3) === ($d4 + $d5 + $d6)) {
                        // 4. Ручное форматирование с ведущими нулями (без sprintf)
                        // Переменные уже содержат цифры 0-9, конкатенация даст "000123"
                        $resultTickets .= $d1 . $d2 . $d3 . $d4 . $d5 . $d6 . '<br>';
                    }
                }
            }
        }
    }
    ?>

    <form method="POST" action="">
        Начальный номер: <input type="text" name="start" value="<?= $inputStart ?>" required><br><br>
        Конечный номер: <input type="text" name="end" value="<?= $inputEnd ?>" required><br><br>
        <input type="submit" value="Найти">
    </form>

    <?php if ($resultTickets !== ''): ?>
        <div>Результат:<br><?= $resultTickets ?></div>
    <?php endif; ?>
</body>
</html>