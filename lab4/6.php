<!DOCTYPE html> 
<html lang="ru"> 
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Обратная польская запись</title> 
</head> 
<body> 
  <?php 
  function calculateRpn(string $expression): int 
  { 
      $tokens = []; 
      $tokenCount = 0; 
      $currentToken = ''; 

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

      $stack = []; 
      $stackSize = 0; 

      for ($i = 0; $i < $tokenCount; $i++) 
      { 
          $token = $tokens[$i]; 
          if ($token === '+' || $token === '-' || $token === '*') 
          { 
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
              $stack[$stackSize] = (int) $token; 
              $stackSize++; 
          } 
      } 
      return $stack[0]; 
  } 

  $resultCalc = ''; 
  $inputExpr = ''; 
  if (isset($_POST['expression'])) 
  { 
      $inputExpr = $_POST['expression']; 
      $resultCalc = (string) calculateRpn($inputExpr); 
  } 
  ?> 

  <div> 
    <form method="POST" action=""> 
      Введите выражение (ОПЗ): 
      <input type="text" name="expression" placeholder="8 9 + 1 7 - *" value="<?php echo $inputExpr; ?>" required> 
      <input type="submit" value="Вычислить"> 
    </form> 
  </div> 

  <?php if ($resultCalc !== ''): ?> 
  <div> 
    Результат: <?php echo $resultCalc; ?> 
  </div> 
  <?php endif; ?> 

</body> 
</html>