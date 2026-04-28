<!DOCTYPE html> 
<html lang="ru"> 
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Счастливые билеты</title> 
</head> 
<body> 
  <?php 
  function isLuckyTicket(int $ticket): bool 
  { 
      $n = $ticket; 
      $d6 = $n % 10; $n = (int)($n / 10); 
      $d5 = $n % 10; $n = (int)($n / 10); 
      $d4 = $n % 10; $n = (int)($n / 10); 
      $d3 = $n % 10; $n = (int)($n / 10); 
      $d2 = $n % 10; $n = (int)($n / 10); 
      $d1 = $n % 10; 
      return ($d1 + $d2 + $d3) === ($d4 + $d5 + $d6); 
  } 

  $resultTickets = ''; 
  $inputStart = ''; 
  $inputEnd = ''; 
  if (isset($_POST['start']) && isset($_POST['end'])) 
  { 
      $inputStart = $_POST['start']; 
      $inputEnd = $_POST['end']; 
      $startNum = (int) $inputStart; 
      $endNum = (int) $inputEnd; 

      if ($startNum >= 100000 && $endNum <= 999999 && $startNum <= $endNum) 
      { 
          for ($i = $startNum; $i <= $endNum; $i++) 
          { 
              if (isLuckyTicket($i)) 
              { 
                  $resultTickets .= $i . '<br>'; 
              } 
          } 
      } 
  } 
  ?> 

  <div> 
    <form method="POST" action=""> 
      Начальный номер: 
      <input type="text" name="start" placeholder="132401" value="<?php echo $inputStart; ?>" required> 
      <br> 
      Конечный номер: 
      <input type="text" name="end" placeholder="132601" value="<?php echo $inputEnd; ?>" required> 
      <input type="submit" value="Найти"> 
    </form> 
  </div> 

  <?php if ($resultTickets !== ''): ?> 
  <div> 
    Результат: <br> <?php echo $resultTickets; ?> 
  </div> 
  <?php endif; ?> 

</body> 
</html>