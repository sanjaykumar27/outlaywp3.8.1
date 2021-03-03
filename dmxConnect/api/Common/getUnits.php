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
        "name": "queryUnits",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "collections",
                "column": "id",
                "alias": "UnitID"
              },
              {
                "table": "collections",
                "column": "name",
                "alias": "UnitName"
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
                  "value": 1,
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
            "query": "SELECT id AS UnitID, name AS UnitName\nFROM collections\nWHERE collectiontype_id = 1\nORDER BY name ASC",
            "params": [],
            "orders": [
              {
                "table": "collections",
                "column": "name",
                "direction": "ASC"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "UnitID",
            "type": "number"
          },
          {
            "name": "UnitName",
            "type": "text"
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