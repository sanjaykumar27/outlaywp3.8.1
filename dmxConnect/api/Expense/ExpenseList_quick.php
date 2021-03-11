<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
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
        "name": "queryExpenseList",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "quick_expense"
            },
            "joins": [],
            "query": "SELECT *\nFROM quick_expense\nORDER BY purchase_date DESC, created_on DESC",
            "params": [],
            "orders": [
              {
                "table": "expense",
                "column": "purchase_date",
                "direction": "DESC",
                "condition": "{{$_GET.newexpense != 1}}",
                "recid": 1
              },
              {
                "table": "expense",
                "column": "created_on",
                "direction": "DESC",
                "condition": "{{$_GET.newexpense == 1}}",
                "recid": 2
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
                "name": "expense_id",
                "type": "text"
              },
              {
                "name": "item_name",
                "type": "text"
              },
              {
                "name": "amount",
                "type": "number"
              },
              {
                "name": "purchase_date",
                "type": "date"
              },
              {
                "name": "invoice_id",
                "type": "number"
              },
              {
                "name": "reciept",
                "type": "text"
              },
              {
                "name": "remark",
                "type": "text"
              },
              {
                "name": "status",
                "type": "boolean"
              },
              {
                "name": "created_on",
                "type": "datetime"
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