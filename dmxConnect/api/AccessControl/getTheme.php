<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "exec": {
    "steps": [
      "Connections/ConnCS",
      "SecurityProviders/SecurityCS",
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
                  "value": "{{SecurityCS.identity}}",
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
            "query": "SELECT main_theme\nFROM theme\nWHERE user_id = :P1 /* {{SecurityCS.identity}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{SecurityCS.identity}}"
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
  }
}
JSON
);
?>