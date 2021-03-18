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
    "steps": {
      "name": "GetList",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "ConnCS",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "loan_master",
              "column": "id"
            },
            {
              "table": "loan_master",
              "column": "userid"
            },
            {
              "table": "loan_master",
              "column": "loan_name"
            },
            {
              "table": "loan_master",
              "column": "starting_date"
            },
            {
              "table": "loan_master",
              "column": "ending_date"
            },
            {
              "table": "loan_master",
              "column": "total_amount"
            },
            {
              "table": "loan_master",
              "column": "no_of_emi"
            },
            {
              "table": "loan_master",
              "column": "interest_amount"
            },
            {
              "table": "loan_master",
              "column": "paid_via"
            },
            {
              "table": "loan_master",
              "column": "cash_paid"
            },
            {
              "table": "loan_master",
              "column": "status",
              "alias": "paid_emi",
              "aggregate": "COUNT"
            },
            {
              "table": "loan_master",
              "column": "status"
            }
          ],
          "table": {
            "name": "loan_master"
          },
          "joins": [
            {
              "table": "loan_details",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "loan_details",
                    "column": "loan_id",
                    "operator": "equal",
                    "value": {
                      "table": "loan_master",
                      "column": "id"
                    },
                    "operation": "="
                  }
                ]
              }
            }
          ],
          "query": "SELECT loan_master.id, loan_master.userid, loan_master.loan_name, loan_master.starting_date, loan_master.ending_date, loan_master.total_amount, loan_master.no_of_emi, loan_master.interest_amount, loan_master.paid_via, loan_master.cash_paid, COUNT(loan_master.status) AS paid_emi, loan_master.status\nFROM loan_master\nLEFT JOIN loan_details ON (loan_details.loan_id = loan_master.id)\nWHERE loan_details.status = 1\nGROUP BY loan_master.id, loan_master.userid, loan_master.loan_name, loan_master.starting_date, loan_master.ending_date, loan_master.total_amount, loan_master.no_of_emi, loan_master.interest_amount, loan_master.paid_via, loan_master.cash_paid, loan_master.status",
          "params": [],
          "groupBy": [
            {
              "table": "loan_master",
              "column": "id"
            },
            {
              "table": "loan_master",
              "column": "userid"
            },
            {
              "table": "loan_master",
              "column": "loan_name"
            },
            {
              "table": "loan_master",
              "column": "starting_date"
            },
            {
              "table": "loan_master",
              "column": "ending_date"
            },
            {
              "table": "loan_master",
              "column": "total_amount"
            },
            {
              "table": "loan_master",
              "column": "no_of_emi"
            },
            {
              "table": "loan_master",
              "column": "interest_amount"
            },
            {
              "table": "loan_master",
              "column": "paid_via"
            },
            {
              "table": "loan_master",
              "column": "cash_paid"
            },
            {
              "table": "loan_master",
              "column": "status"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "loan_details.status",
                "field": "loan_details.status",
                "type": "double",
                "operator": "equal",
                "value": 1,
                "data": {
                  "table": "loan_details",
                  "column": "status",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "output": true,
      "type": "dbconnector_paged_select",
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
              "type": "text"
            },
            {
              "name": "userid",
              "type": "text"
            },
            {
              "name": "loan_name",
              "type": "text"
            },
            {
              "name": "starting_date",
              "type": "date"
            },
            {
              "name": "ending_date",
              "type": "date"
            },
            {
              "name": "total_amount",
              "type": "number"
            },
            {
              "name": "no_of_emi",
              "type": "number"
            },
            {
              "name": "interest_amount",
              "type": "number"
            },
            {
              "name": "paid_via",
              "type": "text"
            },
            {
              "name": "cash_paid",
              "type": "number"
            },
            {
              "name": "paid_emi",
              "type": "number"
            },
            {
              "name": "status",
              "type": "number"
            }
          ]
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>