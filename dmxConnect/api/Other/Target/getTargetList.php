<?php
require('../../../../dmxConnectLib/dmxConnect.php');


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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
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
        "name": "queryTargetList",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "target_master",
                "column": "id"
              },
              {
                "table": "target_master",
                "column": "target_name"
              },
              {
                "table": "target_master",
                "column": "target_amount"
              },
              {
                "table": "target_master",
                "column": "target_description"
              },
              {
                "table": "target_master",
                "column": "target_photo"
              },
              {
                "table": "target_master",
                "column": "IsCompleted"
              },
              {
                "table": "target_master",
                "column": "CreatedOn"
              },
              {
                "table": "target_transaction",
                "column": "debit",
                "alias": "TotalDebit",
                "aggregate": "SUM"
              },
              {
                "table": "target_transaction",
                "column": "credit",
                "alias": "TotalCredit",
                "aggregate": "SUM"
              }
            ],
            "table": {
              "name": "target_master"
            },
            "joins": [
              {
                "table": "target_transaction",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "target_transaction",
                      "column": "target_id",
                      "operator": "equal",
                      "value": {
                        "table": "target_master",
                        "column": "id"
                      },
                      "operation": "="
                    }
                  ]
                }
              }
            ],
            "query": "SELECT target_master.id, target_master.target_name, target_master.target_amount, target_master.target_description, target_master.target_photo, target_master.IsCompleted, target_master.CreatedOn, SUM(target_transaction.debit) AS TotalDebit, SUM(target_transaction.credit) AS TotalCredit\nFROM target_master\nLEFT JOIN target_transaction ON (target_transaction.target_id = target_master.id)\nGROUP BY target_master.id, target_master.target_name, target_master.target_amount, target_master.target_description, target_master.target_photo, target_master.IsCompleted, target_master.CreatedOn",
            "params": [],
            "groupBy": [
              {
                "table": "target_master",
                "column": "id"
              },
              {
                "table": "target_master",
                "column": "target_name"
              },
              {
                "table": "target_master",
                "column": "target_amount"
              },
              {
                "table": "target_master",
                "column": "target_description"
              },
              {
                "table": "target_master",
                "column": "target_photo"
              },
              {
                "table": "target_master",
                "column": "IsCompleted"
              },
              {
                "table": "target_master",
                "column": "CreatedOn"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "offset",
            "type": "number"
          },
          {
            "name": "limit",
            "type": "number"
          },
          {
            "name": "total",
            "type": "number"
          },
          {
            "name": "page",
            "type": "object",
            "sub": [
              {
                "name": "offset",
                "type": "object",
                "sub": [
                  {
                    "name": "first",
                    "type": "number"
                  },
                  {
                    "name": "prev",
                    "type": "number"
                  },
                  {
                    "name": "next",
                    "type": "number"
                  },
                  {
                    "name": "last",
                    "type": "number"
                  }
                ]
              },
              {
                "name": "current",
                "type": "number"
              },
              {
                "name": "total",
                "type": "number"
              }
            ]
          },
          {
            "name": "data",
            "type": "array",
            "sub": [
              {
                "name": "id",
                "type": "number"
              },
              {
                "name": "target_name",
                "type": "text"
              },
              {
                "name": "target_amount",
                "type": "number"
              },
              {
                "name": "target_description",
                "type": "text"
              },
              {
                "name": "target_photo",
                "type": "text"
              },
              {
                "name": "IsCompleted",
                "type": "number"
              },
              {
                "name": "CreatedOn",
                "type": "datetime"
              },
              {
                "name": "TotalDebit",
                "type": "number"
              },
              {
                "name": "TotalCredit",
                "type": "number"
              }
            ]
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