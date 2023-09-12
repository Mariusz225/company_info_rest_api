# Company Information REST API

## Description
This is a Symfony-based REST API application that allows users to submit information about a company, including the company's name, NIP, address, city, and postcode, as well as information about its employees, such as name, surname, and email. All fields are mandatory except for the phone number, which is optional.
 
## Getting started
To run this project, you'll need Docker and Docker Compose installed on your system.


## Installation
1. Clone this repository to your local machine:</br>
`git clone "URL"`
2. Navigate to the project directory:<br/>
`cd company-info-rest-api`
3. Build and start the Docker containers:</br>
`docker-compose up -d --build`
4. Install project dependencies using Composer:</br>
`docker exec -it company_info_rest_api-php-1 composer install`
5. Run database migrations to set up the database schema:</br>
`docker exec -it company_info_rest_api-php-1 php bin/console doctrine:migrations:migrate`


## Usage
To interact with the API, you can use the following endpoint to create a company with employees:
Create a Company with Employees

Endpoint: `/api/company/createCompanyWithEmployees`</br>
HTTP Method: `POST`

Request Body:
```json
{
  "company": {
    "name": "Company name",
    "nip": "0000000000",
    "address": "Company address",
    "city": "Company city",
    "postcode": "123-321",
    "employees": [
      {
        "employee": {
          "name": "name1",
          "surname": "surname1",
          "email": "email1@gmail.com"
        }
      },
      {
        "employee": {
          "name": "name2",
          "surname": "surname2",
          "email": "email2@gmail.com"
        }
      }
    ]
  }
}
```

Response:
```json
{
  "companyId": "{id of created company}"
}

```
