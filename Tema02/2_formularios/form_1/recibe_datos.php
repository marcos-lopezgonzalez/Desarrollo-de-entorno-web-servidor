<?php


print "<pre>";
print "Matriz \$_REQUEST" . "<br>";
print_r($_REQUEST);
print "</pre>\n";

$unnombre = $_REQUEST["nombre"];
$unaedad = $_REQUEST["edad"];

echo "Hola $unnombre!! <br>";
echo "Tienes $unaedad años. <br>";

?>