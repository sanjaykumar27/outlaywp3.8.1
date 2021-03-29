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
          "provider": "SecurityCS"
        }
      },
      {
        "name": "folio_ids",
        "module": "core",
        "action": "setvalue",
        "options": {
          "key": "folio_ids",
          "value": "{{null}}"
        },
        "output": true
      },
      {
        "name": "getSavedFunds",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "pinned_mutual_funds"
            },
            "joins": [],
            "query": "SELECT *\nFROM pinned_mutual_funds",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "folio_id",
            "type": "number"
          },
          {
            "name": "name",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{getSavedFunds}}",
          "outputFields": [],
          "exec": {
            "steps": {
              "name": "folio_ids",
              "module": "core",
              "action": "setvalue",
              "options": {
                "key": "folio_ids",
                "value": "{{folio_ids +','+folio_id}}"
              },
              "output": true,
              "outputType": "array"
            }
          }
        },
        "output": true,
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          },
          {
            "name": "folio_id",
            "type": "number"
          },
          {
            "name": "name",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "folio_ids",
        "module": "core",
        "action": "setvalue",
        "options": {
          "key": "folio_ids",
          "value": "{{folio_ids}}"
        },
        "output": true,
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>