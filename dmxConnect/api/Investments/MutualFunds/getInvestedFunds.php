<?php
require('../../../../dmxConnectLib/dmxConnect.php');


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
          "provider": "SecurityCS"
        }
      },
      {
        "name": "getList",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "invested_mutual_funds",
                "column": "investment_id"
              },
              {
                "table": "invested_mutual_funds",
                "column": "scheme_id"
              },
              {
                "table": "invested_mutual_funds",
                "column": "folio_number"
              },
              {
                "table": "invested_mutual_funds",
                "column": "investment_amount",
                "aggregate": "SUM"
              },
              {
                "table": "invested_mutual_funds",
                "column": "unit_alloted"
              },
              {
                "table": "invested_mutual_funds",
                "column": "fund_name"
              },
              {
                "table": "invested_mutual_funds",
                "column": "redeemed"
              },
              {
                "table": "invested_mutual_funds",
                "column": "nav",
                "aggregate": "SUM"
              }
            ],
            "groupBy": [
              {
                "table": "invested_mutual_funds",
                "column": "investment_id"
              },
              {
                "table": "invested_mutual_funds",
                "column": "scheme_id"
              },
              {
                "table": "invested_mutual_funds",
                "column": "folio_number"
              },
              {
                "table": "invested_mutual_funds",
                "column": "unit_alloted"
              },
              {
                "table": "invested_mutual_funds",
                "column": "fund_name"
              },
              {
                "table": "invested_mutual_funds",
                "column": "redeemed"
              }
            ],
            "table": {
              "name": "invested_mutual_funds"
            },
            "joins": [],
            "query": "SELECT investment_id, scheme_id, folio_number, SUM(investment_amount), unit_alloted, fund_name, redeemed, SUM(nav)\nFROM invested_mutual_funds\nGROUP BY investment_id, scheme_id, folio_number, unit_alloted, fund_name, redeemed",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "investment_id",
            "type": "number"
          },
          {
            "name": "scheme_id",
            "type": "number"
          },
          {
            "name": "folio_number",
            "type": "number"
          },
          {
            "name": "investment_amount",
            "type": "number"
          },
          {
            "name": "unit_alloted",
            "type": "number"
          },
          {
            "name": "fund_name",
            "type": "text"
          },
          {
            "name": "redeemed",
            "type": "number"
          },
          {
            "name": "nav",
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