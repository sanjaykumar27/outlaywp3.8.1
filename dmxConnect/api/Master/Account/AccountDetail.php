<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "number",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "accountid"
      },
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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
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
          "provider": "SecurityCS",
          "permissions": [
            "Active"
          ]
        }
      },
      {
        "name": "TransactionMethod",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "collections",
                "column": "id"
              },
              {
                "table": "collections",
                "column": "name"
              }
            ],
            "table": {
              "name": "collections"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "collections.collectiontype_id",
                  "field": "collections.collectiontype_id",
                  "type": "double",
                  "operator": "equal",
                  "value": 5,
                  "data": {
                    "table": "collections",
                    "column": "collectiontype_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT id, name\nFROM collections\nWHERE collectiontype_id = 5",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "id",
            "type": "text"
          },
          {
            "name": "name",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "getDetails",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "account_transaction",
                "column": "credit",
                "alias": "Credit"
              },
              {
                "table": "account_transaction",
                "column": "debit",
                "alias": "Debit"
              },
              {
                "table": "account_transaction",
                "column": "date_of_transaction",
                "alias": "TransactionDate"
              },
              {
                "table": "account_transaction",
                "column": "expense_id",
                "alias": "ExpenseID"
              },
              {
                "table": "account_transaction",
                "column": "to_account"
              },
              {
                "table": "account_transaction",
                "column": "transaction_detail",
                "alias": "TransactionDetail"
              },
              {
                "table": "account_transaction",
                "column": "created_at",
                "alias": "CreatedAt"
              },
              {
                "table": "collections",
                "column": "name",
                "alias": "TransactionType"
              },
              {
                "table": "TA",
                "column": "account_number",
                "alias": "ToAccount"
              },
              {
                "table": "FA",
                "column": "account_number",
                "alias": "FromAccount"
              }
            ],
            "table": {
              "name": "account_transaction"
            },
            "joins": [
              {
                "table": "collections",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "collections",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "account_transaction",
                        "column": "type"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "account_master",
                "column": "*",
                "alias": "TA",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "TA",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "account_transaction",
                        "column": "to_account"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "account_master",
                "column": "*",
                "alias": "FA",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "FA",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "account_transaction",
                        "column": "from_account"
                      },
                      "operation": "="
                    }
                  ]
                }
              }
            ],
            "query": "SELECT account_transaction.credit AS Credit, account_transaction.debit AS Debit, account_transaction.date_of_transaction AS TransactionDate, account_transaction.expense_id AS ExpenseID, account_transaction.to_account, account_transaction.transaction_detail AS TransactionDetail, account_transaction.created_at AS CreatedAt, collections.name AS TransactionType, TA.account_number AS ToAccount, FA.account_number AS FromAccount\nFROM account_transaction\nLEFT JOIN collections ON (collections.id = account_transaction.type) LEFT JOIN account_master AS TA ON (TA.id = account_transaction.to_account) LEFT JOIN account_master AS FA ON (FA.id = account_transaction.from_account)\nWHERE account_transaction.account_id = :P1 /* {{$_GET.accountid}} */\nORDER BY account_transaction.date_of_transaction DESC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.accountid}}"
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "account_transaction.account_id",
                  "field": "account_transaction.account_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.accountid}}",
                  "data": {
                    "table": "account_transaction",
                    "column": "account_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "orders": [
              {
                "table": "account_transaction",
                "column": "date_of_transaction",
                "direction": "DESC",
                "recid": 1
              }
            ]
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
                "name": "Credit",
                "type": "number"
              },
              {
                "name": "Debit",
                "type": "number"
              },
              {
                "name": "TransactionDate",
                "type": "date"
              },
              {
                "name": "ExpenseID",
                "type": "number"
              },
              {
                "name": "to_account",
                "type": "text"
              },
              {
                "name": "TransactionDetail",
                "type": "text"
              },
              {
                "name": "CreatedAt",
                "type": "datetime"
              },
              {
                "name": "TransactionType",
                "type": "text"
              },
              {
                "name": "ToAccount",
                "type": "text"
              },
              {
                "name": "FromAccount",
                "type": "text"
              }
            ]
          }
        ],
        "outputType": "object",
        "type": "dbconnector_paged_select"
      },
      {
        "name": "AccountDetails",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "account_master",
                "column": "account_owner"
              },
              {
                "table": "account_master",
                "column": "account_number"
              },
              {
                "table": "account_master",
                "column": "bank_name"
              },
              {
                "table": "account_master",
                "column": "ifsc_code"
              },
              {
                "table": "account_master",
                "column": "address"
              },
              {
                "table": "user",
                "column": "first_name"
              },
              {
                "table": "user",
                "column": "last_name"
              },
              {
                "table": "account_master",
                "column": "id",
                "alias": "AccountID"
              }
            ],
            "table": {
              "name": "account_master"
            },
            "joins": [
              {
                "table": "user",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "user",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "account_master",
                        "column": "account_owner"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "collections",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "collections",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "account_master",
                        "column": "type"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "account_transaction",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "account_transaction",
                      "column": "account_id",
                      "operator": "equal",
                      "value": {
                        "table": "account_master",
                        "column": "id"
                      },
                      "operation": "="
                    }
                  ]
                }
              }
            ],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "account_master.id",
                  "field": "account_master.id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.accountid}}",
                  "data": {
                    "table": "account_master",
                    "column": "id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT account_master.account_owner, account_master.account_number, account_master.bank_name, account_master.ifsc_code, account_master.address, user.first_name, user.last_name, account_master.id AS AccountID\nFROM account_master\nLEFT JOIN user ON (user.id = account_master.account_owner) LEFT JOIN collections ON (collections.id = account_master.type) LEFT JOIN account_transaction ON (account_transaction.account_id = account_master.id)\nWHERE account_master.id = :P1 /* {{$_GET.accountid}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.accountid}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "account_owner",
            "type": "text"
          },
          {
            "name": "account_number",
            "type": "text"
          },
          {
            "name": "bank_name",
            "type": "text"
          },
          {
            "name": "ifsc_code",
            "type": "text"
          },
          {
            "name": "address",
            "type": "text"
          },
          {
            "name": "first_name",
            "type": "text"
          },
          {
            "name": "last_name",
            "type": "text"
          },
          {
            "name": "AccountID",
            "type": "text"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "TotalDebit",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "account_transaction",
                "column": "debit",
                "alias": "TotalDebit",
                "aggregate": "SUM"
              }
            ],
            "groupBy": [],
            "table": {
              "name": "account_transaction"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "account_transaction.account_id",
                  "field": "account_transaction.account_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.accountid}}",
                  "data": {
                    "table": "account_transaction",
                    "column": "account_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT SUM(debit) AS TotalDebit\nFROM account_transaction\nWHERE account_id = :P1 /* {{$_GET.accountid}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.accountid}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "TotalDebit",
            "type": "number"
          }
        ],
        "outputType": "object"
      },
      {
        "name": "TotalCredit",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "account_transaction",
                "column": "credit",
                "alias": "TotalCredit",
                "aggregate": "SUM"
              }
            ],
            "groupBy": [],
            "table": {
              "name": "account_transaction"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "account_transaction.account_id",
                  "field": "account_transaction.account_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.accountid}}",
                  "data": {
                    "table": "account_transaction",
                    "column": "account_id",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT SUM(credit) AS TotalCredit\nFROM account_transaction\nWHERE account_id = :P1 /* {{$_GET.accountid}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.accountid}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "TotalCredit",
            "type": "number"
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