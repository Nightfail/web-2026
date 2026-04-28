<!DOCTYPE html> 
<html lang="ru"> 
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Факториал</title> 
</head> 
<body> 
  <?php 
  function factorial(int $n): int 
  { 
      if ($n <= 1) 
      { 
          return 1; 
      } 
      return $n * factorial($n - 1); 
  } 

  $resultFactorial = ''; 
  $inputNum = ''; 
  if (isset($_POST['number'])) 
  { 
      $inputNum = $_POST['number']; 
      $isValid = true; 
      $i = 0;
      while (isset($inputNum[$i])) 
      { 
          $char = $inputNum[$i]; 
          if ($char < '0' || $char > '9') 
          { 
              $isValid = false; 
              break; 
          } 
          $i++;
      } 
      if ($inputNum === '' || !$isValid) 
      { 
          $resultFactorial = 'Введено не число'; 
      } 
      else 
      { 
          $num = (int) $inputNum; 
          $resultFactorial = (string) factorial($num); 
      } 
  } 
  ?> 

  <div> 
    <form method="POST" action=""> 
      Введите число: 
      <input type="text" name="number" placeholder="Например: 4" value="<?php echo $inputNum; ?>" required> 
      <input type="submit" value="Вычислить"> 
    </form> 
  </div> 

  <?php if ($resultFactorial !== ''): ?> 
  <div> 
    Результат: <?php echo $resultFactorial; ?> 
  </div> 
  <?php endif; ?> 

</body> 
</html>