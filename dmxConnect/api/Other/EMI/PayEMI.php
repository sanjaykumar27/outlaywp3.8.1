<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/Loan/spa_emiDetails.php",
      "linkedForm": "FormPayEMI"
    },
    "$_POST": [
      {
        "type": "date",
        "fieldName": "payment_date",
        "options": {
          "rules": {
            "core:required": {
              "param": ""
            },
            "core:date": {}
          }
        },
        "name": "payment_date"
      },
      {
        "type": "text",
        "fieldName": "emi_id",
        "options": {
          "rules": {
            "core:required": {
              "param": ""
            }
          }
        },
        "name": "emi_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "PayEMI",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "ConnCS",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "loan_details",
              "column": "paid_on",
              "type": "date",
              "value": "{{$_POST.payment_date}}"
            },
            {
              "table": "loan_details",
              "column": "status",
              "type": "number",
              "value": "1"
            }
          ],
          "table": "loan_details",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "id",
                "field": "id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.emi_id}}",
                "data": {
                  "column": "id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "UPDATE loan_details\nSET paid_on = :P1 /* {{$_POST.payment_date}} */, status = '1'\nWHERE id = :P2 /* {{$_POST.emi_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.payment_date}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_POST.emi_id}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>