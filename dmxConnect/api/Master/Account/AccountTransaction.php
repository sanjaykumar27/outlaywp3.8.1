<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "TransactionType"
      },
      {
        "type": "date",
        "name": "TransactionDate"
      },
      {
        "type": "number",
        "name": "Amount"
      },
      {
        "type": "number",
        "name": "TransactionMethod"
      },
      {
        "type": "number",
        "name": "AccountTo"
      },
      {
        "type": "text",
        "name": "TransactionDetails"
      },
      {
        "type": "date",
        "name": "created_at"
      },
      {
        "type": "number",
        "name": "AccountFrom"
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
          "if": "{{$_POST.TransactionMethod == 22 || $_POST.TransactionMethod == 25}}",
          "then": {
            "steps": {
              "name": "insertTransaction",
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
                      "value": "{{$_POST.AccountTo}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "date_of_transaction",
                      "type": "date",
                      "value": "{{$_POST.TransactionDate}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "type",
                      "type": "number",
                      "value": "{{$_POST.TransactionMethod}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "created_at",
                      "type": "datetime",
                      "value": "{{NOW}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "from_account",
                      "type": "number",
                      "value": "{{$_POST.AccountFrom}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "credit",
                      "type": "number",
                      "value": "{{$_POST.Amount}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "transaction_detail",
                      "type": "text",
                      "value": "{{$_POST.TransactionDetails}}"
                    }
                  ],
                  "table": "account_transaction",
                  "returning": "id",
                  "query": "INSERT INTO account_transaction\n(account_id, date_of_transaction, type, created_at, from_account, credit, transaction_detail) VALUES (:P1 /* {{$_POST.AccountTo}} */, :P2 /* {{$_POST.TransactionDate}} */, :P3 /* {{$_POST.TransactionMethod}} */, :P4 /* {{NOW}} */, :P5 /* {{$_POST.AccountFrom}} */, :P6 /* {{$_POST.Amount}} */, :P7 /* {{$_POST.TransactionDetails}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.AccountTo}}"
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{$_POST.TransactionDate}}"
                    },
                    {
                      "name": ":P3",
                      "type": "expression",
                      "value": "{{$_POST.TransactionMethod}}"
                    },
                    {
                      "name": ":P4",
                      "type": "expression",
                      "value": "{{NOW}}"
                    },
                    {
                      "name": ":P5",
                      "type": "expression",
                      "value": "{{$_POST.AccountFrom}}"
                    },
                    {
                      "name": ":P6",
                      "type": "expression",
                      "value": "{{$_POST.Amount}}"
                    },
                    {
                      "name": ":P7",
                      "type": "expression",
                      "value": "{{$_POST.TransactionDetails}}"
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
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{$_POST.TransactionType == 'Debit'}}",
          "then": {
            "steps": [
              {
                "name": "",
                "module": "core",
                "action": "condition",
                "options": {
                  "if": "{{$_POST.TransactionMethod == 22 || $_POST.TransactionMethod == 25}}",
                  "then": {
                    "steps": {
                      "name": "AccountTo",
                      "module": "core",
                      "action": "setvalue",
                      "options": {
                        "key": "AccountTo",
                        "value": "{{$_POST.AccountTo}}"
                      },
                      "outputType": "number",
                      "output": true
                    }
                  },
                  "else": {
                    "steps": {
                      "name": "AccountTo",
                      "module": "core",
                      "action": "setvalue",
                      "options": {
                        "key": "AccountTo",
                        "value": "{{null}}"
                      },
                      "outputType": "number",
                      "output": true
                    }
                  }
                },
                "outputType": "boolean"
              },
              {
                "name": "insertTransaction",
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
                        "value": "{{$_POST.AccountFrom}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "date_of_transaction",
                        "type": "date",
                        "value": "{{$_POST.TransactionDate}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "type",
                        "type": "number",
                        "value": "{{$_POST.TransactionMethod}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "created_at",
                        "type": "datetime",
                        "value": "{{NOW}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "transaction_detail",
                        "type": "text",
                        "value": "{{$_POST.TransactionDetails}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "debit",
                        "type": "number",
                        "value": "{{$_POST.Amount}}"
                      },
                      {
                        "table": "account_transaction",
                        "column": "to_account",
                        "type": "number",
                        "value": "{{AccountTo}}"
                      }
                    ],
                    "table": "account_transaction",
                    "returning": "id",
                    "query": "INSERT INTO account_transaction\n(account_id, date_of_transaction, type, created_at, transaction_detail, debit, to_account) VALUES (:P1 /* {{$_POST.AccountFrom}} */, :P2 /* {{$_POST.TransactionDate}} */, :P3 /* {{$_POST.TransactionMethod}} */, :P4 /* {{NOW}} */, :P5 /* {{$_POST.TransactionDetails}} */, :P6 /* {{$_POST.Amount}} */, :P7 /* {{AccountTo}} */)",
                    "params": [
                      {
                        "name": ":P1",
                        "type": "expression",
                        "value": "{{$_POST.AccountFrom}}"
                      },
                      {
                        "name": ":P2",
                        "type": "expression",
                        "value": "{{$_POST.TransactionDate}}"
                      },
                      {
                        "name": ":P3",
                        "type": "expression",
                        "value": "{{$_POST.TransactionMethod}}"
                      },
                      {
                        "name": ":P4",
                        "type": "expression",
                        "value": "{{NOW}}"
                      },
                      {
                        "name": ":P5",
                        "type": "expression",
                        "value": "{{$_POST.TransactionDetails}}"
                      },
                      {
                        "name": ":P6",
                        "type": "expression",
                        "value": "{{$_POST.Amount}}"
                      },
                      {
                        "name": ":P7",
                        "type": "expression",
                        "value": "{{AccountTo}}"
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
          },
          "else": {
            "steps": {
              "name": "insertTransaction",
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
                      "value": "{{$_POST.AccountFrom}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "date_of_transaction",
                      "type": "date",
                      "value": "{{$_POST.TransactionDate}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "type",
                      "type": "number",
                      "value": "{{$_POST.TransactionMethod}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "created_at",
                      "type": "datetime",
                      "value": "{{NOW}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "transaction_detail",
                      "type": "text",
                      "value": "{{$_POST.TransactionDetails}}"
                    },
                    {
                      "table": "account_transaction",
                      "column": "credit",
                      "type": "number",
                      "value": "{{$_POST.Amount}}"
                    }
                  ],
                  "table": "account_transaction",
                  "returning": "id",
                  "query": "INSERT INTO account_transaction\n(account_id, date_of_transaction, type, created_at, transaction_detail, credit) VALUES (:P1 /* {{$_POST.AccountFrom}} */, :P2 /* {{$_POST.TransactionDate}} */, :P3 /* {{$_POST.TransactionMethod}} */, :P4 /* {{NOW}} */, :P5 /* {{$_POST.TransactionDetails}} */, :P6 /* {{$_POST.Amount}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.AccountFrom}}"
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{$_POST.TransactionDate}}"
                    },
                    {
                      "name": ":P3",
                      "type": "expression",
                      "value": "{{$_POST.TransactionMethod}}"
                    },
                    {
                      "name": ":P4",
                      "type": "expression",
                      "value": "{{NOW}}"
                    },
                    {
                      "name": ":P5",
                      "type": "expression",
                      "value": "{{$_POST.TransactionDetails}}"
                    },
                    {
                      "name": ":P6",
                      "type": "expression",
                      "value": "{{$_POST.Amount}}"
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
          }
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON
);
?>