# airtab2php

[**Airtable**](https://airtable.com/) is a spreadsheet-database hybrid, with the features of a database but applied to a spreadsheet. **airtab2php** is a group of simple functions that make it possible to use Airtable's API in PHP. By using this you can list, create, update and delete records in Airtable.

## Installation

Easy to install, just include it.

```php
require_once 'airtab2php.php';
```

## Usage

API-key, base ID and table name are required variables for all functions.

### Required variables 

| Variable | Description                     | Example                   |
| -------- | ------------------------------- | ------------------------- |
| [APIKEY] | Generated API-key from Airtable | ex. *'keysccH0c9F1ZtwXe'* |
| [BASE]   | Unique ID of base in Airtable   | ex. *'appxxxp0BT5w4x1ac'* |
| [TABLE]  | Table name in Airtable          | ex. *'phonebook'*         |

### List - airtab2php_list()

This function lists records from Airtable based on base ID and table name. It's also possible to customize it by using the variables listed in the table below.

```php
airtab2php_select([APIKEY], [BASE], [TABLE], [VIEW], [FIELDS], [WHERE], [SORT], [LIMIT]);
```

The function will return the result as an array.

#### Optional variables

| Variable | Description                             | Example                                             |
| -------- | --------------------------------------- | --------------------------------------------------- |
| [VIEW]   | Custom Grid view                        | *'Grid view'* (default)                             |
| [FIELDS] | Name of fields to include               | *'firstname;lastname;phonenumber'*                  |
| [WHERE]  | Where value is equal to or not equal to | *'firstname=John'* or *'firstname!=John'*           |
| [SORT]   | Sort record by field and direction      | *'firstname;desc'* (default direction is ascending) |
| [LIMIT]  | Maximum total number of records         | *'10'* (default is 100)                             |

### Create - airtab2php_create()

This function will create new record in Airtable based on base ID and table name. In addition, fields and values are also required variables to be able to perform this function correctly. The use of these variables are listed in the table below.

```php
airtab2php_insert([APIKEY], [BASE], [TABLE], [FIELDS], [VALUES]);
```

If the function is performed correctly, it will return `TRUE`.

#### Required variables

| Variable | Description                       | Example                            |
| -------- | --------------------------------- | ---------------------------------- |
| [FIELDS] | Specify name of fields in table   | *'firstname;lastname;phonenumber'* |
| [VALUES] | Specify values to create in table | *'John;Doe;155588812'*             |

### Update - airtab2php_update()

This function will update existing record in Airtable based on base ID and table name. In addition, record ID, fields and values are also required variables to be able to perform this function correctly. The use of these variables are listed in the table below.

```php
airtab2php_update([APIKEY], [BASE], [TABLE], [ID], [FIELDS], [VALUES]);
```

If the function is performed correctly, it will return `TRUE`.

#### Required variables

| Variable | Description                       | Example                            |
| -------- | --------------------------------- | ---------------------------------- |
| [ID]     | ID of record to update in table   | *'rectCv8ZQm6bypdz4'*              |
| [FIELDS] | Specify name of fields in table   | *'firstname;lastname;phonenumber'* |
| [VALUES] | Specify values to update in table | *'John;Doe;155588834'*             |

### Delete - airtab2php_delete()

This function will delete existing record in Airtable based on base ID and table name. In addition, record ID is also required variable to be able to perform this function correctly. The use of this variable is listed in the table below.

```PHP
airtab2php_delete([APIKEY], [BASE], [TABLE], [ID]);
```

If the function is performed correctly, it will return `TRUE`.

#### Required variable

| Variable | Description                     | Example               |
| -------- | ------------------------------- | --------------------- |
| [ID]     | ID of record to delete in table | *'rectCv8ZQm6bypdz4'* |

## License

Distributed under the MIT License. See `LICENSE` for more information.

## Contact

Nille - [@aliasnille](https://twitter.com/aliasnille) / [himself@nillewebb.se](mailto:himself@nillewebb.se) / [nillewebb.se](https://nillewebb.se) (in Swedish)

Project Link: https://github.com/aliasnille/airtab2php