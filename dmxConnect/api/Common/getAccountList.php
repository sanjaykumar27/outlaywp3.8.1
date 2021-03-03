<?php
require('../../../dmxConnectLib/dmxConnect.php');


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
        "name": "queryAccountList",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "account_master",
                "column": "id"
              },
              {
                "table": "account_master",
                "column": "account_owner"
              },
              {
                "table": "account_master",
                "column": "account_number"
              },
              {
                "table": "account_master",
                "column": "bank_name"
              },
              {
                "table": "account_master",
                "column": "type"
              }
            ],
            "table": {
              "name": "account_master"
            },
            "joins": [],
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
            "query": "SELECT id, account_owner, account_number, bank_name, type\nFROM account_master\nWHERE userid = :P1 /* {{SecurityCS.identity}} */",
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
            "name": "id",
            "type": "number"
          },
          {
            "name": "account_owner",
            "type": "number"
          },
          {
            "name": "account_number",
            "type": "number"
          },
          {
            "name": "bank_name",
            "type": "text"
          },
          {
            "name": "type",
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