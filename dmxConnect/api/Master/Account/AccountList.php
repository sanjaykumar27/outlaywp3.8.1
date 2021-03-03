<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
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
        "name": "getList",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "account_master",
                "column": "account_number",
                "alias": "AccountNumber"
              },
              {
                "table": "account_master",
                "column": "bank_name",
                "alias": "BankName"
              },
              {
                "table": "user",
                "column": "first_name",
                "alias": "FirstName",
                "aggregate": ""
              },
              {
                "table": "user",
                "column": "last_name",
                "alias": "LastName"
              },
              {
                "table": "collections",
                "column": "name",
                "alias": "AccountType",
                "aggregate": ""
              },
              {
                "table": "account_master",
                "column": "id",
                "alias": "AccountID"
              }
            ],
            "table": {
              "name": "account_master"
            },
            "joins": [
              {
                "table": "user",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "user",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "account_master",
                        "column": "account_owner"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "collections",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "collections",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "account_master",
                        "column": "type"
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
                  "id": "account_master.userid",
                  "field": "account_master.userid",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{SecurityCS.identity}}",
                  "data": {
                    "table": "account_master",
                    "column": "userid",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT account_master.account_number AS AccountNumber, account_master.bank_name AS BankName, user.first_name AS FirstName, user.last_name AS LastName, collections.name AS AccountType, account_master.id AS AccountID\nFROM account_master\nLEFT JOIN user ON (user.id = account_master.account_owner) LEFT JOIN collections ON (collections.id = account_master.type)\nWHERE account_master.userid = :P1 /* {{SecurityCS.identity}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{SecurityCS.identity}}"
              }
            ]
          }
        },
        "output": true,
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
                "name": "AccountNumber",
                "type": "number"
              },
              {
                "name": "BankName",
                "type": "text"
              },
              {
                "name": "FirstName",
                "type": "text"
              },
              {
                "name": "LastName",
                "type": "text"
              },
              {
                "name": "AccountType",
                "type": "text"
              },
              {
                "name": "AccountID",
                "type": "number"
              }
            ]
          }
        ],
        "outputType": "object"
      }
    ]
  }
}
JSON
);
?>