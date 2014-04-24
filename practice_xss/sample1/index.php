<?php
/*
 * このサンプルには脆弱性があります。
 * コピー&ペーストでの使用は絶対にしないでください。
 */
header("Content-Type: text/html; charset=UTF-8");
header("X-XSS-Protection: 0");
header("X-Frame-Options: DENY");

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
$q = isset($_GET["q"]) ? $_GET["q"] : "";

?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset=utf-8 />
    <title>sample1</title>
    <style>
      body {
        padding: 20px;
      }

      form {
        margin-bottom: 20px;
      }

      table * {
        padding: 2px;
      }
    </style>
  </head>

  <body>
    <h1>XSS Sample1</h1>
    <form>
      <input autofocus type=text name=q value=<?php echo h($q); ?>>
      <input type=submit value=OK>
    </form>
  </body>
</html>
