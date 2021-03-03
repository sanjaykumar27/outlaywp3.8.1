<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "category_id"
      },
      {
        "type": "text",
        "name": "subcategory_name"
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
        "name": "insertItem",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "sub_categories",
                "column": "category_id",
                "type": "number",
                "value": "{{$_POST.category_id}}"
              },
              {
                "table": "sub_categories",
                "column": "subcategory_name",
                "type": "text",
                "value": "{{$_POST.subcategory_name}}"
              },
              {
                "table": "sub_categories",
                "column": "created_at",
                "type": "datetime",
                "value": "{{NOW}}"
              }
            ],
            "table": "sub_categories",
            "returning": "id",
            "query": "INSERT INTO sub_categories\n(category_id, subcategory_name, created_at) VALUES (:P1 /* {{$_POST.category_id}} */, :P2 /* {{$_POST.subcategory_name}} */, :P3 /* {{NOW}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.category_id}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.subcategory_name}}"
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
        ],
        "output": true
      }
    ]
  }
}
JSON
);
?>