<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "name"
      },
      {
        "type": "number",
        "name": "folio_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "pinned_mutual_funds",
                "column": "folio_id"
              }
            ],
            "table": {
              "name": "pinned_mutual_funds"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "pinned_mutual_funds.folio_id",
                  "field": "pinned_mutual_funds.folio_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.folio_id}}",
                  "data": {
                    "table": "pinned_mutual_funds",
                    "column": "folio_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT folio_id\nFROM pinned_mutual_funds\nWHERE folio_id = :P1 /* {{$_POST.folio_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_POST.folio_id}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "folio_id",
            "type": "number"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{query.folio_id}}",
          "then": {
            "steps": {
              "name": "delete",
              "module": "dbupdater",
              "action": "delete",
              "options": {
                "connection": "ConnCS",
                "sql": {
                  "type": "delete",
                  "table": "pinned_mutual_funds",
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "folio_id",
                        "field": "folio_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{$_POST.folio_id}}",
                        "data": {
                          "column": "folio_id"
                        },
                        "operation": "="
                      }
                    ],
                    "conditional": null,
                    "valid": true
                  },
                  "query": "DELETE\nFROM pinned_mutual_funds\nWHERE folio_id = :P1 /* {{$_POST.folio_id}} */",
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{$_POST.folio_id}}"
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
              "name": "insert",
              "module": "dbupdater",
              "action": "insert",
              "options": {
                "connection": "ConnCS",
                "sql": {
                  "type": "insert",
                  "values": [
                    {
                      "table": "pinned_mutual_funds",
                      "column": "name",
                      "type": "text",
                      "value": "{{$_POST.name}}"
                    },
                    {
                      "table": "pinned_mutual_funds",
                      "column": "folio_id",
                      "type": "number",
                      "value": "{{$_POST.folio_id}}"
                    }
                  ],
                  "table": "pinned_mutual_funds",
                  "returning": "folio_id",
                  "query": "INSERT INTO pinned_mutual_funds\n(name, folio_id) VALUES (:P1 /* {{$_POST.name}} */, :P2 /* {{$_POST.folio_id}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.name}}"
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{$_POST.folio_id}}"
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