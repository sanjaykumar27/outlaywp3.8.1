<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "CategoryName"
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
          ],
          "loginUrl": "/./",
          "forbiddenUrl": "/./"
        }
      },
      {
        "name": "checkCategory",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "categories",
                "column": "id"
              }
            ],
            "table": {
              "name": "categories"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "categories.category_name",
                  "field": "categories.category_name",
                  "type": "string",
                  "operator": "equal",
                  "value": "{{$_POST.CategoryName}}",
                  "data": {
                    "table": "categories",
                    "column": "category_name",
                    "type": "text"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT id\nFROM categories\nWHERE category_name = :P1 /* {{$_POST.CategoryName}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.CategoryName}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "id",
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
          "if": "{{checkCategory.id}}",
          "then": {
            "steps": {
              "name": "Response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 400,
                "data": "This category already exists"
              }
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "insertCategory",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "categories",
                "column": "category_name",
                "type": "text",
                "value": "{{$_POST.CategoryName}}"
              }
            ],
            "table": "categories",
            "returning": "id",
            "query": "INSERT INTO categories\n(category_name) VALUES (:P1 /* {{$_POST.CategoryName}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.CategoryName}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
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