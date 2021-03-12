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
                  "type": "string",
                  "operator": "equal",
                  "value": "{{identity}}",
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
            "query": "SELECT id, account_owner, account_number, bank_name, type\nFROM account_master\nWHERE userid = :P1 /* {{identity}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{identity}}"
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
            "name": "account_owner",
            "type": "text"
          },
          {
            "name": "account_number",
            "type": "text"
          },
          {
            "name": "bank_name",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
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