PROGRAM HelloName(INPUT, OUTPUT);
USES
  DOS;
VAR
  QueryString, Name: STRING;
  PosName: INTEGER;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  QueryString := GetEnv('QUERY_STRING');
  PosName := Pos('name=', QueryString);
  IF PosName = 1 THEN
  BEGIN
    Name := Copy(QueryString, 6, Length(QueryString) - 5);
    WRITELN('Hello dear, ', Name, '!');
  END
  ELSE
  BEGIN
    WRITELN('Hello Anonymous!');
  END;
END.