<!DOCTYPE html> 
<html lang="ru"> 
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Високосный год</title> 
</head> 
<body> 
  <?php 
  $result = null; 
  $inputYear = '';
  if (isset($_POST['year']))
  {
      $inputYear = $_POST['year']; 
      $year = (int) $inputYear; 
      if ($year > 0 && $year <= 30000)
      { 
          if (($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0))
          { 
              $result = 'YES';
          } 
          else 
          { 
              $result = 'NO'; 
          } 
      } 
  } 
  ?> 

  <div> 
    <form method="POST" action="">
      Введите год: 
      <input type="text" name="year" placeholder="Введите год" value="<?php echo $inputYear; ?>" required> 
      <input type="submit" value="Проверить"> 
    </form>
  </div>

  <?php if ($result !== null): ?> 
  <div>
    Результат: <?php echo $result; ?> 
  </div> 
  <?php endif; ?> 

</body>
</html>