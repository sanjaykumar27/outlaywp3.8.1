<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "main_theme"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "main_theme"
      }
    ]
  },
  "exec": {
    "steps": [
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
        "name": "updateColorTheme",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "theme",
                "column": "main_theme",
                "type": "text",
                "value": "{{$_GET.main_theme}}"
              }
            ],
            "table": "theme",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "user_id",
                  "field": "user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{identity}}",
                  "data": {
                    "column": "user_id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "UPDATE theme\nSET main_theme = :P1 /* {{$_GET.main_theme}} */\nWHERE user_id = :P2 /* {{identity}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_GET.main_theme}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{identity}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ],
        "output": true
      }
    ]
  }
}
JSON
);
?>