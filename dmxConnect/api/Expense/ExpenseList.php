<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
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
      },
      {
        "type": "text",
        "name": "categoryid"
      },
      {
        "type": "text",
        "name": "itemid"
      },
      {
        "type": "text",
        "name": "currentmonth"
      },
      {
        "type": "text",
        "name": "crstartdate"
      },
      {
        "type": "text",
        "name": "crenddate"
      },
      {
        "type": "text",
        "name": "date"
      },
      {
        "type": "text",
        "name": "startdate"
      },
      {
        "type": "text",
        "name": "enddate"
      },
      {
        "type": "number",
        "name": "newexpense"
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
        "name": "queryExpenseList",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "expense",
                "column": "invoice_number"
              },
              {
                "table": "expense",
                "column": "quantity"
              },
              {
                "table": "expense",
                "column": "purchase_date"
              },
              {
                "table": "expense",
                "column": "receipt_name"
              },
              {
                "table": "expense",
                "column": "receipt_url"
              },
              {
                "table": "expense",
                "column": "account"
              },
              {
                "table": "expense",
                "column": "payment_type"
              },
              {
                "table": "expense",
                "column": "remark"
              },
              {
                "table": "expense",
                "column": "amount"
              },
              {
                "table": "sub_categories",
                "column": "subcategory_name",
                "alias": "ItemName"
              },
              {
                "table": "C1",
                "column": "name",
                "alias": "Unit"
              },
              {
                "table": "C2",
                "column": "name",
                "alias": "PaymentType"
              },
              {
                "table": "expense",
                "column": "id",
                "alias": "Expense_ID"
              },
              {
                "table": "expense",
                "column": "unit",
                "alias": "unitid"
              },
              {
                "table": "expense",
                "column": "category_id"
              },
              {
                "table": "expense",
                "column": "invoice_name"
              },
              {
                "table": "categories",
                "column": "category_name"
              }
            ],
            "table": {
              "name": "expense"
            },
            "joins": [
              {
                "table": "sub_categories",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "sub_categories",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "category_id"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "collections",
                "column": "*",
                "alias": "C1",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "C1",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "unit"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "categories",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "categories",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "sub_categories",
                        "column": "category_id"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "collections",
                "column": "*",
                "alias": "C2",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "C2",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "payment_type"
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
                  "id": "expense.user_id",
                  "field": "expense.user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{SecurityCS.identity}}",
                  "data": {
                    "table": "expense",
                    "column": "user_id",
                    "type": "number"
                  },
                  "operation": "="
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "sub_categories.category_id",
                      "field": "sub_categories.category_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.categoryid}}",
                      "data": {
                        "table": "sub_categories",
                        "column": "category_id",
                        "type": "number"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": "{{$_GET.categoryid}}"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense.category_id",
                      "field": "expense.category_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.itemid}}",
                      "data": {
                        "table": "expense",
                        "column": "category_id",
                        "type": "number"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": "{{$_GET.itemid}}"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense.purchase_date",
                      "field": "expense.purchase_date",
                      "type": "date",
                      "operator": "between",
                      "value": [
                        "{{$_GET.crstartdate}}",
                        "{{$_GET.crenddate}}"
                      ],
                      "data": {
                        "table": "expense",
                        "column": "purchase_date",
                        "type": "date"
                      },
                      "operation": "BETWEEN"
                    }
                  ],
                  "conditional": "{{$_GET.currentmonth == 'true'}}"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense.purchase_date",
                      "field": "expense.purchase_date",
                      "type": "date",
                      "operator": "equal",
                      "value": "{{$_GET.date}}",
                      "data": {
                        "table": "expense",
                        "column": "purchase_date",
                        "type": "date"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": "{{$_GET.date}}"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense.purchase_date",
                      "field": "expense.purchase_date",
                      "type": "date",
                      "operator": "between",
                      "value": [
                        "{{$_GET.startdate}}",
                        "{{$_GET.enddate}}"
                      ],
                      "data": {
                        "table": "expense",
                        "column": "purchase_date",
                        "type": "date"
                      },
                      "operation": "BETWEEN"
                    }
                  ],
                  "conditional": "{{$_GET.enddate}}"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT expense.invoice_number, expense.quantity, expense.purchase_date, expense.receipt_name, expense.receipt_url, expense.account, expense.payment_type, expense.remark, expense.amount, sub_categories.subcategory_name AS ItemName, C1.name AS Unit, C2.name AS PaymentType, expense.id AS Expense_ID, expense.unit AS unitid, expense.category_id, expense.invoice_name, categories.category_name\nFROM expense\nLEFT JOIN sub_categories ON (sub_categories.id = expense.category_id) LEFT JOIN collections AS C1 ON (C1.id = expense.unit) LEFT JOIN categories ON (categories.id = sub_categories.category_id) LEFT JOIN collections AS C2 ON (C2.id = expense.payment_type)\nWHERE expense.user_id = :P1 /* {{SecurityCS.identity}} */ AND (sub_categories.category_id = :P2 /* {{$_GET.categoryid}} */) AND (expense.category_id = :P3 /* {{$_GET.itemid}} */) AND (expense.purchase_date BETWEEN :P4 /* {{$_GET.crstartdate}} */ AND :P5 /* {{$_GET.crenddate}} */) AND (expense.purchase_date = :P6 /* {{$_GET.date}} */) AND (expense.purchase_date BETWEEN :P7 /* {{$_GET.startdate}} */ AND :P8 /* {{$_GET.enddate}} */)\nORDER BY expense.purchase_date DESC, expense.created_on DESC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{SecurityCS.identity}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.categoryid}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_GET.itemid}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P4",
                "value": "{{$_GET.crstartdate}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P5",
                "value": "{{$_GET.crenddate}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P6",
                "value": "{{$_GET.date}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P7",
                "value": "{{$_GET.startdate}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P8",
                "value": "{{$_GET.enddate}}"
              }
            ],
            "orders": [
              {
                "table": "expense",
                "column": "purchase_date",
                "direction": "DESC",
                "condition": "{{$_GET.newexpense != 1}}"
              },
              {
                "table": "expense",
                "column": "created_on",
                "direction": "DESC",
                "condition": "{{$_GET.newexpense == 1}}"
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
                "name": "invoice_number",
                "type": "number"
              },
              {
                "name": "quantity",
                "type": "number"
              },
              {
                "name": "purchase_date",
                "type": "date"
              },
              {
                "name": "receipt_name",
                "type": "text"
              },
              {
                "name": "receipt_url",
                "type": "text"
              },
              {
                "name": "account",
                "type": "number"
              },
              {
                "name": "payment_type",
                "type": "number"
              },
              {
                "name": "remark",
                "type": "text"
              },
              {
                "name": "amount",
                "type": "number"
              },
              {
                "name": "ItemName",
                "type": "text"
              },
              {
                "name": "Unit",
                "type": "text"
              },
              {
                "name": "PaymentType",
                "type": "text"
              },
              {
                "name": "Expense_ID",
                "type": "number"
              },
              {
                "name": "unitid",
                "type": "number"
              },
              {
                "name": "category_id",
                "type": "number"
              },
              {
                "name": "invoice_name",
                "type": "text"
              },
              {
                "name": "category_name",
                "type": "text"
              }
            ]
          }
        ],
        "outputType": "object"
      },
      {
        "name": "TotalAmount",
        "module": "dbconnector",
        "action": "single",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "expense",
                "column": "amount",
                "alias": "TotalAmount",
                "aggregate": "SUM"
              }
            ],
            "table": {
              "name": "expense"
            },
            "joins": [
              {
                "table": "sub_categories",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "sub_categories",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "category_id"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "collections",
                "column": "*",
                "alias": "C1",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "C1",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "unit"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "categories",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "categories",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "sub_categories",
                        "column": "category_id"
                      },
                      "operation": "="
                    }
                  ]
                }
              },
              {
                "table": "collections",
                "column": "*",
                "alias": "C2",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "C2",
                      "column": "id",
                      "operator": "equal",
                      "value": {
                        "table": "expense",
                        "column": "payment_type"
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
                  "id": "expense.user_id",
                  "field": "expense.user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{SecurityCS.identity}}",
                  "data": {
                    "table": "expense",
                    "column": "user_id",
                    "type": "number"
                  },
                  "operation": "="
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "sub_categories.category_id",
                      "field": "sub_categories.category_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.categoryid}}",
                      "data": {
                        "table": "sub_categories",
                        "column": "category_id",
                        "type": "number"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": "{{$_GET.categoryid}}"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense.category_id",
                      "field": "expense.category_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.itemid}}",
                      "data": {
                        "table": "expense",
                        "column": "category_id",
                        "type": "number"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": "{{$_GET.itemid}}"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense.purchase_date",
                      "field": "expense.purchase_date",
                      "type": "date",
                      "operator": "between",
                      "value": [
                        "{{$_GET.crstartdate}}",
                        "{{$_GET.crenddate}}"
                      ],
                      "data": {
                        "table": "expense",
                        "column": "purchase_date",
                        "type": "date"
                      },
                      "operation": "BETWEEN"
                    }
                  ],
                  "conditional": "{{$_GET.currentmonth == 'true'}}"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense.purchase_date",
                      "field": "expense.purchase_date",
                      "type": "date",
                      "operator": "equal",
                      "value": "{{$_GET.date}}",
                      "data": {
                        "table": "expense",
                        "column": "purchase_date",
                        "type": "date"
                      },
                      "operation": "="
                    }
                  ],
                  "conditional": "{{$_GET.date}}"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "expense.purchase_date",
                      "field": "expense.purchase_date",
                      "type": "date",
                      "operator": "between",
                      "value": [
                        "{{$_GET.startdate}}",
                        "{{$_GET.enddate}}"
                      ],
                      "data": {
                        "table": "expense",
                        "column": "purchase_date",
                        "type": "date"
                      },
                      "operation": "BETWEEN"
                    }
                  ],
                  "conditional": "{{$_GET.enddate}}"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT SUM(expense.amount) AS TotalAmount\nFROM expense\nLEFT JOIN sub_categories ON (sub_categories.id = expense.category_id) LEFT JOIN collections AS C1 ON (C1.id = expense.unit) LEFT JOIN categories ON (categories.id = sub_categories.category_id) LEFT JOIN collections AS C2 ON (C2.id = expense.payment_type)\nWHERE expense.user_id = :P1 /* {{SecurityCS.identity}} */ AND (sub_categories.category_id = :P2 /* {{$_GET.categoryid}} */) AND (expense.category_id = :P3 /* {{$_GET.itemid}} */) AND (expense.purchase_date BETWEEN :P4 /* {{$_GET.crstartdate}} */ AND :P5 /* {{$_GET.crenddate}} */) AND (expense.purchase_date = :P6 /* {{$_GET.date}} */) AND (expense.purchase_date BETWEEN :P7 /* {{$_GET.startdate}} */ AND :P8 /* {{$_GET.enddate}} */)\nORDER BY expense.purchase_date DESC",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{SecurityCS.identity}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.categoryid}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P3",
                "value": "{{$_GET.itemid}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P4",
                "value": "{{$_GET.crstartdate}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P5",
                "value": "{{$_GET.crenddate}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P6",
                "value": "{{$_GET.date}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P7",
                "value": "{{$_GET.startdate}}"
              },
              {
                "operator": "between",
                "type": "expression",
                "name": ":P8",
                "value": "{{$_GET.enddate}}"
              }
            ],
            "orders": [
              {
                "table": "expense",
                "column": "purchase_date",
                "direction": "DESC",
                "recid": 1
              }
            ],
            "groupBy": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "TotalAmount",
            "type": "number"
          }
        ],
        "outputType": "object",
        "type": "dbconnector_single"
      }
    ]
  }
}
JSON
);
?>