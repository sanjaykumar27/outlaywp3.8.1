<?php
require('../../../../dmxConnectLib/dmxConnect.php');


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
        "name": "identity",
        "module": "auth",
        "action": "identify",
        "options": {
          "provider": "SecurityCS"
        },
        "output": true,
        "meta": []
      },
      {
        "name": "GetList",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "share_market"
            },
            "joins": [],
            "orders": [
              {
                "table": "share_market",
                "column": "purchase_date",
                "direction": "DESC"
              },
              {
                "table": "share_market",
                "column": "transaction_completed",
                "direction": "ASC"
              }
            ],
            "query": "SELECT *\nFROM share_market\nORDER BY purchase_date DESC, transaction_completed ASC",
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
                "name": "share_id",
                "type": "number"
              },
              {
                "name": "company_name",
                "type": "text"
              },
              {
                "name": "purchase_date",
                "type": "date"
              },
              {
                "name": "share_price",
                "type": "number"
              },
              {
                "name": "unit",
                "type": "number"
              },
              {
                "name": "invested_amount",
                "type": "number"
              },
              {
                "name": "sell_date",
                "type": "date"
              },
              {
                "name": "sell_share_price",
                "type": "number"
              },
              {
                "name": "sell_price",
                "type": "number"
              },
              {
                "name": "profit_loss",
                "type": "number"
              },
              {
                "name": "transaction_completed",
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