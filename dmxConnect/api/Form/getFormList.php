<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {},
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
                "table": "form_master",
                "column": "form_id"
              },
              {
                "table": "form_master",
                "column": "form_name"
              },
              {
                "table": "form_master",
                "column": "form_logo"
              },
              {
                "table": "form_master",
                "column": "form_description"
              },
              {
                "table": "form_master",
                "column": "grid_size"
              }
            ],
            "table": {
              "name": "form_master"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "form_master.is_deleted",
                  "field": "form_master.is_deleted",
                  "type": "datetime",
                  "operator": "is_null",
                  "value": null,
                  "data": {
                    "table": "form_master",
                    "column": "is_deleted",
                    "type": "datetime"
                  },
                  "operation": "IS NULL"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT form_id, form_name, form_logo, form_description, grid_size\nFROM form_master\nWHERE is_deleted IS NULL",
            "params": []
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
                "name": "form_id",
                "type": "number"
              },
              {
                "name": "form_name",
                "type": "text"
              },
              {
                "name": "form_logo",
                "type": "text"
              },
              {
                "name": "form_description",
                "type": "text"
              },
              {
                "name": "grid_size",
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