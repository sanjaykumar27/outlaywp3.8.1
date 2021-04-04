<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
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
          ]
        }
      },
      {
        "name": "GetList",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "collections",
                "column": "name"
              },
              {
                "table": "collections",
                "column": "id"
              }
            ],
            "table": {
              "name": "collections"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "collections.collectiontype_id",
                  "field": "collections.collectiontype_id",
                  "type": "double",
                  "operator": "equal",
                  "value": 6,
                  "data": {
                    "table": "collections",
                    "column": "collectiontype_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT name, id\nFROM collections\nWHERE collectiontype_id = 6",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "id",
            "type": "number"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>