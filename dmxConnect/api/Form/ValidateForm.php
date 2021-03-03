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
    "$_GET": [
      {
        "type": "text",
        "name": "form_name"
      }
    ]
  },
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
          ]
        }
      },
      {
        "name": "Response",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "0\n",
          "key": "Response"
        },
        "outputType": "number"
      },
      {
        "name": "validateFormName",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "form_master",
                "column": "form_id"
              }
            ],
            "table": {
              "name": "form_master"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "form_master.form_name",
                  "field": "form_master.form_name",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_GET.form_name}}",
                  "data": {
                    "table": "form_master",
                    "column": "form_name",
                    "type": "text"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT form_id\nFROM form_master\nWHERE form_name = :P1 /* {{$_GET.form_name}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.form_name}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "form_id",
            "type": "number"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{validateFormName.form_id > 0}}",
          "then": {
            "steps": {
              "name": "Response",
              "module": "core",
              "action": "setvalue",
              "options": {
                "key": "Response",
                "value": 1
              },
              "outputType": "number",
              "output": true
            }
          },
          "else": {
            "steps": {
              "name": "Response",
              "module": "core",
              "action": "setvalue",
              "options": {
                "key": "Response",
                "value": 2
              },
              "outputType": "number",
              "output": true
            }
          }
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON
);
?>