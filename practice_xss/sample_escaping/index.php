<?php
  header("Content-Type: text/html; charset=UTF-8");
  
  # 以下の関数はエスケープ関数のサンプルです。
  function escapeHTML($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
  }
?>
<script>
  window.onload = function() {
    var s = location.hash.substr(1);
    var tNode = document.createTextNode(s);
    var tgt = document.getElementById("js");
    tgt.appendChild(tNode);
  };
</script>
<p>
  $_GET["q"]をPHPで、location.hashをJSで、それぞれ安全に表示します。
</p>
<p>
  <?php echo escapeHTML(isset($_GET["q"]) ? $_GET["q"] : ""); ?>
</p>
<p id="js"></p>
