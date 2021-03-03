<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {},
    "$_POST": [
      {
        "type": "number",
        "name": "target_id"
      },
      {
        "type": "number",
        "name": "credit"
      },
      {
        "type": "number",
        "name": "debit"
      },
      {
        "type": "datetime",
        "name": "created_on"
      },
      {
        "type": "text",
        "name": "transaction_type"
      },
      {
        "type": "text",
        "name": "amount"
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
          "if": "{{$_POST.transaction_type == 'credit'}}",
          "then": {
            "steps": {
              "name": "InsertTransaction",
              "module": "dbupdater",
              "action": "insert",
              "options": {
                "connection": "ConnCS",
                "sql": {
                  "type": "insert",
                  "values": [
                    {
                      "table": "target_transaction",
                      "column": "target_id",
                      "type": "number",
                      "value": "{{$_POST.target_id}}"
                    },
                    {
                      "table": "target_transaction",
                      "column": "credit",
                      "type": "number",
                      "value": "{{$_POST.amount}}"
                    },
                    {
                      "table": "target_transaction",
                      "column": "created_on",
                      "type": "datetime",
                      "value": "{{NOW}}"
                    }
                  ],
                  "table": "target_transaction",
                  "query": "INSERT INTO target_transaction\n(target_id, credit, created_on) VALUES (:P1 /* {{$_POST.target_id}} */, :P2 /* {{$_POST.amount}} */, :P3 /* {{NOW}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.target_id}}"
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{$_POST.amount}}"
                    },
                    {
                      "name": ":P3",
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
          },
          "else": {
            "steps": {
              "name": "InsertTransaction",
              "module": "dbupdater",
              "action": "insert",
              "options": {
                "connection": "ConnCS",
                "sql": {
                  "type": "insert",
                  "values": [
                    {
                      "table": "target_transaction",
                      "column": "target_id",
                      "type": "number",
                      "value": "{{$_POST.target_id}}"
                    },
                    {
                      "table": "target_transaction",
                      "column": "created_on",
                      "type": "datetime",
                      "value": "{{NOW}}"
                    },
                    {
                      "table": "target_transaction",
                      "column": "debit",
                      "type": "number",
                      "value": "{{$_POST.amount}}"
                    }
                  ],
                  "table": "target_transaction",
                  "query": "INSERT INTO target_transaction\n(target_id, created_on, debit) VALUES (:P1 /* {{$_POST.target_id}} */, :P2 /* {{NOW}} */, :P3 /* {{$_POST.amount}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.target_id}}"
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{NOW}}"
                    },
                    {
                      "name": ":P3",
                      "type": "expression",
                      "value": "{{$_POST.amount}}"
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