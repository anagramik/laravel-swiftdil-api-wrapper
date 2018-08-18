## SETUP
ADD THIS TO YOUR `.env` file

```
SWIFTDIL_CLIENT_ID={client-id}
SWIFTDIL_CLIENT_SECRET={client-secret}
SWIFTDIL_URL={https://sandbox.swiftdil.com/v1} or {https://api.swiftdil.com/v1} 
```

## List of entities and methods

* **[Customer](#customer)**
    - [Customer object](#customer-object)
    - [Create a customer](#create-a-customer)
    - [Retrive a customer](#retrieve-a-customer)
    - [Update a customer](#retrieve-a-customer)
    - [Delete a customer](#delete-a-customer)
    - [List all customers](#list-all-customers)   
* **[Risk Profile](#risk-profile)**
    - [Retrive a risk profile](#retrieve-a-risk-profile)
* **[Document](#document)**
    - [Document object](#document-object)
    - [Create and upload a document](#create-and-upload-a-document)
    - [Retrive a document](#retrive-a-document)
    - [Download a document](#download-a-document)
    - [Update a document](#update-a-document)
    - [List all documents](#list-all-documents)
* **[Screening](#screening)**
    - [Screening object](#screening-object)
    - [Create a screening](#create-a-screening)
    - [Retrive a screening](#retrive-a-screening)
    - [List all screenings for customer](#list-all-screenings-for-customer)
    - [Search screenings](#search-screenings)
* **[Match](#match)**
    - [Match object](#match-object)
    - [Retrive a match](#retrive-a-match)
    - [List all match](#list-all-match)
    - [Confirm a match](#confirm-a-match)
    - [Dismiss a match](#dismiss-a-match)
    - [Confirm multiple matches](#confirm-multiple-matches)
    - [Dismiss multiple matches](#dismiss-multiple-matches)
* **[Association](#association)**
    - [Retrieve an association](#retrieve-an-association)
    - [List all associations](#list-all-associations)
* **[Document Verification](#document-verification)**
    - [Document verification object](#document-verification-object) 
    - [Create a document verification](#create-a-document-verification) 
    - [Retrive a document verification](#retrive-a-document-verification) 
    - [List all document verifications for customer](#list-all-document-verifications-for-customer) 
* **[Identity Verification](#identity-verification)**
    - [Create an identity verification](#create-an-identity-verification)
    - [Retrieve an identity verification](#retrieve-an-identity-verification)
    - [List all identity verifications for customer](#list-all-identity-verifications-for-customer)
* **[Report](#report)**
    - [Retrieve a report](#retrieve-a-report)
    - [Download a report](#download-a-report)
    - [List all reports](#list-all-reports)
* **[File](#file)**
    - [File object](#file-object)
    - [Retrieve a file](#retrieve-a-file)
    - [Download a file](#download-a-file)
    - [Update a file](#update-a-file)
    - [Delete a file](#delete-a-file)
* **[Note](#note)**
    - [Note object](#note-object)
    - [Create a note](#create-a-note)
    - [Retrieve a note](#retrieve-a-note)
    - [Update a note](#update-a-note)
    - [Delete a note](#delete-a-note)
    - [List all notes](#list-all-notes)

## Customer

A customer represents the individual or company the various checks are being performed on. To initiate a check, a 
customer must be created first. The API allows you to create, retrieve, update, and delete your customers. You can 
retrieve specific customers as well as a list of all your customers.

A customer must first be created to facilitate all further checks. Once a customer is created, we will automatically 
generate a risk profile.

#### Customer object

**ATTRIBUTES** 

| column name | type | for | description |
| ------ | ------ | ------ | ------ |
| id | string |INDIVIDUAL AND COMPANY  | The unique identifier for the customer. |
| created_at | datetime | INDIVIDUAL AND COMPANY | The unique identifier for the customer. |
| updated_at | datetime | INDIVIDUAL AND COMPANY | The unique identifier for the customer. |
| type | string | INDIVIDUAL AND COMPANY |The customer type. Valid values are `INDIVIDUAL`or`COMPANY`. |
| joined_at | datetime | INDIVIDUAL AND COMPANY | The date and time when the customer was registered with you. This is relevant for users that migrate existing customers. |
| email | string | INDIVIDUAL AND COMPANY | The customer’s email address. |
| telephone | string | INDIVIDUAL AND COMPANY | The customer’s telephone number. |
| mobile | string | INDIVIDUAL AND COMPANY | The customer’s mobile number. |
| [addresses](#address-attribute) | list address | INDIVIDUAL AND COMPANY | A list of addresses associated with customer. |
| title | string | INDIVIDUAL | The customer’s title. Valid values are MR, MRS, MISS, or MS. |
| first_name | string | INDIVIDUAL | The customer’s first name. |
| middle_name | string | INDIVIDUAL | The customer’s middle name. |
| last_name | string | INDIVIDUAL | The customer’s last name. |
| maiden_name | string | INDIVIDUAL | The customer’s maiden name. |
| alternative_first_name | string | INDIVIDUAL | The customer’s alternative or new first name. |
| alternative_middle_name | string | INDIVIDUAL | The customer’s alternative or new middle name. |
| alternative_last_name | string | INDIVIDUAL | The customer’s alternative or new last name. |
| dob | date | INDIVIDUAL | The customer’s date of birth. The format is YYYY-MM-DD. |
| gender | string | INDIVIDUAL | The customer’s gender. Valid values are `MALE`, `FEMALE`, or `OTHER`. |
| nationality | string | INDIVIDUAL | The customer’s nationality. This will be the three-letter country ISO code. |
| birth_country | string | INDIVIDUAL | The customer’s country of birth. This will be the three-letter country ISO code. |
| special_occupation | string | INDIVIDUAL | The customer’s occupation. Valid values can be any of the occupation categories﻿ we support. |
| company_name | string | COMPANY | The company name. |
| alternative_company_name | string | COMPANY | The company's alternative or new name. |
| incorporation_number | string | COMPANY | The company’s incorporation number. |
| incorporation_type | string | COMPANY | The company’s incorporation type. Valid values are: <br> 1.`SOLE_TRADER` <br> 2.`PRIVATE_LIMITED` <br> 3.`LIMITED_LIABILITY_PARTNERSHIP` <br> 4.`PUBLIC_LIMITED` |
| incorporation_country | string | COMPANY | The company’s country of incorporation. This will be the three-letter country ISO code. |
| business_purpose | string | COMPANY | The company’s business purpose. Valid values are: 1.`REGULATED_ENTITY` <br>2.`PRIVATE_ENTITY` <br>3.`UNREGULATED_FUND` <br>4.`TRUST` <br>5.`FOUNDATION` <br>6.`RELIGIOUS_BODY` <br>7.`GOVERNMENT_ENTITY` <br>8.`CHARITY` <br>9.`CLUB` <br>10.`SOCIETY` |
| primary_contact_name | string | COMPANY | The company’s primary contact full name. |
| primary_contact_email | string | COMPANY | The company’s primary contact email address. |


##### Address attribute

| column name | type | for | description |
| ------ | ------ | ------ | ------ |
| type | string | x | The address type. Valid values are `PRIMARY`, `ALTERNATIVE`, or `OTHER`. |
| property_number | string | x | The property number for this address. |
| property_name | string | x | The property name for this address. |
| line | string | x | The first line of the customer’s address. |
| extra_line | string | x | The second line of the customer’s address. |
| city | string | x | The city or town of the customer’s address. |
| state_or_province | string | x | The county, state or province of the customer’s address. If US customer, the US states must use the USPS abbreviation (refer to ISO 3166-2), for example NY, MI, or CA. |
| postal_code | string | x | The post or zip code of the customer’s address. This is a required field. |
| country | string | x | The country of the customer’s address. This will be the three-letter country ISO code. |
| from_date | date| x | The date the customer moved in to this address. The format is `YYYY-MM-DD`. |
| to_date | date| x | The date the customer moved out of this address. The format is `YYYY-MM-DD`. Leave as null if currently residing in address. |
	

**line**, **city**, **postal_code** and **country** are the minimum **required** attributes for a valid address. 
Where the address breakdown is available, please ensure they are 
supplied into the correct attributes. For example, use **property_number** and **property_name** if known, 
rather than storing them into **line** or **extra_line**.

As part of the match object, only the available address attributes will be returned 
for example the postal_code will not be returned when not available for a given watchlist entity.

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


#### Create a customer

Creates a new customer object.

ATTRIBUTES

- **type** required 
- **email** required 
- **first_name** required 
- **last_nam** required
- **company_name** required 

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

Retrieves the details of an existing customer. 
You need only supply the unique customer identifier that was returned upon customer creation.

ATTRIBUTES

- **customer_id**  require The unique identifier for the customer.

*Example Request:*

```php
(new SwiftdilAPI())->Customer()->get($customerId);
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

#### Update a customer

Updates the details of an existing customer. This is an idempotent method and will require all fields you have on the 
customer to be provided as part of request. This will ensure customer details held in your system are in line with the
 details held by SwiftDil.

Please note, the customer type will not be editable once set. Additionally, certain fields will not be editable once 
the customer has undergone a check:

ATTRIBUTES

- **customer_id** require The unique identifier for the customer.

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

#### Delete a customer

Deletes an existing customer. You need only supply the unique customer identifier that was returned upon customer
 creation. Also deletes any documents and notes on the customer. Please note, once a customer has undergone any type of
  checks (e.g. screening), they can no longer be deleted.

*`DELETE https://api.swiftdil.com/v1/customers/{customer_id}`*

*Example Request:*

```php
(new SwiftDilAPI())->Customer()->delete($customerId)
```

#### List all customers

Lists all existing customers. The customers are returned sorted by creation date, with the most recent customers 
appearing first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the following optional parameters can 
be used to refine the response.

`GET https://api.swiftdil.com/v1/customers`

```php
    (new SwiftDilAPI())->Customer()->getAll();
```

## Risk profile

The risk profile is designed to provide you with a high-level snapshot of the key customer attributes and risk 
indicators that will assist you in shaping your ongoing customer relationship. It facilitates a risk-based framework 
for Client Due Diligence (CDD) and Enhanced Due Diligence (EDD).

The values of the risk profile are calculated by SwiftDil’s proprietary risk engine and cannot be overridden.

>The risk attributes are indicative. Therefore, we recommend you exercise the necessary due diligence and controls in 
line with your risk-based approach.

The API allows you to retrieve your customer’s risk profile.

#### The risk profile object

| column name | type | description |
| ------ | ------ | ------ |
| profile | hash, [profile object](#profile-attributes)| Represents a set of attributes key to customer on-boarding. The attributes are automatically derived from the various checks and operations conducted on your customers. |
| risk | hash, [risk object](#risk-attributes)| Represents a set of key risk factors associated with your customer, to assist you with on-boarding and due diligence. |
| last_trigger | string | The trigger that caused the latest update. Valid values are: <br> 1. `CUSTOMER_CREATED` <br> 2. `PERSONAL_DETAILS_UPDATE` <br> 3. `CUSTOMER_SCREENING` <br> 4. `ODD_SCREENING` <br> 5. `COUNTRY_SCORE_UPDATE` <br> 6. `OCCUPATION_SCORE_UPDATE` |
| last_updated | datetime | The date and time when the risk profile was last updated. |

##### Profile attributes

| column name | type | description |
| ------ | ------ | ------ |
| watchlist_entity | boolean | This will be set to `true` if a customer is found to be in a global sanctions and watchlists, or `false` if no watchlist relation is found. Default value is null if no relevant checks or operations have been conducted. |
| politically_exposed | boolean | This will be set to `true` if a customer is found to be politically exposed, or `false` if no political exposure is found. Default value is null if no relevant checks or operations have been conducted. |
| disqualified_entity | boolean | This will be set to `true` if a customer is found to be a disqualified entity, or `false` if no disqualification is found. Default value is null if no relevant checks or operations have been conducted. |
| relative_or_close_associate | boolean | This will be set to `true` if a customer is found to be related to a politically exposed or watchlist entity (company or individual), or `false` if no relation is found. Default value is null if no relevant checks or operations have been conducted. |
| adverse_media_exposed | boolean | This will be set to `true` if a customer is found to be associated with adverse media, or `false` if no adverse media relation is found. Default value is null if no relevant checks or operations have been conducted. |

##### Risk attributes

| column name | type | description |
| ------ | ------ | ------ |
| watchlist | boolean | This indicates watchlist risk level, which is automatically calculated by SwiftDil upon the completion of a screening request with watchlist in its scope. Valid values are `HIGH` when set, or null when not set. |
| political_exposure | boolean | This indicates political exposure level, which is automatically calculated by SwiftDil upon the completion of a screening request with PEP in its scope. Valid values are `HIGH`, `MEDIUM` and `LOW` when set, or null when not set. |
| relationship | boolean | This indicates relationship risk level, which is automatically calculated by SwiftDil upon the completion of a screening request. Valid values are `HIGH`, `MEDIUM` and `LOW` when set, or null when not set. |
| occupation | string | This represents the occupation risk level, which is automatically calculated by SwiftDil upon the completion of a screening request with PEP in its scope. This is only applicable to customers with political exposure. Valid values are `HIGH`, `MEDIUM` and `LOW` when set, or null when not set. |
| country | string | This represents the country risk level, which is automatically calculated by SwiftDil based on customer country details, which include the `address`, `nationality`, and `incorporation_country`. Valid values are `HIGH`, `MEDIUM` and `MEDIUM` when set, or null when not set. |

*Example Response:*

```json
{
    "profile": {
        "politically_exposed": false,
        "disqualified_entity": false,
        "watchlist_entity": false,
        "relative_or_close_associate": false,
        "adverse_media_exposed": null
    },
    "risk": {
        "political_exposure": "LOW",
        "occupation": "LOW",
        "country": "LOW",
        "watchlist": null,
        "relationship": null,
        "overall": "LOW"
    },
    "last_trigger": "PERSONAL_DETAILS_UPDATE",
    "last_updated": "2017-06-26T12:09:34Z"
}
```

#### Retrieve a risk profile

ATTRIBUTES

- **customer_id**  require The unique identifier for the customer.

Retrieves the risk profile of an existing customer.


*Example Request:*

```php
(new SwiftDilAPI())->RiskProfile()->getCustomerRiskProfile($customerId)
```

*Example Response:*

```json
{
    "profile": {
        "politically_exposed": false,
        "disqualified_entity": false,
        "watchlist_entity": false,
        "relative_or_close_associate": false,
        "adverse_media_exposed": null
    },
    "risk": {
        "political_exposure": "LOW",
        "occupation": "LOW",
        "country": "LOW",
        "watchlist": null,
        "relationship": null,
        "overall": "LOW"
    },
    "last_trigger": "PERSONAL_DETAILS_UPDATE",
    "last_updated": "2017-06-26T12:09:34Z"
}
```

## Document

Documents can be created for a given customer for the following purposes:

Secure and centralised document storage.
Perform certain checks such as authenticity and integrity analysis for ID documents e.g passports.
The documents API allows you to create, update, and delete documents. It also provide you with ability to upload image verification
relevant attachments to our global document delivery infrastructure.

>A document can be created without any attachments as they are optional. This means the document object can used to 
capture your customer’s document details without the need of uploading any attachments. These can be uploaded at a 
later time.


#### Document object

| column name | type | description |
| ------ | ------ | ------ |
| id | string | The unique identifier for the document. |
| created_at | datetime | The date and time when the document was created. |
| updated_at | datetime | The date and time when the document was updated. |
| type | string | The type of document. Valid values are: <br> 1.`PASSPORT` <br> 2.`DRIVING_LICENSE` <br> 3.`NATIONAL_INSURANCE_NUMBER` <br> 4.`SOCIAL_SECURITY_NUMBER` <br> 5.`TAX_ID_NUMBER` <br> 6.`NATIONAL_ID_CARD` <br> 7.`VISA` <br> 8.`POLLING_CARD` <br> 9.`RESIDENCE_PERMIT` <br> 10.`OTHER` |
| issuing_country | string | The country that issued the document. This will be the three-letter country ISO code. |
| issuing_authority | string | The authority or organisation that issued the document. |
| document_number | string | The unique number associated with document e.g. passport number for a document of type `PASSPORT`. |
| document_name | string | The name of the document e.g. Bank Letter. |
| document_description | string | The description of the document e.g. Bank letter confirming John Doe’s address history. |
| mrz_line1 | string | The first line of MRZ string. |
| mrz_line2 | string | The second line of MRZ string. |
| mrz_line3 | string | The third line of MRZ string. |
| front_side | hash, [file attachments object](#the-file-object) | The list of attributes pertaining to the front side file attachment of the document. |
| back_side | hash, [file attachments object](#the-file-object) | The list of attributes pertaining to the back side file attachment of the document. |
| issue_date | date | The issue date of the document. The format is `YYYY-MM-DD`. |
| expiry_date | date | The expiry date of the document. The format is `YYYY-MM-DD`. |

*Example Response:*

```json
{
    "id": "d78913a9-7dcd-46c8-a8fc-91b4f85329f5",
    "type": "PASSPORT",
    "document_name": "Customer passport",
    "document_description": "Primary ID document",
    "document_number": "N1234567890",
    "issuing_country": "GBR",
    "issue_date": "2010-01-01",
    "expiry_date": "2020-01-01",
    "created_at": "2017-06-28T08:04:32Z",
    "updated_at": "2017-06-28T08:04:32Z",
    "front_side": {
        "id": "cb3673b1-003d-49e4-ac49-3462bf704232",
        "created_at": "2017-06-28T08:04:32Z",
        "updated_at": "2017-06-28T08:04:32Z",
        "filename": "foo.jpg",
        "content_type": "image/jpeg",
        "size": 15,
        "locked" : false
    },
    "back_side": {
        "id": "6aa4d0c6-d7d4-4dbd-8a04-ad2491d0cef6",
        "created_at": "2017-06-28T08:04:32Z",
        "updated_at": "2017-06-28T08:04:32Z",
        "filename": "bar.jpg",
        "content_type": "image/jpeg",
        "size": 15,
        "locked" : false
    },
    "mrz_line1": "IDFRABERTHIER<<<<<<<<<<<<<<<<<<<<<<<",
    "mrz_line2": "N1234567890JOHN<<<<<<<<<<<<6512068F4"
}
```

#### Create and upload a document

Creates a new document object. Optionally, attachments can be uploaded as part of the document creation. attachments 
must be uploaded as a multi-part form and the file size must not exceed 5MB.

ATTRIBUTES

- **customer_id** required 
- **type** required 

*Example Request:*
 

```php

$data = [
    'front_side'           => $data['front_side'],
    'back_side'            => $data['back_side'],
    'type'                 => $data['type'],
    'document_name'        => $data['document_name'],
    'document_description' => $data['document_description'],
    'document_number'      => $data['document_number'],
    'issuing_country'      => $data['issuing_country'],
    'issue_date'           => $data['issue_date'],
    'expiry_date'          => $data['expiry_date'],
    'mrz_line1'            => $data['mrz_line1'],
    'mrz_line2'            => $data['mrz_line2'],
];

(new SwiftDilAPI())->Document()->createAndUpload($customerId, $data)
```

*Example Response:*

```json
{
    "id":  "d78913a9-7dcd-46c8-a8fc-91b4f85329f5",
    "type": "PASSPORT",
    "document_name": "Customer passport",
    "document_description": "Primary ID document",
    "document_number": "N1234567890",
    "issuing_country": "GBR",
    "issue_date": "2010-01-01",
    "expiry_date": "2020-01-01",
    "created_at": "2017-06-28T08:04:32Z",
    "updated_at": "2017-06-28T08:04:32Z",
    "front_side": {
        "id": "cb3673b1-003d-49e4-ac49-3462bf704232",
        "created_at": "2017-06-28T08:04:32Z",
        "updated_at": "2017-06-28T08:04:32Z",
        "filename": "foo.jpg",
        "content_type": "image/jpeg",
        "size": 15,
        "locked" : false
    },
    "back_side": {
        "id": "6aa4d0c6-d7d4-4dbd-8a04-ad2491d0cef6",
        "created_at": "2017-06-28T08:04:32Z",
        "updated_at": "2017-06-28T08:04:32Z",
        "filename": "bar.jpg",
        "content_type": "image/jpeg",
        "size": 15,
        "locked" : false
    },
    "mrz_line1": "IDGBRDOE<<<<<<<<<<<<<<<<<<<<<<<<<<<<",
    "mrz_line2": "N1234567890JOHN<<<<<<<<<<<<6512068F4"
}
```

#### Retrieve a document

Retrieves the details of an existing document. You need to supply the unique customer and document identifier.

ATTRIBUTES

- **customer_id** required 
- **document_id** required 

*Example Request:*

```php
(new SwiftDilAPI())->Document()->get($customerId, $documentId)
```

```json
{
    "id": "d78913a9-7dcd-46c8-a8fc-91b4f85329f5",
    "type": "PASSPORT",
    "document_name": "Customer passport",
    "document_description": "Primary ID document",
    "document_number": "N1234567890",
    "issuing_country": "GBR",
    "issue_date": "2010-01-01",
    "expiry_date": "2020-01-01",
    "created_at": "2017-06-28T08:04:32Z",
    "updated_at": "2017-06-28T08:04:32Z",
    "front_side": {
        "id": "cb3673b1-003d-49e4-ac49-3462bf704232",
        "created_at": "2017-06-28T08:04:32Z",
        "updated_at": "2017-06-28T08:04:32Z",
        "filename": "foo.jpg",
        "content_type": "image/jpeg",
        "size": 15,
        "locked" : false
    },
    "back_side": {
        "id": "6aa4d0c6-d7d4-4dbd-8a04-ad2491d0cef6",
        "created_at": "2017-06-28T08:04:32Z",
        "updated_at": "2017-06-28T08:04:32Z",
        "filename": "bar.jpg",
        "content_type": "image/jpeg",
        "size": 15,
        "locked" : false
    },
    "mrz_line1": "IDGBRDOE<<<<<<<<<<<<<<<<<<<<<<<<<<<<",
    "mrz_line2": "N1234567890JOHN<<<<<<<<<<<<6512068F4"
}
```

#### Download a document

Downloads a previously uploaded document. You need to supply the unique customer and document identifier. 
Optionally, you can specify which side of a document to download by specifying the side parameter, with front 
or back as the value. When the side parameter is not explicitly specified, the front side will be downloaded 
by default.

ATTRIBUTES
- **customer_id** required 
- **document_id** required 
- **side** optional, `front` or `back` 

*Example Request:*

```php
(new SwiftDilAPI())->Document()->download($customerId, $documentId)

or with side attribute

(new SwiftDilAPI())->Document()->download($customerId, $documentId, $side)
```
#### Update a document

Updates the details of an existing document. This is an idempotent method and will require all fields you have 
on the [document](#create-and-upload-a-document) (including attachments if applicable) to be provided as part of request. 
This will ensure document details held in your system are in line with the details held by SwiftDil.

Please note, a document attachment will not be editable once it had undergone a [image verification](#document-verification) 
check. Similarly, the MRZ lines will not be editable once an 
[MRZ verification](#document-verification) check had been made.

ATTRIBUTES
 - **customer_id** required 
 - **document_id** required 
 - **type** required 

*Example Request:*

```php

$data = [
    'front_side'           => $data['front_side'],
    'back_side'            => $data['back_side'],
    'type'                 => $data['type'],
    'document_name'        => $data['document_name'],
    'document_description' => $data['document_description'],
    'document_number'      => $data['document_number'],
    'issuing_country'      => $data['issuing_country'],
    'issue_date'           => $data['issue_date'],
    'expiry_date'          => $data['expiry_date'],
    'mrz_line1'            => $data['mrz_line1'],
    'mrz_line2'            => $data['mrz_line2'],
];

(new SwiftDilAPI())->Document()->update($customerId, $documentId, $data)
```

```json
{
    "id": "d78913a9-7dcd-46c8-a8fc-91b4f85329f5",
    "type": "DRIVING_LICENSE",
    "document_name": "Customer driving license",
    "document_description": "Primary ID document",
    "document_number": "N1234567890",
    "issuing_country": "GBR",
    "issue_date": "2010-01-01",
    "expiry_date": "2020-01-01",
    "created_at": "2017-06-28T08:04:32Z",
    "updated_at": "2017-06-28T12:01:06Z",
    "front_side": {
        "id": "cb3673b1-003d-49e4-ac49-3462bf704232",
        "created_at": "2017-06-28T08:04:32Z",
        "updated_at": "2017-06-28T08:04:32Z",
        "filename": "foo.jpg",
        "content_type": "image/jpeg",
        "size": 15,
        "locked" : false
    },
    "back_side": {
        "id": "6aa4d0c6-d7d4-4dbd-8a04-ad2491d0cef6",
        "created_at": "2017-06-28T08:04:32Z",
        "updated_at": "2017-06-28T08:04:32Z",
        "filename": "bar.jpg",
        "content_type": "image/jpeg",
        "size": 15,
        "locked" : false
    }
}
```

#### List all documents
Lists all existing documents associated with a given customer. The documents are returned sorted by creation date, with 
the most recent documents appearing first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the 
following optional parameters can be used to refine the response.

ATTRIBUTES

- **customer_id** required


```php
(new SwiftDilAPI())->Document()->getAll($clientId)
```

## Screening

SwiftDil enables you to meet your AML screening commitments through the application of our proprietary scorecard and 
fuzzy logic to screen your customer against our comprehensive database.

The API allows you to create and retrieve screening requests. Depending on the scope, a request can include
the following screening types : global watchlists (including CIA Watchlists, Government Sanctions, Anti-Terrorism and
AML Watchlists), Politically Exposed Persons (PEPs), adverse media and disqualified entities.

#### Screening object

| column name | type | description |
| ------ | ------ | ------ |
| id | string | The unique identifier for the screening. |
| customer_id | string | The unique identifier for the customer. |
| report_id | string | The unique identifier for the [report](#report-object). This is generated once a screening status is `DONE`. |
| entity_name | string | The concatenated `first_name` and `last_name` of the customer if an individual, or `company_name` if a company. |
| created_at | datetime | The date and time when the screening was created. |
| updated_at | datetime | The date and time when the screening or related matches were updated. |
| scope | list [screening type](#screening-type) | The list of screening types to be performed. |
| outcome | hash | Provides summary of [screening result](#screening-result), in line with the selected screening scope. The format will be a list of key-value pairs where each of the keys is the screening scope and the value is the [screening result](#screening-result). |
| status | string | The overall status of the screening for the entire scope. Values can be: <br> 1.`CREATED` - indicates screening request is created. <br>2.`PENDING` - indicates one or more of the screenings in scope are either `IN_PROGRESS` or `AWAITING_VALIDATION`. <br>3.`DONE` - indicates all the screenings in scope have been completed by SwiftDil and matches validated via the matches API where applicable. This means, all the screenings in scope have a status of `CONFIRMED`, `DISMISSED` or `CLEAR`. |


##### SCREENING TYPE

The following table outlines the various screening types available and their respective country coverage.

| Scope name | Description | Coverage |
| ------ | ------ | ------ |
| `WATCHLIST` | We will search your customer against our global watchlists. We will also highlight if your customer is Related or a Close Associate (RCA) of a watchlist or sanctioned entity, be it an individual or an organisation.	| Global |
| `PEP` | We will search your customer against our politically exposed persons (PEP) database. We will also highlight if your customer is Related or a Close Associate (RCA) of a PEP entity. | Global |
| `DISQUALIFIED_ENTITIES` | We will search your customer against our disqualified entities database which also includes disqualified , banned and barred individuals and companies.	| Global |
| `ADVERSE_MEDIA` | We will search your customer against our adverse media database of hand-picked articles from trusted news outlets. | Global |


##### SCREENING RESULT

| Screening result |   Description |
| ------ | ------ |
| IN_PROGRESS | Indicates the screening is still being processed by SwiftDil. |
| AWAITING_VALIDATION | Indicates SwiftDil has found one or more potential matches against your customer. These matches will require manual validation using the [Matches](#matches) endpoint. |
| CONFIRMED | Indicates at least one match has been confirmed using the [Matches](#matches) endpoint. |
| DISMISSED | Indicates that all the screening matches have been dismissed by you as they were not deemed to be genuine matches (i.e. false positives). |
| CLEAR | Indicates SwiftDil has not found your customer or any potential matches in the relevant databases, as per the scope you specified. Potential matches are determined by SwiftDil’s fuzzy scorecard logic and the pre-defined sensitivity thresholds. |


*Example Response:*

```
{
    "id": "123456-7890-4cb4-b9bf-12a34bc56d7e",
    "customer_id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "entity_name": "Jane Doe",
    "created_at": "2017-01-21T13:00:16Z",
    "updated_at": "2017-01-21T13:00:16Z",
    "scope": ["PEP","WATCHLIST","DISQUALIFIED_ENTITIES"],
    "status": "PENDING",
    "outcome": {
        "PEP": "CLEAR",
        "WATCHLIST": "AWAITING_VALIDATION",
        "DISQUALIFIED_ENTITIES": "CLEAR"
    }
}
```

#### Create a screening

Creates a new screening object.

ATTRIBUTES

- **customer_id** required
- **[scope](#screening-type)** required - A list of the screenings to be performed.

*Example Request:*

```php
$data = [
    "PEP",
    "WATCHLIST",
    "DISQUALIFIED_ENTITIES"
];

(new SwiftDilAPI())->Screening()->create($customerId, $data)
```

*Example Response:*

```json
{
    "id": "123456-7890-4cb4-b9bf-12a34bc56d7e",
    "customer_id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "entity_name": "Jane Doe",
    "created_at": "2017-01-21T13:00:16Z",
    "updated_at": "2017-01-21T13:00:16Z",
    "scope": ["PEP","WATCHLIST","DISQUALIFIED_ENTITIES"],
    "status": "PENDING",
    "outcome": {
        "PEP": "CLEAR",
        "WATCHLIST": "AWAITING_VALIDATION",
        "DISQUALIFIED_ENTITIES": "CLEAR"
    }
}
```

#### Retrieve a screening

Retrieves the details of an existing screening. You need to supply the unique customer and screening identifier.

ATTRIBUTE

- **customer_id** required
- **screening_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Screening()->get($customerId, $screeningId);
```

*Example Response:*

```json
{
    "id": "123456-7890-4cb4-b9bf-12a34bc56d7e",
    "customer_id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "entity_name": "Jane Doe",
    "created_at": "2017-01-21T13:00:16Z",
    "updated_at": "2017-01-21T13:00:16Z",
    "scope": ["PEP","WATCHLIST","DISQUALIFIED_ENTITIES"],
    "status": "PENDING",
    "outcome": {
        "PEP": "CLEAR",
        "WATCHLIST": "AWAITING_VALIDATION",
        "DISQUALIFIED_ENTITIES": "CLEAR"
    }
}
```

#### List all screenings for customer

Lists all existing screenings for a given customer. The screenings are returned sorted by creation date, with the most 
recent screenings appearing first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the following 
optional parameters can be used to refine the response.

ATTRIBUTES

- **customer_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Screening()->getAll($customerId);
```

#### Search screenings

Search for screenings across all existing customers. The screenings are returned sorted by creation date, with the most 
recent screenings appearing first. The following optional parameters can be used to refine the response.

ATTRIBUTES


## Matche

A [screening](#screening) request may result in one or multiple matches. A match object represents a potential match as determined by 
SwiftDil’s fuzzy scorecard logic and pre-defined thresholds.

The matches API allows you to retrieve and validate matches relating to a given screening request. The validation of a 
potential match refers to either confirmation or dismissal of the match once you have reviewed the details at hand.

#### The match object

<a href="https://reference.swiftdil.com/#the-match-object" target="_blank">The match object</a>

*Example Response:* 

```json
{
    "id": "123456-7890-4cb4-b9bf-12a34bc56dff",
    "created_at": "2017-01-21T15:00:16Z",
    "updated_at": "2017-01-21T15:00:16Z",
    "entity_type": "INDIVIDUAL",
    "match_type": ["SPECIAL_INTEREST_PERSON"],
    "validation_result": "AWAITING_VALIDATION",
    "names": [
        {
            "name_type": "PRIMARY_NAME",
            "first_name": "John",
            "last_name": "Doe"
        },
        {
            "name_type": "ALSO_KNOWN_AS",
            "first_name": "Jo",
            "last_name": "Doe"
        }
    ],
    "documents": [
        {
            "type": "PASSPORT",
            "number": "A123456789"
        },
        {
            "type": "DRIVING_LICENSE",
            "number": "B987654321",
            "note": "Registered by Customs Office"
        }
    ],
    "addresses": [
        {
            "line": "Middle house",
            "city": "Forest Hill",
            "Country": "GBR"
        },
        {
            "line": "Old house, main street",
            "city": "Aldgate",
            "Country": "GBR"
        }
    ],
    "references": [
        {
            "name": "OFAC Specially Designated National",
            "status": "CURRENT",
            "from_date": {
                "month": "02",
                "year": "2015"
            }
        }
    ],
    "countries_of_reported_allegation": [
        "GBR",
        "DEU"
    ],
    "countries_of_citizenship": [
        "GBR"
    ],
    "dobs": [
        {
            "month": "01",
            "year": "1980"
        }
    ],
    "gender": "MALE",
    "image_uri": [
        "http://example.example/images/sample1.jpg",
        "http://example.example/images/sample2.jpg"
    ],
    "deceased": false,
    "scorecard": {
        "overall_score": 91.85,
        "breakdown": [
            {
                "field_name": "name",
                "field_value": "John Doe",
                "score": 100,
                "risk_weight": 45,
                "risk_weighted_score": 45,
                "normalised_score": 33.33
            },
            {
                "field_name": "dob",
                "field_value": "01/1980",
                "score": 90,
                "risk_weight": 20,
                "risk_weighted_score": 18,
                "normalised_score": 13.33
            },
            {
                "field_name": "gender",
                "field_value": "MALE",
                "score": 100,
                "risk_weight": 10,
                "risk_weighted_score": 10,
                "normalised_score": 7.41
            },
            {
                "field_name": "address",
                "field_value": "Old house st., Aldgate, GBR",
                "score": 85,
                "risk_weight": 60,
                "risk_weighted_score": 51,
                "normalised_score": 37.78,
                "breakdown": [
                    {
                        "field_name": "country",
                        "field_value": "GBR",
                        "score": 100,
                        "risk_weight": 15,
                        "risk_weighted_score": 15,
                        "normalised_score": 25

                    },
                    {
                        "field_name": "city",
                        "field_value": "Aldgate",
                        "score": 100,
                        "risk_weight": 15,
                        "risk_weighted_score": 15,
                        "normalised_score": 25

                    },
                    {
                        "field_name": "line",
                        "field_value": "Old house st.",
                        "score": 70,
                        "risk_weight": 30,
                        "risk_weighted_score": 21,
                        "normalised_score": 35
                    }
                ]}
            ]}
        }
    }
}
```

#### Retrieve a match

Retrieves the details of an existing match. You need to supply the unique customer, screening and match identifier.

ATTRIBUTES

- **customer_id** required
- **screening_id** required
- **match_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Match()-get($customerId, $screeningId, $matchId);
```

*Example Response:*

```json
{
    "id": "123456-7890-4cb4-b9bf-12a34bc56dff",
    "created_at": "2017-01-21T15:00:16Z",
    "updated_at": "2017-01-21T15:00:16Z",
    "entity_type": "INDIVIDUAL",
    "match_type": ["SPECIAL_INTEREST_PERSON"],
    "validation_result": "AWAITING_VALIDATION",
    "names": [
        {
            "name_type": "PRIMARY_NAME",
            "first_name": "John",
            "last_name": "Doe"
        },
        {
            "name_type": "ALSO_KNOWN_AS",
            "first_name": "Jo",
            "last_name": "Doe"
        }
    ],
    "documents": [
        {
            "type": "PASSPORT",
            "number": "A123456789"
        },
        {
            "type": "DRIVING_LICENSE",
            "number": "B987654321",
            "note": "Registered by Customs Office"
        }
    ],
    "addresses": [
        {
            "line": "Middle house",
            "city": "Forest Hill",
            "Country": "GBR"
        },
        {
            "line": "Old house, main street",
            "city": "Aldgate",
            "Country": "GBR"
        }
    ],
    "references": [
        {
            "name": "OFAC Specially Designated National",
            "status": "CURRENT",
            "from_date": {
                "month": "02",
                "year": "2015"
            }
        }
    ],
    "countries_of_reported_allegation": [
        "GBR",
        "DEU"
    ],
    "countries_of_citizenship": [
        "GBR"
    ],
    "dobs": [
        {
            "month": "01",
            "year": "1980"
        }
    ],
    "gender": "MALE",
    "image_uri": [
        "http://example.example/images/sample1.jpg",
        "http://example.example/images/sample2.jpg"
    ],
    "deceased": false,
    "scorecard": {
        "overall_score": 91.85,
        "breakdown": [
            {
                "field_name": "name",
                "field_value": "John Doe",
                "score": 100,
                "risk_weight": 45,
                "risk_weighted_score": 45,
                "normalised_score": 33.33
            },
            {
                "field_name": "dob",
                "field_value": "01/1980",
                "score": 90,
                "risk_weight": 20,
                "risk_weighted_score": 18,
                "normalised_score": 13.33
            },
            {
                "field_name": "gender",
                "field_value": "MALE",
                "score": 100,
                "risk_weight": 10,
                "risk_weighted_score": 10,
                "normalised_score": 7.41
            },
            {
                "field_name": "address",
                "field_value": "Old house st., Aldgate, GBR",
                "score": 85,
                "risk_weight": 60,
                "risk_weighted_score": 51,
                "normalised_score": 37.78,
                "breakdown": [
                    {
                        "field_name": "country",
                        "field_value": "GBR",
                        "score": 100,
                        "risk_weight": 15,
                        "risk_weighted_score": 15,
                        "normalised_score": 25

                    },
                    {
                        "field_name": "city",
                        "field_value": "Aldgate",
                        "score": 100,
                        "risk_weight": 15,
                        "risk_weighted_score": 15,
                        "normalised_score": 25

                    },
                    {
                        "field_name": "line",
                        "field_value": "Old house st.",
                        "score": 70,
                        "risk_weight": 30,
                        "risk_weighted_score": 21,
                        "normalised_score": 35
                    }
                ]
            }
        ]
    }
}
```

#### List all matches
Lists all existing matches. The matches are returned sorted by overall score, with the highest scoring matches appearing
first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the following optional parameters can be used to
refine the response.

ATTRIBUTE

- **customer_id** required
- **screening_id** required

```php
(new SwiftDilAPI())->Match()-get($customerId, $screeningId);
```

#### Confirm a match

Confirms a customer match. You need to supply the unique customer, screening and match identifier.

ATTRIBUTES

- **customer_id** required
- **screening_id** required
- **match_id** required

```php
(new SwiftDilAPI())->Match()->confirm($customerId, $screeningId, $matchId);
```

#### Dismiss a match

Dismisses a customer match. You need to supply the unique customer, screening and match identifier.

ATTRIBUTES

- **customer_id** required
- **screening_id** required
- **match_id** required

```php
(new SwiftDilAPI())->Match()->dismiss($customerId, $screeningId, $matchId);
```

#### Confirm multiple matches

Confirms multiple customer matches. You need to supply the unique customer, screening and match identifiers.

ATTRIBUTES

- **customer_id** required
- **screening_id** required
- **matchIds** required

```php
(new SwiftDilAPI())->Match()->confirmMultiple($customerId, $screeningId, $matchIds);
```

#### Dismiss multiple matches

Dismisses multiple customer matches. You need to supply the unique customer, screening and match identifiers.

ATTRIBUTES

- **customer_id** required
- **screening_id** required
- **matchIds** required

```php
(new SwiftDilAPI())->Match()->dismissMultiple($customerId, $screeningId, $matchIds);
```

## Associations

The API allows you to retrieve entities associated with a given match. The associated entities can be other individuals or companies.

<a href="https://reference.swiftdil.com/#the-association-object" target="_blank">Association object</a>

#### Retrieve an association

Retrieves the details of an existing association. You need to supply the unique customer, screening, match and association identifier.

ATTRIBUTE

- **customer_id** required
- **screening_id** required
- **match_id** required
- **association_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Association()->get($customerId, $screeningId, $matchId, $associationId);
```

*Example Response:* 

```json
{
    "id": "123456-7890-4cb4-b9bf-01f11dc85e11",
    "created_at": "2017-01-21T15:00:16Z",
    "updated_at": "2017-01-21T15:00:16Z",
    "entity_type": "INDIVIDUAL",
    "match_type": ["RELATIVE_OR_CLOSE_ASSOCIATE"],
    "association_type": "WIFE",
    "direction": "OUTBOUND",
    "status": "CURRENT",
    "names": [
        {
            "name_type": "PRIMARY_NAME",
            "first_name": "Sue",
            "last_name": "Doe"
        }
    ],
    "addresses": [
        {
            "line": "Middle house",
            "city": "Forest Hill",
            "Country": "GBR"
        },
        {
            "line": "Old house, main street",
            "city": "Aldgate",
            "Country": "GBR"
        }
    ],
    "image_uri": [
        "http://example.example/images/sample3.jpg",
    ]
}
```
#### List all associations

Lists all existing associations. The associations are returned sorted by creation date, with the most recent
associations appearing first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the following optional 
parameters can be used to refine the response.

ATTRIBUTE

- **customer_id** required
- **screening_id** required
- **match_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Association()->get($customerId, $screeningId, $matchId);
```

## Document Verification

SwiftDil offers an extensive array of out-of-the-box document verifications. Two verification types exist:

- MRZ verification performs analysis checks on the Machine Readable Zone (MRZ) values specified by the user.

- Image verification performs image, Optical Character Recognition (OCR), and MRZ analysis on the attachments associated with the supplied document.

The table below lists the various analysis checks that are undertaken by SwifDil’s document verification engine, depending on the verification type you opt for.

| Analysis Type | Verification | Description |
| ----- | ----- | ----- |
| authenticity_analysis | `IMAGE`, `MRZ` | Asserts whether the document is a fake, a specimen, or a copy. |
| integrity_analysis | `IMAGE`, `MRZ` | Asserts whether the document was of a valid and an identifiable format |
| content_analysis | `IMAGE` | Asserts whether data extracted by OCR from multiple places on the document is consistent with the data held in MRZ. |
| mrz_analysis | `IMAGE`, `MRZ` | Asserts whether MRZ data is valid and adheres to the internationally-recognised standards. |
| consistency_analysis | `IMAGE`, `MRZ` | Asserts whether data on the document is consistent with customers detailed held by SwiftDil e.g. Asserts whether the name on a passport is the same as your customer’s name. |
| expiration_check | `IMAGE`, `MRZ` | Checks whether the document at hand has expired or not. |

Depending on the document type and issuing country, images of both sides of the document may be required. The table below specifies the document types for which both sides are required:

| Name | Country | Type |
| ----- | ----- | ----- |
| National Identity Card | EU and European Free Trade Association | `NATIONAL_ID_CARD` |
| Driving License | Canada | `DRIVING_LICENSE` |
| Visa | Biometric Residence Permit	| `VISA` |

The API allows you to create and retrieve document verification requests.

#### Document verification objecti

<a href="https://reference.swiftdil.com/#the-document-verification-object" target="_blank">Document verification object</a>

*Example Response:*

```json
{
    "created_at": "2017-11-10T22:54:17Z",
    "updated_at": "2017-11-10T22:54:17Z",
    "document_id": "c29ed1c4-59ee-4b8f-ab9c-4829fabaffd5",
    "customer_id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "entity_name": "John Doe",
    "type": "IMAGE",
    "outcome": {
        "authenticity_analysis": {
            "status": "ERROR",
            "breakdown": [
                {
                    "type": "MRZ_MATCHING_TYPE",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "MRZ_VISUAL_FORMAT",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "PHOTO_LOCATION",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "DAYLIGHT_COLOUR_ANALYSIS",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "DOCUMENT_SPECIMEN",
                    "status": "ERROR"
                },
                {
                    "type": "VISUAL_SECURITY_ELEMENTS",
                    "status": "NOT_APPLICABLE"
                }
            ]
        },
        "integrity_analysis": {
            "status": "CLEAR",
            "breakdown": [
                {
                    "type": "ISSUE_COUNTRY",
                    "status": "CLEAR"
                },
                {
                    "type": "DOCUMENT_TYPE_EXPIRATION",
                    "status": "CLEAR"
                },
                {
                    "type": "VALIDITY_OUT_OF_COUNTRY",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "NATIONALITY_MATCH",
                    "status": "CLEAR"
                },
                {
                    "type": "DOCUMENT_RECOGNISED",
                    "status": "CLEAR"
                },
                {
                    "type": "ISSUE_DATE",
                    "status": "CLEAR"
                }
            ]
        },
        "content_analysis": {
            "status": "NOT_APPLICABLE",
            "breakdown": [
                {
                    "type": "DOC_NUMBER_RECOGNISED",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "LAST_NAME_RECOGNISED",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "FIRST_NAME_RECOGNISED",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "BIRTH_DATE_RECOGNISED",
                    "status": "NOT_APPLICABLE"
                }
            ]
        },
        "mrz_analysis": {
            "status": "CLEAR",
            "breakdown": [
                {
                    "type": "MRZ_FIELDS_FORMAT",
                    "status": "CLEAR"
                },
                {
                    "type": "MRZ_CHECKSUM",
                    "status": "CLEAR"
                }
            ]
        },
        "consistency_analysis": {
            "status": "ATTENTION",
            "breakdown": [
                {
                    "type": "CUSTOMER_DOB",
                    "status": "ATTENTION"
                },
                {
                    "type": "CUSTOMER_BIRTH_PLACE",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "CUSTOMER_NATIONALITY",
                    "status": "ATTENTION"
                },
                {
                    "type": "CUSTOMER_LAST_NAME",
                    "status": "ATTENTION"
                },
                {
                    "type": "CUSTOMER_GENDER",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "CUSTOMER_FIRST_NAME",
                    "status": "ATTENTION"
                }
            ]
        },
        "expiration_check": {
            "status": "ATTENTION",
            "breakdown": [
                {
                    "type": "DOCUMENT_EXPIRATION",
                    "status": "ATTENTION"
                }
            ]
        }
    },
    "properties": {
        "document_type": "NATIONAL_IDENTITY_CARD",
        "document_data": {
            "document_number": "GZ000030E",
            "mrz_line1": "IDGIBGZ000030E2Q15000174<<<<<<",
            "mrz_line2": "7402061M2501280GBR<<<<<<<<<<<0",
            "mrz_line3": "FREEMAN<<PAUL<JAMES<<<<<<<<<<<",
            "issuing_country": "GIB",
            "expiry_date": {
                "day": 28,
                "month": 1,
                "year": 2025
            }
        },
        "holder_data": {
            "first_name": [
                "PAUL",
                "JAMES"
            ],
            "last_name": [
                "FREEMAN"
            ],
            "dob": {
                "day": 6,
                "month": 2,
                "year": 1974
            },
            "nationality": "GBR",
            "gender": "MALE"
        },
        "extracted_images": []
    },
    "status": "DONE",
    "id": "42583ade-f2b9-4bed-903a-bc46a215040c"
}
```
#### Create a document verification

Creates a new document verification object.

ATTRIBUTES

- **customer_id** required
- **type** required, IMAGE or MRZ
- **document_id** required

*Example Request:*  

```php
$data = [
    'document_id' => 'd78913a9-7dcd-46c8-a8fc-91b4f85329f5',
    'type'        => 'IMAGE',
],

(new SwiftDilAPI())->DocumentVerification()->create($customerId, $data);
```

#### Retrieve a document verification

Retrieves the details of an existing document verification. You need to supply the unique customer and document verification identifier.

ATTRIBUTES

- **customer_id** required
- **verification_id** required

*Example Request:*

```php
(new SwiftDilAPI())->DocumentVerification()->get($customerId, $verificationId)
```

*Example Response:*

```json
{
    "created_at": "2017-11-10T22:54:17Z",
    "updated_at": "2017-11-10T22:54:17Z",
    "document_id": "c29ed1c4-59ee-4b8f-ab9c-4829fabaffd5",
    "customer_id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "entity_name": "John Doe",
    "type": "IMAGE",
    "outcome": {
        "authenticity_analysis": {
            "status": "ERROR",
            "breakdown": [
                {
                    "type": "MRZ_MATCHING_TYPE",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "MRZ_VISUAL_FORMAT",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "PHOTO_LOCATION",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "DAYLIGHT_COLOUR_ANALYSIS",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "DOCUMENT_SPECIMEN",
                    "status": "ERROR"
                },
                {
                    "type": "VISUAL_SECURITY_ELEMENTS",
                    "status": "NOT_APPLICABLE"
                }
            ]
        },
        "integrity_analysis": {
            "status": "CLEAR",
            "breakdown": [
                {
                    "type": "ISSUE_COUNTRY",
                    "status": "CLEAR"
                },
                {
                    "type": "DOCUMENT_TYPE_EXPIRATION",
                    "status": "CLEAR"
                },
                {
                    "type": "VALIDITY_OUT_OF_COUNTRY",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "NATIONALITY_MATCH",
                    "status": "CLEAR"
                },
                {
                    "type": "DOCUMENT_RECOGNISED",
                    "status": "CLEAR"
                },
                {
                    "type": "ISSUE_DATE",
                    "status": "CLEAR"
                }
            ]
        },
        "content_analysis": {
            "status": "NOT_APPLICABLE",
            "breakdown": [
                {
                    "type": "DOC_NUMBER_RECOGNISED",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "LAST_NAME_RECOGNISED",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "FIRST_NAME_RECOGNISED",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "BIRTH_DATE_RECOGNISED",
                    "status": "NOT_APPLICABLE"
                }
            ]
        },
        "mrz_analysis": {
            "status": "CLEAR",
            "breakdown": [
                {
                    "type": "MRZ_FIELDS_FORMAT",
                    "status": "CLEAR"
                },
                {
                    "type": "MRZ_CHECKSUM",
                    "status": "CLEAR"
                }
            ]
        },
        "consistency_analysis": {
            "status": "ATTENTION",
            "breakdown": [
                {
                    "type": "CUSTOMER_DOB",
                    "status": "ATTENTION"
                },
                {
                    "type": "CUSTOMER_BIRTH_PLACE",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "CUSTOMER_NATIONALITY",
                    "status": "ATTENTION"
                },
                {
                    "type": "CUSTOMER_LAST_NAME",
                    "status": "ATTENTION"
                },
                {
                    "type": "CUSTOMER_GENDER",
                    "status": "NOT_APPLICABLE"
                },
                {
                    "type": "CUSTOMER_FIRST_NAME",
                    "status": "ATTENTION"
                }
            ]
        },
        "expiration_check": {
            "status": "ATTENTION",
            "breakdown": [
                {
                    "type": "DOCUMENT_EXPIRATION",
                    "status": "ATTENTION"
                }
            ]
        }
    },
    "properties": {
        "document_type": "NATIONAL_IDENTITY_CARD",
        "document_data": {
            "document_number": "GZ000030E",
            "mrz_line1": "IDGIBGZ000030E2Q15000174<<<<<<",
            "mrz_line2": "7402061M2501280GBR<<<<<<<<<<<0",
            "mrz_line3": "FREEMAN<<PAUL<JAMES<<<<<<<<<<<",
            "issuing_country": "GIB",
            "expiry_date": {
                "day": 28,
                "month": 1,
                "year": 2025
            }
        },
        "holder_data": {
            "first_name": [
                "PAUL",
                "JAMES"
            ],
            "last_name": [
                "FREEMAN"
            ],
            "dob": {
                "day": 6,
                "month": 2,
                "year": 1974
            },
            "nationality": "GBR",
            "gender": "MALE"
        },
        "extracted_images": []
    },
    "status": "DONE",
    "id": "42583ade-f2b9-4bed-903a-bc46a215040c"
}
```

#### List all document verifications for customer

Lists all existing document verifications for a given customer. The verifications are returned sorted by creation date, 
with the most recent verifications appearing first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the 
following optional parameters can be used to refine the response.

ATTRIBUTE

- **customer_id** required

```php
(new SwiftDilAPI())->DocumentVerification()->getAll($customerId);
```

## Identity Verification

SwiftDil uses the latest in computer vision and biometric algorithms to calculate a similarity score of how likely two faces belong to the same person.

The API allows you to create and retrieve identity verification requests.

> Only JPEG, PNG, and BMP formats are currently supported. The allowed image file size is from 1KB to 4MB.

<a href="https://reference.swiftdil.com/#the-identity-verification-object" target="_blank">Identity Verification object</a>

*Example Response:*

```json
{
    "created_at": "2017-11-10T22:54:17Z",
    "updated_at": "2017-11-10T22:54:17Z",
    "document_id": "c29ed1c4-59ee-4b8f-ab9c-4829fabaffd5",
    "customer_id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "entity_name": "John Doe",
    "selfie_id": "a7794f29-ed41-4ceb-8fce-9b368d570059",
    "status": "DONE",
    "face_match": true,
    "similarity": 0.9531,
    "face_analysis":{
        "selfie_image":{
            "age": 25,
            "gender": "MALE",
            "exposure_level" : "GOOD_EXPOSURE",
            "noise_level" : "LOW",
            "blur_level" : "LOW"
        },
        "identity_document":{
            "age": 22,
            "gender": "MALE",
            "exposure_level" : "GOOD_EXPOSURE",
            "noise_level" : "LOW",
            "blur_level" : "LOW"
        }
    },
    "id": "6eb21-78cd-4cb4-b9bf-12a31ac44e1e"
}
```

#### Create an identity verification

Creates a new identity verification object.

ATTRIBUTES

- **customer_id** required
- **document_id** required
- **selfie** required

*Example Request:*

```php
$data = [
    'document_id' => $data['document_id'],
    'selfie'      => base64_encode($data['image']),
];

(new SwiftDilAPI())->IdentityVerification()->create($customerId, $data);
```

#### Retrieve an identity verification

Retrieves the details of an existing identity verification. You need to supply the unique customer and identity verification identifier.

ATTRIBUTES

- **customer_id** required
- **identification_id** required

*Example Request:*

```php
(new SwiftDilAPI())->IdentityVerification()->get($customerId, $identificationId);
```

*Example Response:*

```json
{
    "created_at": "2017-11-10T22:54:17Z",
    "updated_at": "2017-11-10T22:54:17Z",
    "document_id": "c29ed1c4-59ee-4b8f-ab9c-4829fabaffd5",
    "customer_id": "b19872d0-07ea-4d04-84eb-eb7758869b28",
    "entity_name": "John Doe",
    "selfie_id": "a7794f29-ed41-4ceb-8fce-9b368d570059",
    "status": "DONE",
    "face_match": true,
    "similarity": 0.9531,
    "face_analysis":{
        "selfie_image":{
            "age": 25,
            "gender": "MALE",
            "exposure_level" : "GOOD_EXPOSURE",
            "noise_level" : "LOW",
            "blur_level" : "LOW"
        },
        "identity_document":{
            "age": 22,
            "gender": "MALE",
            "exposure_level" : "GOOD_EXPOSURE",
            "noise_level" : "LOW",
            "blur_level" : "LOW"
        }
    },
    "id": "6eb21-78cd-4cb4-b9bf-12a31ac44e1e"
}
```

#### List all identity verifications for customer

Lists all existing identity verifications for a given customer. The verifications are returned sorted by creation date, with the most recent verifications appearing first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the following optional parameters can be used to refine the response.

ATTRIBUTES

- **customer_id** required

*Example Request:*

```php
(new SwiftDilAPI())->IdentityVerification()->getAll($customerId);
```

## Report

Each report type is associated with its own set of parameters, passed in a key-value format:

| Report Type | Parameters | Description |
| ----- | ----- | -----|
| `SCREENING_REPORT`| `screening_id` string | Generates a report for a completed screening request. |

#### Retrieve a report

Retrieves the details of an existing report. You need to supply the unique report identifier.

ATTRIBUTES

- **report_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Report()->get($reportId);
```

*Example Response:* 

```json
{
    "id" : "4bf7a508-8de8-467e-9c7c-3244fd71fd98",
    "name" : "My first report",
    "type" : "SCREENING_REPORT",
    "parameters" : {
        "screening_id" : "5d2aa508-8de8-467e-9c7c-6dd4fd71fd98"
    },
    "created_at" : "2018-02-11T12:00:16Z"
}
```

#### Download a report

Downloads a report document. You need to supply the unique report identifier and extension.

ATTRIBUTES

- **report_id** required
- **extension** required PDF

*Example Request:*

```php
(new SwiftDilAPI())->Report()->download($reportId, $extension);
```

## List all reports

Lists all existing reports. The reports are returned sorted by creation date, with the most recent reports appearing first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the following optional parameters can be used to refine the response.

*Example Request:*

```php
(new SwiftDilAPI())->Report()->getAll();
```

## File

Several of our services, such as document verification and identity verification , make use of file attachments in order to execute a check.

The files API allows you to retrieve, update, upload, download and delete any of these files. It provides means to upload and download files as multipart/form-data or application/json (i.e. Base64 encoded content).

#### File object

| Column name | Type | Description |
| ----- | ----- | -----|
| id | string | The unique identifier for the file. |
| created_at | datetime | The date and time when the file was created. | 
| updated_at | datetime | The date and time when the file was updated. | 
| filename | string | The file name. |
| size | string | The size of the file in bytes. Required for an `application/json` request. |
| content_type | string | The MIME-standard content type of the file (e.g. `image/jpeg`). |
| content | string | Base64 encoded file content. Required for an `application/json` request. |
| file | form-data parameter | An attribute indicating a path to the local file to be uploaded. Required for a `multipart/form-data` request. |
| locked | boolean | This will be set to `true` if the file is locked and can no longer be deleted, or `false` if it can be deleted. |

*Example Response:*

```json
{
    "id" : "a83c69b3-c945-46d6-af13-08618a1c87a2",
    "created_at" : "2018-02-14T12:00:16Z",
    "updated_at" : "2018-02-14T12:00:16Z",
    "content_type" : "image/jpeg",
    "filename" : "passport",
    "size" : 1234,
    "content" : "<base64-encoded data>",
    "locked" : false
}
```

#### Retrieve a file

Retrieves the details of an existing file. You need to supply the unique file identifier.

ATTRIBUTE

- **file_id** required

*Example Request:* 

```php
(new SwiftDilAPI())->File()->get($fileId);
```

*Example Response:*

```json
{
    "id" : "a83c69b3-c945-46d6-af13-08618a1c87a2",
    "created_at" : "2018-02-14T12:00:16Z",
    "updated_at" : "2018-02-14T12:00:16Z",
    "content_type" : "image/jpeg",
    "filename" : "passport",
    "size" : 1234,
    "content" : "<base64-encoded data>",
    "locked" : false
}
```

#### Download a file

Downloads a previously uploaded file. You need to supply the unique file identifier and output format.

ATTRIBUTES

- **file_id** required
- **output** required, `STREAM` or `BASE64`

*Example Request:*

```php
(new SwiftDilAPI())->File()->download($fileId, $output);
```

#### Update a file


Updates the details and content of an existing file. This is an idempotent method and will require all fields you have on the file to be provided as part of request. This will ensure file details held in your system are in line with the details held by SwiftDil.

Please note, this currently works with application/json requests only (i.e. BASE64 encoded content).

ATTRIBUTES 

- **file_id** required
- **size** required
- **content_type** required
- **content** required
- **file** required


```php

$data = [
    "content_type" => "image/jpeg",
    "filename"     => "passport copy",
    "size"         => 1234,
    "content"      => "<base64-encoded data>",
];

(new SwiftDilAPI())->File()->update($fileId, $data);
```

*Example Response:*

```json
{
  "id" : "a83c69b3-c945-46d6-af13-08618a1c87a2",
  "created_at" : "2018-02-14T12:00:16Z",
  "updated_at" : "2018-02-14T12:10:42Z",
  "content_type" : "image/jpeg",
  "filename" : "passport copy",
  "size" : 1234,
  "content" : "<base64-encoded data>",
  "locked" : false
}
```

#### Delete a file

Deletes an existing file. You need only supply the unique file identifier. Please note, once a file attachment has undergone any type of checks (e.g. document verification, identity verification), it can no longer be deleted.

ATTRIBUTE

- **file_id** required

```php
(new SwiftDilAPI())->File()->delete($fileId);
```

## Note

A note is a comment that can be associated with a customer to support operational activities. The API allows you to create, retrieve, update, and delete notes.

#### Note object

| Column name | Type | Description |
| ----- | ----- | ----- |
| id | string | The unique identifier for the file. |
| created_at | datetime | The date and time when the file was created. | 
| updated_at | datetime | The date and time when the file was updated. | 
| text | string | The text of the note. A note can not exceed 4000 characters. |

#### Create a note

Creates a new note object.

ATTRIBUTES

- **customer_id** required
- **text** required
 
*Example Request:*

```php
$data = [
    "text" => "A useful note about John Doe"
];

(new SwiftDilAPI())->Note()->create($customerId, $data);
```

*Example Response:*

```json
{
    "id": "91d457aa-b086-42fc-b4f9-c0649b99f689",
    "created_at": "2017-01-17T23:46:26Z",
    "updated_at": "2017-01-17T23:46:26Z",
    "text": "A useful note about John Doe."
}
```

#### Retrieve a note

Retrieves the details of an existing note. You need to supply the unique customer and note identifier.

ATTRIBUTES

- **customer_id** required
- **note_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Note()->get($customerId, $noteId);
```

*Example Response:*

```json
{
    "id": "91d457aa-b086-42fc-b4f9-c0649b99f689",
    "created_at": "2017-01-17T23:46:26Z",
    "updated_at": "2017-01-17T23:46:26Z",
    "text": "A useful note about John Doe."
}
```

#### Update a note

Updates the details of an existing note. You need to supply the unique customer and note identifier.

ATTRIBUTES

- **customer_id** required
- **note_id** required
- **text** 

 
*Example Request:*

```php
$data = [
    "text" => "A useful note about John Doe"
];

(new SwiftDilAPI())->Note()->update($customerId, $noteId, $data);
```

*Example Response:*

```json
{
    "id": "91d457aa-b086-42fc-b4f9-c0649b99f689",
    "created_at": "2017-01-17T23:46:26Z",
    "updated_at": "2017-01-17T23:46:26Z",
    "text": "A useful note about John Doe."
}
```

#### Delete a note

Deletes an existing note. You need to supply the unique customer and note identifier.

ATTRIBUTES

- **customer_id** required
- **note_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Note()->delete($customerId, $noteId);
```

#### List all notes

Lists all existing identity verifications for a given customer. The verifications are returned sorted by creation date, with the most recent verifications appearing first. In addition to the attributes listed on the <a href="https://reference.swiftdil.com/#pagination" target="_blank">pagination</a> section, the following optional parameters can be used to refine the response.

ATTRIBUTES

- **customer_id** required

*Example Request:*

```php
(new SwiftDilAPI())->Note()->getAll($customerId);
```
