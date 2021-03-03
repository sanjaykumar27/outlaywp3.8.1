<?php
$exports = <<<'JSON'
{
  "name": "SecurityCS",
  "module": "auth",
  "action": "provider",
  "options": {
    "connection": "ConnCS",
    "secret": "\"\"",
    "provider": "Database",
    "users": {
      "table": "user",
      "identity": "id",
      "username": "username",
      "password": "password"
    },
    "permissions": {
      "Active": {
        "table": "user",
        "identity": "id",
        "conditions": []
      }
    }
  },
  "meta": [
    {
      "name": "identity",
      "type": "text"
    }
  ]
}
JSON;
?>