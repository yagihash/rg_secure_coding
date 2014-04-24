<?php
/*
 * このサンプルには脆弱性があります。
 * コピー&ペーストでの使用は絶対にしないでください。
 */
header("Content-Type: text/html; charset=UTF-8");
header("Content-Security-Policy: default-src 'self'; style-src 'unsafe-inline'");
header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: DENY");
header("X-Cotent-Type-Options: nosniff");

$db = new PDO("sqlite:../users.db");
if (isset($_GET["q"]) and $_GET["q"]) {
  $name = $_GET["q"];
  $sql = "SELECT id, name FROM users WHERE name LIKE '%'||?||'%'";
  $stmt = $db -> prepare($sql);
  $result = $stmt -> execute(array($name));
}
?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />
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
    <h1>ちょっと痛い感じの名前検索</h1>
    <form>
      <input type="text" name="q" <?php echo isset($_GET["q"]) ? "value=\"{$_GET['q']}\" " : ""; ?>placeholder="Search user name..." autofocus />
      <input type="submit" value="検索" />
    </form>
<?php
  if (isset($result)):
?>
    <table border="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>NAME</th>
        </tr>
      </thead>
<?php
    while($row = $stmt -> fetch()):
?>
      <tbody>
        <tr>
          <td><?php echo $row[0]; ?></td>
          <td><?php echo $row[1]; ?></td>
        </tr>
      </tbody>
<?php
    endwhile;
?>
    </table>
<?php
  endif;
?>
  </body>
</html>
<?php
unset($db);
