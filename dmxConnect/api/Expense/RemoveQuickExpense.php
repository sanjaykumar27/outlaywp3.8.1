<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "id"
      },
      {
        "type": "text",
        "name": "type"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "",
      "module": "core",
      "action": "condition",
      "options": {
        "if": "{{$_GET.type == 'new'}}",
        "then": {
          "steps": {
            "name": "RemoveItem",
            "module": "dbupdater",
            "action": "delete",
            "options": {
              "connection": "ConnCS",
              "sql": {
                "type": "delete",
                "table": "quick_expense",
                "wheres": {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense_id",
                      "field": "expense_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.id}}",
                      "data": {
                        "column": "expense_id"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": null,
                  "valid": true
                },
                "query": "DELETE\nFROM quick_expense\nWHERE expense_id = :P1 /* {{$_GET.id}} */",
                "params": [
                  {
                    "operator": "equal",
                    "type": "expression",
                    "name": ":P1",
                    "value": "{{$_GET.id}}"
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
        },
        "else": {
          "steps": {
            "name": "RemoveItem",
            "module": "dbupdater",
            "action": "delete",
            "options": {
              "connection": "ConnCS",
              "sql": {
                "type": "delete",
                "table": "nnnnn___money_manager",
                "wheres": {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "ID",
                      "field": "ID",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.id}}",
                      "data": {
                        "column": "ID"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": null,
                  "valid": true
                },
                "query": "DELETE\nFROM nnnnn___money_manager\nWHERE ID = :P1 /* {{$_GET.id}} */",
                "params": [
                  {
                    "operator": "equal",
                    "type": "expression",
                    "name": ":P1",
                    "value": "{{$_GET.id}}"
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
      },
      "outputType": "boolean"
    }
  }
}
JSON
);
?>