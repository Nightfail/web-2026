<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Цифра в слово</title>
</head>
<body>
  <?php
  function digitToWord(int $digit): string
  {
      switch ($digit)
      {
          case 0:
              return 'Ноль';
          case 1:
              return 'Один';
          case 2:
              return 'Два';
          case 3:
              return 'Три';
          case 4:
              return 'Четыре';
          case 5:
              return 'Пять';
          case 6:
              return 'Шесть';
          case 7:
              return 'Семь';
          case 8:
              return 'Восемь';
          case 9:
              return 'Девять';
          default:
              return '';
      }
  }

  $resultWord = '';
  $inputDigit = '';
  if (isset($_POST['digit']))
  {
      $inputDigit = $_POST['digit'];
      if ($inputDigit[0] !== '' && !isset($inputDigit[1]) && (
          $inputDigit[0] === '0' || $inputDigit[0] === '1' || $inputDigit[0] === '2' ||
          $inputDigit[0] === '3' || $inputDigit[0] === '4' || $inputDigit[0] === '5' ||
          $inputDigit[0] === '6' || $inputDigit[0] === '7' || $inputDigit[0] === '8' ||
          $inputDigit[0] === '9'
      ))
      {
          $digit = (int) $inputDigit;
          $resultWord = digitToWord($digit);
      }
      else
      {
          $resultWord = 'Введена не цифра';
      }
  }
  ?>

  <div>
    <form method="POST" action="">
      Введите цифру (0-9):
      <input type="text" name="digit" placeholder="0-9" value="<?php echo $inputDigit; ?>" required>
      <input type="submit" value="Преобразовать">
    </form>
  </div>

  <?php if ($resultWord !== ''): ?>
  <div>
    Результат: <?php echo $resultWord; ?>
  </div>
  <?php endif; ?>

</body>
</html>