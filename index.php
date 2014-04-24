<?php
  $d = glob("practice_*");
  foreach($d as $p)
    echo "<a href='{$p}/'>{$p}/</a><br />\n";
