<!DOCTYPE html> 
<html lang="ru"> 
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Знак зодиака</title> 
</head> 
<body>
  <?php 
  function getZodiacSign(int $day, int $month): string
  { 
      if (($month === 3 && $day >= 21) || ($month === 4 && $day <= 19)) 
      { 
          return 'Овен'; 
      }
      if (($month === 4 && $day >= 20) || ($month === 5 && $day <= 20)) 
      {
          return 'Телец'; 
      } 
      if (($month === 5 && $day >= 21) || ($month === 6 && $day <= 20)) 
      { 
          return 'Близнецы';
      } 
      if (($month === 6 && $day >= 21) || ($month === 7 && $day <= 22)) 
      { 
          return 'Рак'; 
      } 
      if (($month === 7 && $day >= 23) || ($month === 8 && $day <= 22)) 
      { 
          return 'Лев'; 
      } 
      if (($month === 8 && $day >= 23) || ($month === 9 && $day <= 22)) 
      {
          return 'Дева'; 
      } 
      if (($month === 9 && $day >= 23) || ($month === 10 && $day <= 22)) 
      { 
          return 'Весы'; 
      } 
      if (($month === 10 && $day >= 23) || ($month === 11 && $day <= 21)) 
      { 
          return 'Скорпион';
      } 
      if (($month === 11 && $day >= 22) || ($month === 12 && $day <= 21)) 
      { 
          return 'Стрелец'; 
      } 
      if (($month === 12 && $day >= 22) || ($month === 1 && $day <= 19)) 
      { 
          return 'Козерог'; 
      } 
      if (($month === 1 && $day >= 20) || ($month === 2 && $day <= 18)) 
      { 
          return 'Водолей';
      } 
      if (($month === 2 && $day >= 19) || ($month === 3 && $day <= 20)) 
      { 
          return 'Рыбы'; 
      }
      return '';
  } 

  $resultSign = ''; 
  $inputDate = '';
  if (isset($_POST['date'])) 
  { 
      $inputDate = $_POST['date'];
      if ($inputDate[2] === '.' && $inputDate[5] === '.' && $inputDate[9] !== '')
      {
          $day = (int) ($inputDate[0] . $inputDate[1]);
          $month = (int) ($inputDate[3] . $inputDate[4]);
          if ($day >= 1 && $day <= 31 && $month >= 1 && $month <= 12) 
          { 
              $resultSign = getZodiacSign($day, $month);
          } 
      } 
  } 
  ?> 

  <div> 
    <form method="POST" action=""> 
      Введите дату (ДД.ММ.ГГГГ):
      <input type="text" name="date" placeholder="01.01.2000" value="<?php echo $inputDate; ?>" required>
      <input type="submit" value="Определить"> 
    </form> 
  </div> 

  <?php if ($resultSign !== ''): ?> 
  <div> 
    Результат: <?php echo $resultSign; ?> 
  </div> 
  <?php endif; ?> 

</body>
</html> 