# SETUP

ADD THIS TO YOUR `.env` file

```
SWIFTDIL_CLIENT_ID={client-id}
SWIFTDIL_CLIENT_SECRET={client-secret}
SWIFTDIL_URL={https://sandbox.swiftdil.com/v1} or {https://api.swiftdil.com/v1} 
```

## List of entities and methods

- ####[Customers](#customers)
    - [Customer object](#customer-object)
    - [Create a customer](#create-a-customer)
    - [Retrive a customer](#retrieve-a-customer)
    - [Update a customer](#retrieve-a-customer)
    - [Delete a customer](#delete-a-customer)
    - [List all customers](#list-all-customers)
    

##Customers

A customer represents the individual or company the various checks are being performed on. To initiate a check, a customer must be created first. The API allows you to create, retrieve, update, and delete your customers. You can retrieve specific customers as well as a list of all your customers.

A customer must first be created to facilitate all further checks. Once a customer is created, we will automatically generate a risk profile.

####Customer object

*Example Response:*
```json
{
    "id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "created_at": "2017-01-17T23:46:26Z",
    "updated_at": "2017-01-17T23:46:26Z",
    "type" : "INDIVIDUAL",
    "title" : "MR",
    "first_name" : "John",
    "middle_name": "A.",
    "last_name" : "Doe",
    "email" : "john.doe@example.com",
    "dob" : "1980-01-01",
    "gender": "MALE",
    "addresses" : [
        {
            "type": "PRIMARY",
            "property_name": "Custom House",
            "line": "Main Street",
            "extra_line": "City Square",
            "city": "Aldgate",
            "state_or_province": "London",
            "postal_code": "E99 0ZZ",
            "country": "GBR",
            "from_date": "2010-01-01"
        }
    ]
}
```

**ATTRIBUTES** 

| column name | type | for | description |
| ------ | ------ | ------ | ------ |
| id | string |INDIVIDUAL AND COMPANY  | The unique identifier for the customer. |
| created_at | datetime | INDIVIDUAL AND COMPANY | The unique identifier for the customer. |
| updated_at | datetime | INDIVIDUAL AND COMPANY | The unique identifier for the customer. |
| type | string | INDIVIDUAL AND COMPANY |The customer type. Valid values are ```INDIVIDUAL```or```COMPANY```. |
| joined_at | datetime | INDIVIDUAL AND COMPANY | The date and time when the customer was registered with you. This is relevant for users that migrate existing customers.
| email | string | INDIVIDUAL AND COMPANY | The customer’s email address. |
| telephone | string | INDIVIDUAL AND COMPANY | The customer’s telephone number. |
| mobile | string | INDIVIDUAL AND COMPANY | The customer’s mobile number. |
| addresses | list address | INDIVIDUAL AND COMPANY | A list of addresses associated with customer. |
| title | string | INDIVIDUAL | The customer’s title. Valid values are MR, MRS, MISS, or MS. |
| first_name | string | INDIVIDUAL | The customer’s first name. |
| middle_name | string | INDIVIDUAL | The customer’s middle name. |
| last_name | string | INDIVIDUAL | The customer’s last name. |
| maiden_name | string | INDIVIDUAL | The customer’s maiden name. |
| alternative_first_name | string | INDIVIDUAL | The customer’s alternative or new first name. |
| alternative_middle_name | string | INDIVIDUAL | The customer’s alternative or new middle name. |
| alternative_last_name | string | INDIVIDUAL | The customer’s alternative or new last name. |
| dob | date | INDIVIDUAL | The customer’s date of birth. The format is YYYY-MM-DD. |
| gender | string | INDIVIDUAL | The customer’s gender. Valid values are MALE, FEMALE, or OTHER. |
| nationality | string | INDIVIDUAL | The customer’s nationality. This will be the three-letter country ISO code. |
| birth_country | string | INDIVIDUAL | The customer’s country of birth. This will be the three-letter country ISO code. |
| special_occupation | string | INDIVIDUAL | The customer’s occupation. Valid values can be any of the occupation categories﻿ we support. |
| company_name | string | COMPANY | The company name. |
| alternative_company_name | string | COMPANY | The company's alternative or new name. |
| incorporation_number | string | COMPANY | The company’s incorporation number. |
| incorporation_type | string | COMPANY | The company’s incorporation type. Valid values are: <br>1. *SOLE_TRADER* <br>2. *PRIVATE_LIMITED* <br>3. *LIMITED_LIABILITY_PARTNERSHIP* <br>4. *PUBLIC_LIMITED* |
| incorporation_country | string | COMPANY | The company’s country of incorporation. This will be the three-letter country ISO code. |
| business_purpose | string | COMPANY | The company’s business purpose. Valid values are: 1. *REGULATED_ENTITY* <br>2. *PRIVATE_ENTITY* <br>3. *UNREGULATED_FUND* <br>4. *TRUST* <br>5. *FOUNDATION* <br>6. *RELIGIOUS_BODY* <br>7. *GOVERNMENT_ENTITY* <br>8. *CHARITY* <br>9.*CLUB* <br>10. *SOCIETY* |
| primary_contact_name | string | COMPANY | The company’s primary contact full name. |
| primary_contact_email | string | COMPANY | The company’s primary contact email address. |


**ADDRESS** - ATTRIBUTES

| column name | type | for | description |
| ------ | ------ | ------ | ------ |
| type | string | x | The address type. Valid values are PRIMARY, ALTERNATIVE, or OTHER. |
| property_number | string | x | The property number for this address. |
| property_name | string | x | The property name for this address. |
| line | string | x | The first line of the customer’s address. |
| extra_line | string | x | The second line of the customer’s address. |
| city | string | x | The city or town of the customer’s address. |
| state_or_province | string | x | The county, state or province of the customer’s address. If US customer, the US states must use the USPS abbreviation (refer to ISO 3166-2), for example NY, MI, or CA. |
| postal_code | string | x | The post or zip code of the customer’s address. This is a required field. |
| country | string | x | The country of the customer’s address. This will be the three-letter country ISO code. |
| from_date | date| x | The date the customer moved in to this address. The format is YYYY-MM-DD. |
| to_date | date| x | The date the customer moved out of this address. The format is YYYY-MM-DD. Leave as null if currently residing in address. |
	

**line**, **city**, **postal_code** and **country** are the minimum **required** attributes for a valid address . Where the address breakdown is available, please ensure they are 
supplied into the correct attributes. For example, use **property_number** and **property_name** if known, 
rather than storing them into **line** or **extra_line**.

As part of the match object, only the available address attributes will be returned 
for example the postal_code will not be returned when not available for a given watchlist entity.


####Create a customer

Creates a new customer object.

list of required fields:

- type 
- email 
- first_name 
- last_nam
- company_name 

*Example Request:*

```php
$data = [
    "type" => "INDIVIDUAL",
    "email" => "john.doe@example.com",
    "title" => "MR",
    "first_name" => "John",
    "middle_name"=> "A.",
    "last_name" => "Doe",
    "dob" => "1980-01-01",
    "gender"=> "MALE",
    "addresses" => [
        [
            "type"=> "PRIMARY",
            "property_name"=> "Custom House",
            "line"=> "Main Street",
            "extra_line"=> "City Square",
            "city"=> "Aldgate",
            "state_or_province"=> "London",
            "postal_code"=> "E99 0ZZ",
            "country"=> "GBR",
            "from_date"=> "2010-01-01"
        ]
    ]
]

(new SwiftdilAPI())->Customer()->create($data);

```

*Example Response*
```json
{
    "id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "created_at": "2017-01-17T23:46:26Z",
    "updated_at": "2017-01-17T23:46:26Z",
    "type" : "INDIVIDUAL",
    "title" : "MR",
    "first_name" : "John",
    "middle_name": "A.",
    "last_name" : "Doe",
    "email" : "john.doe@example.com",
    "dob" : "1980-01-01",
    "gender": "MALE",
    "addresses": [
        {
            "type": "PRIMARY",
            "property_name": "Custom House",
            "line": "Main Street",
            "extra_line": "City Square",
            "city": "Aldgate",
            "state_or_province": "London",
            "postal_code": "E99 0ZZ",
            "country": "GBR",
            "from_date": "2010-01-01"
        }
    ]
}
```

#### Retrieve a customer

ATTRIBUTES

- **customer_id**  require The unique identifier for the customer.

Retrieves the details of an existing customer. 
You need only supply the unique customer identifier that was returned upon customer creation.

*`GET https://api.swiftdil.com/v1/customers/{customer_id}`*

*Example Request:*

```php
(new SwiftdilAPI())->Customer()->create($customerId);
```

*Example Response:*
```json
{
    "id": "7e375d53-5265-4cb4-b9bf-19d37ef11a9a",
    "created_at": "2017-01-24T12:30:10Z",
    "updated_at": "2017-01-24T12:30:10Z",
    "type": "COMPANY",
    "company_name": "John Doe's Bakery",
    "incorporation_type": "PRIVATE_LIMITED",
    "incorporation_country": "GBR",
    "business_purpose": "PRIVATE_ENTITY",
    "email": "company@example.com",
    "primary_contact_name": "John Doe",
    "primary_contact_email": "john.doe@example.com",
    "addresses":[
        {
            "type": "PRIMARY",
            "property_number": "10",
            "property_name": "Atrium House",
            "line": "Main Business Park",
            "city": "Knutsford",
            "state_or_province": "Cheshire",
            "postal_code": "W99 6ZZ",
            "country": "GBR",
            "from_date": "2015-01-01"
       }
    ]
}
```


####Update a customer
Definition
Updates the details of an existing customer. This is an idempotent method and will require all fields you have on the customer to be provided as part of request. This will ensure customer details held in your system are in line with the details held by SwiftDil.

Please note, the customer type will not be editable once set. Additionally, certain fields will not be editable once the customer has undergone a check:


*Example Request:*
```php
$data = [
    "type" => "INDIVIDUAL",
    "email" => "john.doe@example.com",
    "title" => "MR",
    "first_name" => "John",
    "middle_name"=> "Smith",
    "last_name" => "Doe",
    "dob" => "1980-01-01",
    "gender"=> "MALE",
    "addresses" => [
        [
            "type"=> "PRIMARY",
            "property_name"=> "Custom House",
            "line"=> "Main Street",
            "extra_line"=> "City Square",
            "city"=> "Aldgate",
            "state_or_province"=> "London",
            "postal_code"=> "E99 0ZZ",
            "country"=> "GBR",
            "from_date"=> "2010-01-01"
        ]
    ],
]

(new SwiftdilAPI())->Customer()->update($customerId, $data);
```

*Example Response:*
```json
{
    "id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "created_at": "2017-01-17T23:46:26Z",
    "updated_at": "2017-02-01T12:10:11Z",
    "type" : "INDIVIDUAL",
    "title" : "MR",
    "first_name" : "John",
    "middle_name": "Smith",
    "last_name" : "Doe",
    "email" : "john.doe@example.com",
    "dob" : "1980-01-01",
    "gender": "MALE",
    "addresses": [
        {
            "type": "PRIMARY",
            "property_name": "Custom House",
            "line": "Main Street",
            "extra_line": "City Square",
            "city": "Aldgate",
            "state_or_province": "London",
            "postal_code": "E99 0ZZ",
            "country": "GBR",
            "from_date": "2010-01-01"
        }
    ]
}
```

####Delete a customer

Deletes an existing customer. You need only supply the unique customer identifier that was returned upon customer creation. Also deletes any documents and notes on the customer. Please note, once a customer has undergone any type of checks (e.g. screening), they can no longer be deleted.

*`DELETE https://api.swiftdil.com/v1/customers/{customer_id}`*

*Example Request:*

```php
(new SwiftDilApi())->Customer()->delete($customerId)
```

####List all customers

Lists all existing customers. The customers are returned sorted by creation date, with the most recent customers appearing first. In addition to the attributes listed on the pagination section, the following optional parameters can be used to refine the response.

`GET https://api.swiftdil.com/v1/customers`

```php
    (new SwiftDilApi())->Customer()->getAll();
```


