<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "category_id"
      },
      {
        "type": "number",
        "name": "invoice_number"
      },
      {
        "type": "text",
        "name": "invoice_name"
      },
      {
        "type": "number",
        "name": "quantity"
      },
      {
        "type": "number",
        "name": "unit"
      },
      {
        "type": "date",
        "name": "purchase_date"
      },
      {
        "type": "number",
        "name": "account"
      },
      {
        "type": "number",
        "name": "payment_type"
      },
      {
        "type": "text",
        "name": "remark"
      },
      {
        "type": "number",
        "name": "amount"
      },
      {
        "type": "number",
        "name": "id"
      },
      {
        "type": "text",
        "name": "ExpenseID"
      },
      {
        "type": "text",
        "name": "target_photo"
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
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{$_POST.target_photo}}",
          "then": {
            "steps": {
              "name": "uploadFile",
              "module": "upload",
              "action": "upload",
              "options": {
                "path": "/assets/uploads",
                "template": "{guid}{ext}",
                "replaceSpace": true
              },
              "meta": [
                {
                  "name": "name",
                  "type": "text"
                },
                {
                  "name": "path",
                  "type": "text"
                },
                {
                  "name": "url",
                  "type": "text"
                },
                {
                  "name": "type",
                  "type": "text"
                },
                {
                  "name": "size",
                  "type": "text"
                },
                {
                  "name": "error",
                  "type": "number"
                }
              ],
              "outputType": "array",
              "output": true
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "updateExpense",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "expense",
                "column": "category_id",
                "type": "number",
                "value": "{{$_POST.category_id}}"
              },
              {
                "table": "expense",
                "column": "invoice_number",
                "type": "number",
                "value": "{{$_POST.invoice_number}}"
              },
              {
                "table": "expense",
                "column": "invoice_name",
                "type": "text",
                "value": "{{$_POST.invoice_name}}"
              },
              {
                "table": "expense",
                "column": "quantity",
                "type": "number",
                "value": "{{$_POST.quantity}}"
              },
              {
                "table": "expense",
                "column": "unit",
                "type": "number",
                "value": "{{$_POST.unit}}"
              },
              {
                "table": "expense",
                "column": "purchase_date",
                "type": "date",
                "value": "{{$_POST.purchase_date}}"
              },
              {
                "table": "expense",
                "column": "account",
                "type": "number",
                "value": "{{$_POST.account}}"
              },
              {
                "table": "expense",
                "column": "payment_type",
                "type": "number",
                "value": "{{$_POST.payment_type}}"
              },
              {
                "table": "expense",
                "column": "remark",
                "type": "text",
                "value": "{{$_POST.remark}}"
              },
              {
                "table": "expense",
                "column": "amount",
                "type": "number",
                "value": "{{$_POST.amount}}"
              },
              {
                "table": "expense",
                "column": "receipt_name",
                "type": "text",
                "value": "{{uploadFile[0].name}}",
                "condition": "{{uploadFile[0].name}}"
              },
              {
                "table": "expense",
                "column": "receipt_url",
                "type": "text",
                "value": "{{uploadFile[0].name}}",
                "condition": "{{uploadFile[0].name}}"
              }
            ],
            "table": "expense",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "id",
                  "field": "id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.ExpenseID}}",
                  "data": {
                    "column": "id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "UPDATE expense\nSET category_id = :P1 /* {{$_POST.category_id}} */, invoice_number = :P2 /* {{$_POST.invoice_number}} */, invoice_name = :P3 /* {{$_POST.invoice_name}} */, quantity = :P4 /* {{$_POST.quantity}} */, unit = :P5 /* {{$_POST.unit}} */, purchase_date = :P6 /* {{$_POST.purchase_date}} */, account = :P7 /* {{$_POST.account}} */, payment_type = :P8 /* {{$_POST.payment_type}} */, remark = :P9 /* {{$_POST.remark}} */, amount = :P10 /* {{$_POST.amount}} */, receipt_name = :P11 /* {{uploadFile[0].name}} */, receipt_url = :P12 /* {{uploadFile[0].name}} */\nWHERE id = :P13 /* {{$_POST.ExpenseID}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.category_id}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.invoice_number}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.invoice_name}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.quantity}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.unit}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.purchase_date}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.account}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.payment_type}}"
              },
              {
                "name": ":P9",
                "type": "expression",
                "value": "{{$_POST.remark}}"
              },
              {
                "name": ":P10",
                "type": "expression",
                "value": "{{$_POST.amount}}"
              },
              {
                "name": ":P11",
                "type": "expression",
                "value": "{{uploadFile[0].name}}"
              },
              {
                "name": ":P12",
                "type": "expression",
                "value": "{{uploadFile[0].name}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P13",
                "value": "{{$_POST.ExpenseID}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ],
        "output": true
      },
      {
        "name": "updateAccTransaction",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "account_transaction",
                "column": "account_id",
                "type": "number",
                "value": "{{$_POST.account}}"
              },
              {
                "table": "account_transaction",
                "column": "debit",
                "type": "number",
                "value": "{{$_POST.amount}}"
              },
              {
                "table": "account_transaction",
                "column": "date_of_transaction",
                "type": "date",
                "value": "{{$_POST.purchase_date}}"
              },
              {
                "table": "account_transaction",
                "column": "type",
                "type": "number",
                "value": "{{$_POST.payment_type}}"
              }
            ],
            "table": "account_transaction",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "expense_id",
                  "field": "expense_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.ExpenseID}}",
                  "data": {
                    "column": "expense_id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "UPDATE account_transaction\nSET account_id = :P1 /* {{$_POST.account}} */, debit = :P2 /* {{$_POST.amount}} */, date_of_transaction = :P3 /* {{$_POST.purchase_date}} */, type = :P4 /* {{$_POST.payment_type}} */\nWHERE expense_id = :P5 /* {{$_POST.ExpenseID}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.account}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.amount}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.purchase_date}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.payment_type}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P5",
                "value": "{{$_POST.ExpenseID}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ],
        "output": true
      }
    ]
  }
}
JSON
);
?>