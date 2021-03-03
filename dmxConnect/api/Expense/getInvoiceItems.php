<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "invoiceid"
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
        "name": "queryInvoiceItems",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "expense",
                "column": "invoice_number"
              },
              {
                "table": "expense",
                "column": "quantity"
              },
              {
                "table": "expense",
                "column": "purchase_date"
              },
              {
                "table": "expense",
                "column": "receipt_name"
              },
              {
                "table": "expense",
                "column": "receipt_url"
              },
              {
                "table": "expense",
                "column": "account"
              },
              {
                "table": "expense",
                "column": "payment_type"
              },
              {
                "table": "expense",
                "column": "remark"
              },
              {
                "table": "expense",
                "column": "amount"
              },
              {
                "table": "sub_categories",
                "column": "subcategory_name",
                "alias": "ItemName"
              },
              {
                "table": "C1",
                "column": "name",
                "alias": "Unit"
              },
              {
                "table": "C2",
                "column": "name",
                "alias": "PaymentType"
              },
              {
                "table": "expense",
                "column": "id",
                "alias": "Expense_ID"
              },
              {
                "table": "expense",
                "column": "unit",
                "alias": "unitid"
              },
              {
                "table": "expense",
                "column": "category_id"
              },
              {
                "table": "expense",
                "column": "invoice_name"
              }
            ],
            "table": {
              "name": "expense"
            },
            "joins": [
              {
                "table": "sub_categories",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "sub_categories",
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
                "table": "collections",
                "column": "*",
                "alias": "C1",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "C1",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "unit"
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
                        "table": "sub_categories",
                        "column": "category_id"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "collections",
                "column": "*",
                "alias": "C2",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "C2",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "payment_type"
                      },
                      "operation": "="
                    }
                  ]
                }
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "expense.invoice_number",
                  "field": "expense.invoice_number",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.invoiceid}}",
                  "data": {
                    "table": "expense",
                    "column": "invoice_number",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT expense.invoice_number, expense.quantity, expense.purchase_date, expense.receipt_name, expense.receipt_url, expense.account, expense.payment_type, expense.remark, expense.amount, sub_categories.subcategory_name AS ItemName, C1.name AS Unit, C2.name AS PaymentType, expense.id AS Expense_ID, expense.unit AS unitid, expense.category_id, expense.invoice_name\nFROM expense\nLEFT JOIN sub_categories ON (sub_categories.id = expense.category_id) LEFT JOIN collections AS C1 ON (C1.id = expense.unit) LEFT JOIN categories ON (categories.id = sub_categories.category_id) LEFT JOIN collections AS C2 ON (C2.id = expense.payment_type)\nWHERE expense.invoice_number = :P1 /* {{$_GET.invoiceid}} */\nORDER BY expense.purchase_date DESC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.invoiceid}}"
              }
            ],
            "orders": [
              {
                "table": "expense",
                "column": "purchase_date",
                "direction": "DESC",
                "recid": 1
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "invoice_number",
            "type": "number"
          },
          {
            "name": "quantity",
            "type": "number"
          },
          {
            "name": "purchase_date",
            "type": "date"
          },
          {
            "name": "receipt_name",
            "type": "text"
          },
          {
            "name": "receipt_url",
            "type": "text"
          },
          {
            "name": "account",
            "type": "number"
          },
          {
            "name": "payment_type",
            "type": "number"
          },
          {
            "name": "remark",
            "type": "text"
          },
          {
            "name": "amount",
            "type": "number"
          },
          {
            "name": "ItemName",
            "type": "text"
          },
          {
            "name": "Unit",
            "type": "text"
          },
          {
            "name": "PaymentType",
            "type": "text"
          },
          {
            "name": "Expense_ID",
            "type": "number"
          },
          {
            "name": "unitid",
            "type": "number"
          },
          {
            "name": "category_id",
            "type": "number"
          },
          {
            "name": "invoice_name",
            "type": "text"
          }
        ],
        "outputType": "array",
        "type": "dbconnector_select"
      }
    ]
  }
}
JSON
);
?>