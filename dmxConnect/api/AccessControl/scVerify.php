<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
[
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
    "name": "a",
    "module": "core",
    "action": "setvalue",
    "options": {
      "value": "{{identity}}"
    },
    "output": true
  },
  {
    "name": "",
    "module": "core",
    "action": "condition",
    "options": {
      "if": "{{identity}}",
      "then": {
        "steps": {
          "name": "a",
          "module": "core",
          "action": "setvalue",
          "options": {
            "value": "a"
          }
        }
      },
      "else": {
        "steps": {
          "name": "Response",
          "module": "core",
          "action": "response",
          "options": {
            "status": 401,
            "data": "Unauthorized"
          }
        }
      }
    },
    "outputType": "boolean"
  }
]
JSON
);
?>