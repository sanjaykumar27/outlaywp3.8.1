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
        "name": "TopItems",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "query": "SELECT SUM(expense.amount) as total,  sc.subcategory_name, categories.category_name from expense\nLEFT JOIN sub_categories as sc on (sc.id = expense.category_id)\nLEFT JOIN categories on (categories.id = sc.category_id)\nwhere expense.category_id != 106\nGROUP BY expense.category_id order by total desc\nLIMIT 0,5",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "total",
            "type": "text"
          },
          {
            "name": "subcategory_name",
            "type": "text"
          },
          {
            "name": "category_name",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "TotalExpense",
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
                "alias": "Total",
                "aggregate": "SUM"
              }
            ],
            "groupBy": [],
            "table": {
              "name": "expense"
            },
            "joins": [],
            "query": "SELECT SUM(amount) AS Total\nFROM expense",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "Total",
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