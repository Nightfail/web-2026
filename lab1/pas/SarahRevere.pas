PROGRAM SarahRevere(INPUT, OUTPUT);
USES
  DOS;
VAR
  QS: STRING;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  QS := GetEnv('QUERY_STRING');
  IF QS = 'lanterns=1' THEN
    WRITELN('The British are coming by land')
  ELSE IF QS = 'lanterns=2' THEN
    WRITELN('The British are coming by sea')
  ELSE
    WRITELN('Sarah didn''t say');
END.