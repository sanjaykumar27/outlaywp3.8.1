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
        "name": "getCategories",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "categories",
                "column": "id",
                "alias": "CategoryID"
              },
              {
                "table": "categories",
                "column": "category_name",
                "alias": "CategoryName"
              }
            ],
            "table": {
              "name": "categories"
            },
            "joins": [],
            "wheres": null,
            "query": "SELECT id AS CategoryID, category_name AS CategoryName\nFROM categories\nORDER BY category_name ASC",
            "params": [],
            "orders": [
              {
                "table": "categories",
                "column": "category_name",
                "direction": "ASC"
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
                "name": "CategoryID",
                "type": "number"
              },
              {
                "name": "CategoryName",
                "type": "text"
              }
            ]
          }
        ],
        "outputType": "object"
      },
      {
        "name": "repeatCategories",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{getCategories.data}}",
          "outputFields": [
            "CategoryID",
            "CategoryName"
          ],
          "exec": {
            "steps": {
              "name": "queryItems",
              "module": "dbconnector",
              "action": "select",
              "options": {
                "connection": "ConnCS",
                "sql": {
                  "type": "SELECT",
                  "columns": [
                    {
                      "table": "sub_categories",
                      "column": "subcategory_name",
                      "alias": "ItemName"
                    },
                    {
                      "table": "sub_categories",
                      "column": "id",
                      "alias": "ItemID",
                      "aggregate": ""
                    },
                    {
                      "table": "sub_categories",
                      "column": "category_id"
                    }
                  ],
                  "table": {
                    "name": "sub_categories"
                  },
                  "joins": [],
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "sub_categories.category_id",
                        "field": "sub_categories.category_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{CategoryID}}",
                        "data": {
                          "table": "sub_categories",
                          "column": "category_id",
                          "type": "number"
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "query": "SELECT subcategory_name AS ItemName, id AS ItemID, category_id\nFROM sub_categories\nWHERE category_id = :P1 /* {{CategoryID}} */\nORDER BY subcategory_name ASC",
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{CategoryID}}"
                    }
                  ],
                  "orders": [
                    {
                      "table": "sub_categories",
                      "column": "subcategory_name",
                      "direction": "ASC",
                      "recid": 1
                    }
                  ]
                }
              },
              "output": true,
              "meta": [
                {
                  "name": "ItemName",
                  "type": "text"
                },
                {
                  "name": "ItemID",
                  "type": "number"
                },
                {
                  "name": "category_id",
                  "type": "number"
                }
              ],
              "outputType": "array"
            }
          }
        },
        "output": true,
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          },
          {
            "name": "CategoryID",
            "type": "number"
          },
          {
            "name": "CategoryName",
            "type": "text"
          },
          {
            "name": "queryItems",
            "type": "array",
            "sub": [
              {
                "name": "ItemName",
                "type": "text"
              },
              {
                "name": "ItemID",
                "type": "number"
              }
            ]
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