<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$exports = <<<'JSON'
{
    "name": "ConnCS",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "mysql",
        "connectionString": "mysql:host=localhost;sslverify=false;dbname=mindfuli_expense;user=root;charset=utf8",
        "meta"  : false
    }
}
JSON;
?>