<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "CategoryID"
      },
      {
        "type": "text",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "ItemName"
      },
      {
        "type": "text",
        "name": "SubCatID"
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
        "name": "updateCategory",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "sub_categories",
                "column": "category_id",
                "type": "number",
                "value": "{{$_POST.CategoryID}}"
              },
              {
                "table": "sub_categories",
                "column": "subcategory_name",
                "type": "text",
                "value": "{{$_POST.ItemName}}"
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
                  "value": "{{$_POST.SubCatID}}",
                  "data": {
                    "column": "id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "UPDATE sub_categories\nSET category_id = :P1 /* {{$_POST.CategoryID}} */, subcategory_name = :P2 /* {{$_POST.ItemName}} */\nWHERE id = :P3 /* {{$_POST.SubCatID}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.CategoryID}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.ItemName}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_POST.SubCatID}}"
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
    ]
  }
}
JSON
);
?>