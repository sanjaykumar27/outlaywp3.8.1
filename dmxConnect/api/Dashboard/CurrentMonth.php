<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "crstartdate"
      },
      {
        "type": "text",
        "name": "crenddate"
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
          "loginUrl": "/login",
          "forbiddenUrl": "/login"
        }
      },
      {
        "name": "Total",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "expense",
                "column": "amount",
                "alias": "TotalAmount",
                "aggregate": "SUM"
              }
            ],
            "groupBy": [],
            "table": {
              "name": "expense"
            },
            "joins": [],
            "query": "SELECT SUM(amount) AS TotalAmount\nFROM expense\nWHERE purchase_date BETWEEN :P1 /* {{$_GET.crstartdate}} */ AND :P2 /* {{$_GET.crenddate}} */",
            "params": [
              {
                "operator": "between",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.crstartdate}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.crenddate}}"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "expense.purchase_date",
                  "field": "expense.purchase_date",
                  "type": "date",
                  "operator": "between",
                  "value": [
                    "{{$_GET.crstartdate}}",
                    "{{$_GET.crenddate}}"
                  ],
                  "data": {
                    "table": "expense",
                    "column": "purchase_date",
                    "type": "date"
                  },
                  "operation": "BETWEEN"
                }
              ],
              "conditional": null,
              "valid": true
            }
          }
        },
        "output": true,
        "meta": [
          {
            "name": "TotalAmount",
            "type": "number"
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