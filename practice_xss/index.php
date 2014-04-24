<?php
  $d = glob("sample*");
  foreach($d as $p)
    echo "<a href='{$p}/'>{$p}/</a><br />\n";
