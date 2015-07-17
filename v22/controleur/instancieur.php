<?php
//instancie toutes les class pour les rendre volatile dans tout le site



$_db_connect = new _db_connect();
$security = new security();
$operation_sql = new operation_sql();
$all_query = new all_query();

?>