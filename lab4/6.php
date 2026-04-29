<!DOCTYPE html> 
<html lang="ru"> 
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Обратная польская запись</title> 
</head> 
<body> 
  <?php 
  function calculateRpn(string $expression): array 
  { 
      $tokens = []; 
      $tokenCount = 0; 
      $currentToken = ''; 

      // Разбор выражения на токены
      $i = 0;
      while (isset($expression[$i])) 
      { 
          if ($expression[$i] === ' ') 
          { 
              if ($currentToken !== '') 
              { 
                  $tokens[$tokenCount] = $currentToken; 
                  $tokenCount++; 
                  $currentToken = ''; 
              } 
          } 
          else 
          { 
              $currentToken .= $expression[$i]; 
          } 
          $i++;
      } 
      if ($currentToken !== '') 
      { 
          $tokens[$tokenCount] = $currentToken; 
          $tokenCount++; 
      } 

      if ($tokenCount === 0) {
          return ['error' => 'Выражение пустое'];
      }

      $stack = []; 
      $stackSize = 0; 

      for ($i = 0; $i < $tokenCount; $i++) 
      { 
          $token = $tokens[$i]; 
          if ($token === '+' || $token === '-' || $token === '*') 
          { 
              if ($stackSize < 2) 
              {
                  return ['error' => 'Некорректное выражение: недостаточно операндов для операции "' . $token . '"'];
              }            
              $stackSize--; 
              $b = $stack[$stackSize]; 
              $stackSize--; 
              $a = $stack[$stackSize]; 
              $res = 0; 
              if ($token === '+') 
              { 
                  $res = $a + $b; 
              } 
              elseif ($token === '-') 
              { 
                  $res = $a - $b; 
              } 
              elseif ($token === '*') 
              { 
                  $res = $a * $b; 
              } 
              $stack[$stackSize] = $res; 
              $stackSize++; 
          } 
          else 
          { 
              // Проверка: является ли токен числом
              if (!is_numeric($token)) {
                  return ['error' => 'Некорректный токен: "' . $token . '"'];
              }
              $stack[$stackSize] = (int) $token; 
              $stackSize++; 
          } 
      } 
      
      // Проверка: должен остаться ровно один результат
      if ($stackSize !== 1) {
          return ['error' => 'Некорректное выражение: слишком много операндов'];
      }
      
      return ['result' => $stack[0]];
  } 

  $resultCalc = ''; 
  $errorCalc = '';
  $inputExpr = ''; 
  
  if (isset($_POST['expression'])) 
  { 
      $inputExpr = $_POST['expression']; 
      $calcResult = calculateRpn($inputExpr); 
      
      if (isset($calcResult['error'])) {
          $errorCalc = $calcResult['error'];
      } else {
          $resultCalc = (string) $calcResult['result'];
      }
  } 
  ?> 

  <div> 
    <form method="POST" action=""> 
      Введите выражение (ОПЗ): 
      <input type="text" name="expression" placeholder="8 9 + 1 7 - *" value="<?php echo htmlspecialchars($inputExpr); ?>" required> 
      <input type="submit" value="Вычислить"> 
    </form> 
  </div> 

  <?php if ($errorCalc !== ''): ?> 
  <div style="color: red; margin-top: 10px;"> 
    Ошибка: <?php echo htmlspecialchars($errorCalc); ?> 
  </div> 
  <?php endif; ?> 
  
  <?php if ($resultCalc !== ''): ?> 
  <div style="margin-top: 10px;"> 
    Результат: <?php echo $resultCalc; ?> 
  </div> 
  <?php endif; ?> 

</body> 
</html>