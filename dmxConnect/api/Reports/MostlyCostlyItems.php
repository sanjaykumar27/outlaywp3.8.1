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
        "action": "paged",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "expense",
                "column": "category_id"
              },
              {
                "table": "sc",
                "column": "subcategory_name",
                "alias": "item_name"
              },
              {
                "table": "categories",
                "column": "category_name"
              },
              {
                "table": "expense",
                "column": "amount",
                "alias": "total_amount",
                "aggregate": "SUM"
              },
              {
                "table": "expense",
                "column": "amount",
                "alias": "no_times",
                "aggregate": "COUNT"
              }
            ],
            "groupBy": [
              {
                "table": "expense",
                "column": "category_id"
              },
              {
                "table": "sc",
                "column": "subcategory_name"
              },
              {
                "table": "categories",
                "column": "category_name"
              }
            ],
            "table": {
              "name": "expense"
            },
            "joins": [
              {
                "table": "sub_categories",
                "column": "*",
                "alias": "sc",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "sc",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "category_id"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "categories",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "categories",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "sc",
                        "column": "category_id"
                      },
                      "operation": "="
                    }
                  ]
                }
              }
            ],
            "query": "SELECT expense.category_id, sc.subcategory_name AS item_name, categories.category_name, SUM(expense.amount) AS total_amount, COUNT(expense.amount) AS no_times\nFROM expense\nLEFT JOIN sub_categories AS sc ON (sc.id = expense.category_id) LEFT JOIN categories ON (categories.id = sc.category_id)\nGROUP BY expense.category_id, sc.subcategory_name, categories.category_name",
            "params": []
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
                "name": "category_id",
                "type": "number"
              },
              {
                "name": "item_name",
                "type": "text"
              },
              {
                "name": "category_name",
                "type": "text"
              },
              {
                "name": "total_amount",
                "type": "number"
              },
              {
                "name": "no_times",
                "type": "number"
              }
            ]
          }
        ],
        "outputType": "object",
        "type": "dbconnector_paged_select",
        "disabled": true
      },
      {
        "name": "GetList",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "query": "SELECT expense.category_id, sc.subcategory_name AS item_name, categories.category_name, SUM(expense.amount) AS total_amount, COUNT(expense.amount) AS no_times\nFROM expense\nLEFT JOIN sub_categories AS sc ON (sc.id = expense.category_id) LEFT JOIN categories ON (categories.id = sc.category_id)\nGROUP BY expense.category_id\nORDER BY total_amount desc",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "category_id",
            "type": "number"
          },
          {
            "name": "item_name",
            "type": "text"
          },
          {
            "name": "category_name",
            "type": "text"
          },
          {
            "name": "total_amount",
            "type": "text"
          },
          {
            "name": "no_times",
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