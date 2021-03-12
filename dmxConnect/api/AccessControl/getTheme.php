<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
[
  {
    "name": "",
    "module": "auth",
    "action": "restrict",
    "options": {
      "provider": "SecurityCS",
      "permissions": [
        "Active"
      ],
      "loginUrl": "/./",
      "forbiddenUrl": "/./"
    }
  },
  {
    "name": "identity",
    "module": "auth",
    "action": "identify",
    "options": {
      "provider": "SecurityCS"
    },
    "output": true,
    "meta": []
  },
  {
    "name": "getTheme",
    "module": "dbconnector",
    "action": "single",
    "options": {
      "connection": "ConnCS",
      "sql": {
        "type": "SELECT",
        "columns": [
          {
            "table": "theme",
            "column": "main_theme"
          }
        ],
        "table": {
          "name": "theme"
        },
        "joins": [],
        "wheres": {
          "condition": "AND",
          "rules": [
            {
              "id": "theme.user_id",
              "field": "theme.user_id",
              "type": "double",
              "operator": "equal",
              "value": "{{identity}}",
              "data": {
                "table": "theme",
                "column": "user_id",
                "type": "number"
              },
              "operation": "="
            }
          ],
          "conditional": null,
          "valid": true
        },
        "query": "SELECT main_theme\nFROM theme\nWHERE user_id = :P1 /* {{identity}} */",
        "params": [
          {
            "operator": "equal",
            "type": "expression",
            "name": ":P1",
            "value": "{{identity}}"
          }
        ]
      }
    },
    "output": true,
    "meta": [
      {
        "name": "main_theme",
        "type": "text"
      }
    ],
    "outputType": "object"
  }
]
JSON
);
?>