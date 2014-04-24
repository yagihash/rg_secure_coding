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

$db = new SQLite3('../users.db');
if (isset($_GET["q"]) and $_GET["q"]) {
  $id = preg_match("/\A[0-9]+\z/", $_GET["q"]) ? $_GET["q"] : 0;
  $query = "SELECT id, name FROM users WHERE id LIKE {$id} AND name != 'admin'";
  $result = $db -> query($query);
}
?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />
    <title>sample2</title>
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
      <input type="text" name="q" <?php echo isset($_GET["q"]) ? "value=\"{$_GET['q']}\" " : ""; ?>placeholder="Search user id..." autofocus />
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
    while($row = $result -> fetchArray()):
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
$db->close();
