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
    "$_POST": [
      {
        "type": "text",
        "name": "form_name"
      },
      {
        "type": "text",
        "name": "form_description"
      },
      {
        "type": "text",
        "name": "form_instructions"
      },
      {
        "type": "file",
        "name": "form_logo",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          },
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "number"
          },
          {
            "name": "error",
            "type": "text"
          }
        ],
        "outputType": "file"
      },
      {
        "type": "number",
        "name": "grid_size"
      },
      {
        "type": "number",
        "name": "is_edit"
      },
      {
        "type": "number",
        "name": "is_delete"
      },
      {
        "type": "datetime",
        "name": "is_active"
      },
      {
        "type": "datetime",
        "name": "is_deleted"
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
        "name": "uploadImage",
        "module": "upload",
        "action": "upload",
        "options": {
          "fields": "{{$_POST.form_logo}}",
          "path": "/assets/uploads/forms",
          "template": "{guid}{ext}",
          "replaceSpace": true
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "file"
      },
      {
        "name": "insertRecord",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "form_master",
                "column": "form_name",
                "type": "text",
                "value": "{{$_POST.form_name}}"
              },
              {
                "table": "form_master",
                "column": "form_description",
                "type": "text",
                "value": "{{$_POST.form_description}}"
              },
              {
                "table": "form_master",
                "column": "form_instructions",
                "type": "text",
                "value": "{{$_POST.form_instructions}}"
              },
              {
                "table": "form_master",
                "column": "form_logo",
                "type": "text",
                "value": "{{$_POST.form_logo.name}}"
              },
              {
                "table": "form_master",
                "column": "grid_size",
                "type": "number",
                "value": "{{$_POST.grid_size}}"
              },
              {
                "table": "form_master",
                "column": "is_edit",
                "type": "number",
                "value": "{{$_POST.is_edit}}"
              },
              {
                "table": "form_master",
                "column": "is_delete",
                "type": "number",
                "value": "{{$_POST.is_delete}}"
              }
            ],
            "table": "form_master",
            "query": "INSERT INTO form_master\n(form_name, form_description, form_instructions, form_logo, grid_size, is_edit, is_delete) VALUES (:P1 /* {{$_POST.form_name}} */, :P2 /* {{$_POST.form_description}} */, :P3 /* {{$_POST.form_instructions}} */, :P4 /* {{$_POST.form_logo.name}} */, :P5 /* {{$_POST.grid_size}} */, :P6 /* {{$_POST.is_edit}} */, :P7 /* {{$_POST.is_delete}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.form_name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.form_description}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.form_instructions}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.form_logo.name}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.grid_size}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.is_edit}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.is_delete}}"
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
      },
      {
        "name": "FormID",
        "module": "core",
        "action": "setvalue",
        "options": {
          "key": "FormID",
          "value": "{{insertRecord.identity}}"
        },
        "outputType": "number",
        "output": true
      }
    ]
  }
}
JSON
);
?>