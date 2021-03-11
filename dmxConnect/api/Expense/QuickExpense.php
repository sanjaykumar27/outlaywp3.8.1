<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/Expense/spa_quickExpense.php",
      "linkedForm": "CreateExpense"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "NewItem",
        "name": "NewItem"
      },
      {
        "type": "number",
        "fieldName": "Amount",
        "options": {
          "rules": {
            "core:number": {}
          }
        },
        "name": "Amount"
      },
      {
        "type": "date",
        "fieldName": "PurchaseDate",
        "options": {
          "rules": {
            "core:date": {}
          }
        },
        "name": "PurchaseDate"
      },
      {
        "type": "file",
        "fieldName": "target_photo",
        "name": "target_photo",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          }
        ],
        "outputType": "file"
      },
      {
        "type": "text",
        "fieldName": "Remark",
        "name": "Remark"
      },
      {
        "type": "number",
        "name": "invoice_id"
      },
      {
        "type": "text",
        "name": "target_photo[0]"
      },
      {
        "type": "text",
        "fieldName": "invoice_number",
        "name": "invoice_number"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{$_POST.target_photo}}",
          "then": {
            "steps": {
              "name": "upload",
              "module": "upload",
              "action": "upload",
              "options": {
                "fields": "{{$_POST.target_photo}}",
                "path": "/assets/upload",
                "template": "{name}{ext}",
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
              "outputType": "file"
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "CreateExpense",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "quick_expense",
                "column": "item_name",
                "type": "text",
                "value": "{{$_POST.NewItem}}"
              },
              {
                "table": "quick_expense",
                "column": "amount",
                "type": "number",
                "value": "{{$_POST.Amount}}"
              },
              {
                "table": "quick_expense",
                "column": "purchase_date",
                "type": "date",
                "value": "{{$_POST.PurchaseDate}}"
              },
              {
                "table": "quick_expense",
                "column": "invoice_id",
                "type": "number",
                "value": "{{$_POST.invoice_number}}"
              },
              {
                "table": "quick_expense",
                "column": "reciept",
                "type": "text",
                "value": "{{upload.name}}"
              },
              {
                "table": "quick_expense",
                "column": "remark",
                "type": "text",
                "value": "{{$_POST.Remark}}"
              },
              {
                "table": "quick_expense",
                "column": "created_on",
                "type": "datetime",
                "value": "{{NOW}}"
              }
            ],
            "table": "quick_expense",
            "returning": "expense_id",
            "query": "INSERT INTO quick_expense\n(item_name, amount, purchase_date, invoice_id, reciept, remark, created_on) VALUES (:P1 /* {{$_POST.NewItem}} */, :P2 /* {{$_POST.Amount}} */, :P3 /* {{$_POST.PurchaseDate}} */, :P4 /* {{$_POST.invoice_number}} */, :P5 /* {{upload.name}} */, :P6 /* {{$_POST.Remark}} */, :P7 /* {{NOW}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.NewItem}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.Amount}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.PurchaseDate}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.invoice_number}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{upload.name}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.Remark}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{NOW}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
          {
            "name": "affected",
            "type": "number"
          }
        ]
      }
    ]
  }
}
JSON
);
?>