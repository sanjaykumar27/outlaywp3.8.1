<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {},
    "$_POST": [
      {
        "type": "text",
        "name": "username"
      },
      {
        "type": "text",
        "name": "password"
      },
      {
        "type": "text",
        "name": "rememberme"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/ConnCS",
      "SecurityProviders/SecurityCS",
      {
        "name": "identity",
        "module": "auth",
        "action": "login",
        "options": {
          "provider": "SecurityCS",
          "password": "{{$_POST.password.md5(\"\")}}",
          "remember": ""
        },
        "output": true,
        "meta": []
      },
      {
        "name": "",
        "module": "auth",
        "action": "restrict",
        "options": {
          "provider": "SecurityCS",
          "permissions": [
            "Active"
          ]
        }
      },
      {
        "name": "UserInfo",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "user",
                "column": "first_name"
              },
              {
                "table": "user",
                "column": "id"
              },
              {
                "table": "user",
                "column": "last_name"
              },
              {
                "table": "user",
                "column": "username"
              },
              {
                "table": "user",
                "column": "email"
              },
              {
                "table": "user",
                "column": "profile_pic"
              }
            ],
            "table": {
              "name": "user"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "user.id",
                  "field": "user.id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{SecurityCS.identity}}",
                  "data": {
                    "table": "user",
                    "column": "id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT first_name, id, last_name, username, email, profile_pic\nFROM user\nWHERE id = :P1 /* {{SecurityCS.identity}} */",
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
            "name": "first_name",
            "type": "text"
          },
          {
            "name": "id",
            "type": "number"
          },
          {
            "name": "last_name",
            "type": "text"
          },
          {
            "name": "username",
            "type": "text"
          },
          {
            "name": "email",
            "type": "text"
          },
          {
            "name": "profile_pic",
            "type": "text"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "userid",
        "module": "core",
        "action": "setsession",
        "options": {
          "value": "{{UserInfo.id}}"
        },
        "output": true
      }
    ]
  }
}
JSON
);
?>