<?php
    $db = new PDO('mysql:host=localhost;dbname=library_management_system', 'root', '');
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>