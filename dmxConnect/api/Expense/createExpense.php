<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/Expense/spa_createExpense.php",
      "linkedForm": "CreateExpense"
    },
    "$_POST": [
      {
        "type": "number",
        "fieldName": "InvoiceNumber",
        "options": {
          "rules": {
            "core:number": {}
          }
        },
        "name": "InvoiceNumber"
      },
      {
        "type": "text",
        "fieldName": "InvoiceName",
        "name": "InvoiceName"
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
        "type": "text",
        "fieldName": "Remark",
        "name": "Remark"
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
        "type": "number",
        "fieldName": "Quantity[]",
        "multiple": true,
        "options": {
          "rules": {
            "core:number": {}
          }
        },
        "name": "Quantity"
      },
      {
        "type": "number",
        "fieldName": "Amount[]",
        "multiple": true,
        "options": {
          "rules": {
            "core:number": {}
          }
        },
        "name": "Amount"
      },
      {
        "type": "text",
        "fieldName": "AccountID",
        "name": "AccountID"
      },
      {
        "type": "text",
        "fieldName": "PaymentMethod",
        "name": "PaymentMethod"
      },
      {
        "type": "text",
        "fieldName": "ItemID[]",
        "multiple": true,
        "name": "ItemID"
      },
      {
        "type": "text",
        "fieldName": "UnitID[]",
        "multiple": true,
        "name": "UnitID"
      },
      {
        "type": "array",
        "name": "record",
        "sub": [
          {
            "type": "number",
            "name": "$parent"
          },
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
            "type": "text",
            "name": "receipt_url"
          },
          {
            "type": "text",
            "name": "receipt_name"
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
            "name": "deleted"
          },
          {
            "type": "number",
            "name": "$_POST"
          },
          {
            "type": "number",
            "name": "$value"
          },
          {
            "type": "number",
            "name": "insertExpense"
          },
          {
            "type": "datetime",
            "name": "NOW"
          },
          {
            "type": "number",
            "name": "ItemID"
          },
          {
            "type": "text",
            "name": "upload1"
          },
          {
            "type": "number",
            "name": "id"
          },
          {
            "type": "number",
            "name": "identity"
          },
          {
            "type": "text",
            "name": "uploadPhoto"
          }
        ]
      },
      {
        "type": "text",
        "fieldName": "NewItem[]",
        "multiple": true,
        "name": "NewItem"
      },
      {
        "type": "text",
        "name": "NewItem[$key]"
      },
      {
        "type": "number",
        "name": "Amount[$key]"
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
        "name": "uploadPhoto",
        "module": "upload",
        "action": "upload",
        "options": {
          "fields": "{{$_POST.target_photo[$key]}}",
          "path": "/assets/uploads",
          "template": "{guid}{ext}",
          "replaceSpace": true
        },
        "meta": [],
        "outputType": "file"
      },
      {
        "name": "repeat1",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{$_POST.UnitID}}",
          "exec": {
            "steps": [
              {
                "name": "",
                "module": "core",
                "action": "condition",
                "options": {
                  "if": "{{$_POST.NewItem[$key]}}",
                  "then": {
                    "steps": [
                      {
                        "name": "amount",
                        "module": "core",
                        "action": "setvalue",
                        "options": {
                          "key": "amount",
                          "value": "{{$_POST.Amount[$key] / $_POST.Quantity[$key]}}"
                        }
                      },
                      {
                        "name": "insertItem",
                        "module": "dbupdater",
                        "action": "insert",
                        "options": {
                          "connection": "ConnCS",
                          "sql": {
                            "type": "insert",
                            "values": [
                              {
                                "table": "sub_categories",
                                "column": "category_id",
                                "type": "number",
                                "value": "22"
                              },
                              {
                                "table": "sub_categories",
                                "column": "subcategory_name",
                                "type": "text",
                                "value": "{{$_POST.NewItem[$key]}}"
                              },
                              {
                                "table": "sub_categories",
                                "column": "default_price",
                                "type": "number",
                                "value": "{{amount}}"
                              },
                              {
                                "table": "sub_categories",
                                "column": "default_unit",
                                "type": "number",
                                "value": "{{$value}}"
                              },
                              {
                                "table": "sub_categories",
                                "column": "created_at",
                                "type": "datetime",
                                "value": "{{NOW}}"
                              }
                            ],
                            "table": "sub_categories",
                            "returning": "id",
                            "query": "INSERT INTO sub_categories\n(category_id, subcategory_name, default_price, default_unit, created_at) VALUES ('22', :P1 /* {{$_POST.NewItem[$key]}} */, :P2 /* {{amount}} */, :P3 /* {{$value}} */, :P4 /* {{NOW}} */)",
                            "params": [
                              {
                                "name": ":P1",
                                "type": "expression",
                                "value": "{{$_POST.NewItem[$key]}}"
                              },
                              {
                                "name": ":P2",
                                "type": "expression",
                                "value": "{{amount}}"
                              },
                              {
                                "name": ":P3",
                                "type": "expression",
                                "value": "{{$value}}"
                              },
                              {
                                "name": ":P4",
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
                        ],
                        "output": true
                      },
                      {
                        "name": "ItemID",
                        "module": "core",
                        "action": "setvalue",
                        "options": {
                          "key": "ItemID",
                          "value": "{{insertItem.identity}}"
                        },
                        "outputType": "number",
                        "output": true
                      }
                    ]
                  },
                  "else": {
                    "steps": {
                      "name": "ItemID",
                      "module": "core",
                      "action": "setvalue",
                      "options": {
                        "key": "ItemID",
                        "value": "{{$_POST.ItemID[$key]}}"
                      },
                      "outputType": "number",
                      "output": true
                    }
                  }
                },
                "outputType": "boolean"
              },
              {
                "name": "insertExpense",
                "module": "dbupdater",
                "action": "insert",
                "options": {
                  "connection": "ConnCS",
                  "sql": {
                    "type": "insert",
                    "values": [
                      {
                        "table": "expense",
                        "column": "user_id",
                        "type": "number",
                        "value": "{{identity}}"
                      },
                      {
                        "table": "expense",
                        "column": "category_id",
                        "type": "number",
                        "value": "{{ItemID}}"
                      },
                      {
                        "table": "expense",
                        "column": "invoice_number",
                        "type": "number",
                        "value": "{{$_POST.InvoiceNumber}}"
                      },
                      {
                        "table": "expense",
                        "column": "invoice_name",
                        "type": "text",
                        "value": "{{$_POST.InvoiceName}}"
                      },
                      {
                        "table": "expense",
                        "column": "quantity",
                        "type": "number",
                        "value": "{{$_POST.Quantity[$key]}}"
                      },
                      {
                        "table": "expense",
                        "column": "unit",
                        "type": "number",
                        "value": "{{$value}}"
                      },
                      {
                        "table": "expense",
                        "column": "purchase_date",
                        "type": "date",
                        "value": "{{$_POST.PurchaseDate}}"
                      },
                      {
                        "table": "expense",
                        "column": "receipt_url",
                        "type": "text",
                        "value": "{{uploadPhoto.path}}"
                      },
                      {
                        "table": "expense",
                        "column": "receipt_name",
                        "type": "text",
                        "value": "{{uploadPhoto.name}}"
                      },
                      {
                        "table": "expense",
                        "column": "account",
                        "type": "number",
                        "value": "{{$_POST.AccountID}}"
                      },
                      {
                        "table": "expense",
                        "column": "payment_type",
                        "type": "number",
                        "value": "{{$_POST.PaymentMethod}}"
                      },
                      {
                        "table": "expense",
                        "column": "remark",
                        "type": "text",
                        "value": "{{$_POST.Remark}}"
                      },
                      {
                        "table": "expense",
                        "column": "amount",
                        "type": "number",
                        "value": "{{$_POST.Amount[$key]}}"
                      },
                      {
                        "table": "expense",
                        "column": "created_on",
                        "type": "datetime",
                        "value": "{{NOW}}"
                      }
                    ],
                    "table": "expense",
                    "query": "INSERT INTO expense\n(user_id, category_id, invoice_number, invoice_name, quantity, unit, purchase_date, receipt_url, receipt_name, account, payment_type, remark, amount, created_on) VALUES (:P1 /* {{identity}} */, :P2 /* {{ItemID}} */, :P3 /* {{$_POST.InvoiceNumber}} */, :P4 /* {{$_POST.InvoiceName}} */, :P5 /* {{$_POST.Quantity[$key]}} */, :P6 /* {{$value}} */, :P7 /* {{$_POST.PurchaseDate}} */, :P8 /* {{uploadPhoto.path}} */, :P9 /* {{uploadPhoto.name}} */, :P10 /* {{$_POST.AccountID}} */, :P11 /* {{$_POST.PaymentMethod}} */, :P12 /* {{$_POST.Remark}} */, :P13 /* {{$_POST.Amount[$key]}} */, :P14 /* {{NOW}} */)",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{identity}}"
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{ItemID}}"
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{$_POST.InvoiceNumber}}"
                      },
                      {
                        "name": ":P4",
                        "type": "expression",
                        "value": "{{$_POST.InvoiceName}}"
                      },
                      {
                        "name": ":P5",
                        "type": "expression",
                        "value": "{{$_POST.Quantity[$key]}}"
                      },
                      {
                        "name": ":P6",
                        "type": "expression",
                        "value": "{{$value}}"
                      },
                      {
                        "name": ":P7",
                        "type": "expression",
                        "value": "{{$_POST.PurchaseDate}}"
                      },
                      {
                        "name": ":P8",
                        "type": "expression",
                        "value": "{{uploadPhoto.path}}"
                      },
                      {
                        "name": ":P9",
                        "type": "expression",
                        "value": "{{uploadPhoto.name}}"
                      },
                      {
                        "name": ":P10",
                        "type": "expression",
                        "value": "{{$_POST.AccountID}}"
                      },
                      {
                        "name": ":P11",
                        "type": "expression",
                        "value": "{{$_POST.PaymentMethod}}"
                      },
                      {
                        "name": ":P12",
                        "type": "expression",
                        "value": "{{$_POST.Remark}}"
                      },
                      {
                        "name": ":P13",
                        "type": "expression",
                        "value": "{{$_POST.Amount[$key]}}"
                      },
                      {
                        "name": ":P14",
                        "type": "expression",
                        "value": "{{NOW}}"
                      }
                    ],
                    "returning": "id"
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
              },
              {
                "name": "updateItem",
                "module": "dbupdater",
                "action": "update",
                "options": {
                  "connection": "ConnCS",
                  "sql": {
                    "type": "update",
                    "values": [
                      {
                        "table": "sub_categories",
                        "column": "default_price",
                        "type": "number",
                        "value": "{{$_POST.Amount[$key]/$_POST.Quantity[$key]}}"
                      },
                      {
                        "table": "sub_categories",
                        "column": "default_unit",
                        "type": "number",
                        "value": "{{$value}}"
                      },
                      {
                        "table": "sub_categories",
                        "column": "updated_at",
                        "type": "datetime",
                        "value": "{{NOW}}"
                      }
                    ],
                    "table": "sub_categories",
                    "wheres": {
                      "condition": "AND",
                      "rules": [
                        {
                          "id": "id",
                          "field": "id",
                          "type": "double",
                          "operator": "equal",
                          "value": "{{ItemID}}",
                          "data": {
                            "column": "id"
                          },
                          "operation": "="
                        }
                      ],
                      "conditional": null,
                      "valid": true
                    },
                    "query": "UPDATE sub_categories\nSET default_price = :P1 /* {{$_POST.Amount[$key]/$_POST.Quantity[$key]}} */, default_unit = :P2 /* {{$value}} */, updated_at = :P3 /* {{NOW}} */\nWHERE id = :P4 /* {{ItemID}} */",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.Amount[$key]/$_POST.Quantity[$key]}}"
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$value}}"
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{NOW}}"
                      },
                      {
                        "operator": "equal",
                        "type": "expression",
                        "name": ":P4",
                        "value": "{{ItemID}}"
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
              },
              {
                "name": "insertAccountTransaction",
                "module": "dbupdater",
                "action": "insert",
                "options": {
                  "connection": "ConnCS",
                  "sql": {
                    "type": "insert",
                    "values": [
                      {
                        "table": "account_transaction",
                        "column": "account_id",
                        "type": "number",
                        "value": "{{$_POST.AccountID}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "debit",
                        "type": "number",
                        "value": "{{$_POST.Amount[$key]}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "date_of_transaction",
                        "type": "date",
                        "value": "{{$_POST.PurchaseDate}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "expense_id",
                        "type": "number",
                        "value": "{{insertExpense.identity}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "type",
                        "type": "number",
                        "value": "{{$_POST.PaymentMethod}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "transaction_detail",
                        "type": "text",
                        "value": "Expense Transaction"
                      },
                      {
                        "table": "account_transaction",
                        "column": "created_at",
                        "type": "datetime",
                        "value": "{{NOW}}"
                      }
                    ],
                    "table": "account_transaction",
                    "query": "INSERT INTO account_transaction\n(account_id, debit, date_of_transaction, expense_id, type, transaction_detail, created_at) VALUES (:P1 /* {{$_POST.AccountID}} */, :P2 /* {{$_POST.Amount[$key]}} */, :P3 /* {{$_POST.PurchaseDate}} */, :P4 /* {{insertExpense.identity}} */, :P5 /* {{$_POST.PaymentMethod}} */, 'Expense Transaction', :P6 /* {{NOW}} */)",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.AccountID}}"
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$_POST.Amount[$key]}}"
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{$_POST.PurchaseDate}}"
                      },
                      {
                        "name": ":P4",
                        "type": "expression",
                        "value": "{{insertExpense.identity}}"
                      },
                      {
                        "name": ":P5",
                        "type": "expression",
                        "value": "{{$_POST.PaymentMethod}}"
                      },
                      {
                        "name": ":P6",
                        "type": "expression",
                        "value": "{{NOW}}"
                      }
                    ],
                    "returning": "id"
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
            "name": "insertItem",
            "type": "text",
            "sub": [
              {
                "name": "identity",
                "type": "text"
              },
              {
                "name": "affected",
                "type": "number"
              }
            ]
          },
          {
            "name": "ItemID",
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