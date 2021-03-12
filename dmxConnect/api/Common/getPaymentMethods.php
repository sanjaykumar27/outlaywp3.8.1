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
        "name": "queryPaymentMethods",
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
                "alias": "PaymentID"
              },
              {
                "table": "collections",
                "column": "name",
                "alias": "PaymentType"
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
                  "value": 2,
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
            "query": "SELECT id AS PaymentID, name AS PaymentType\nFROM collections\nWHERE collectiontype_id = 2\nORDER BY name ASC",
            "params": [],
            "orders": [
              {
                "table": "collections",
                "column": "name",
                "direction": "ASC",
                "recid": 1
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "PaymentID",
            "type": "text"
          },
          {
            "name": "PaymentType",
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