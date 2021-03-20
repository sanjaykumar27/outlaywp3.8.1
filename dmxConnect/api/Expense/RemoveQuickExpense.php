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
      }
    ]
  },
  "exec": {
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
  }
}
JSON
);
?>