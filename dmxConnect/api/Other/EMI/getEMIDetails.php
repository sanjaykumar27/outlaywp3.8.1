<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "number",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "emi_id"
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
        "name": "GetDetails",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "loan_master"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "loan_master.id",
                  "field": "loan_master.id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.emi_id}}",
                  "data": {
                    "table": "loan_master",
                    "column": "id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT *\nFROM loan_master\nWHERE id = :P1 /* {{$_GET.emi_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.emi_id}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
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
            "name": "status",
            "type": "number"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "EmiList",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "loan_details"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "loan_details.loan_id",
                  "field": "loan_details.loan_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.emi_id}}",
                  "data": {
                    "table": "loan_details",
                    "column": "loan_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT *\nFROM loan_details\nWHERE loan_id = :P1 /* {{$_GET.emi_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.emi_id}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "id",
            "type": "text"
          },
          {
            "name": "loan_id",
            "type": "number"
          },
          {
            "name": "due_date",
            "type": "date"
          },
          {
            "name": "paid_on",
            "type": "date"
          },
          {
            "name": "loan_amount",
            "type": "number"
          },
          {
            "name": "status",
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