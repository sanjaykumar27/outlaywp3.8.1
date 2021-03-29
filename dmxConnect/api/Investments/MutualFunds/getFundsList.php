<?php
require('../../../../dmxConnectLib/dmxConnect.php');


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
      },
      {
        "type": "text",
        "name": "query"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "getList",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "ConnCS",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "amfi_metadata"
          },
          "joins": [],
          "query": "SELECT *\nFROM amfi_metadata\nWHERE name LIKE :P1 /* {{$_GET.query}} */",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.query}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "amfi_metadata.name",
                "field": "amfi_metadata.name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.query}}",
                "data": {
                  "table": "amfi_metadata",
                  "column": "name",
                  "type": "text"
                },
                "operation": "LIKE"
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "output": true,
      "meta": [
        {
          "name": "fund_id",
          "type": "number"
        },
        {
          "name": "code",
          "type": "number"
        },
        {
          "name": "name",
          "type": "text"
        },
        {
          "name": "description",
          "type": "file"
        },
        {
          "name": "refreshed_at",
          "type": "file"
        },
        {
          "name": "from_date",
          "type": "text"
        },
        {
          "name": "to_date",
          "type": "text"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>