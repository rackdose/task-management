# Task Management

Simple task, simply simple. Build with Laravel 8.83.27

## Installation

1. Clone the repository
```bash
git clone https://github.com/rackdose/task-management.git
```

2. Run composer install to get all the dependencies
```bash
composer install
```

3. Run migrations
```bash
php artisan migrate
```

## API

---

### Get Token

```http
POST {{baseUrl}}/api/login/
```

#### Params

| Parameter | Type   |
| --------- | ------ |
| email     | string |
| password  | string |

#### Responses

Success

```http
{
    "success": true,
    "data": {
        "token": "3|FwW3mnlrTHX3z9bso3P4I6kqrDsWhFZ6U1Nkx547",
        "name": "Hariz"
    },
    "message": "User signed in"
}
```

Error

```http
{
    "success": false,
    "message": "Unauthorised.",
    "data": {
        "error": "Unauthorised"
    }
}
```
---

### Get All Task

```http
GET {{baseUrl}}/api/tasks
```

#### Headers

Authorization **Bearer Token**

#### Responses

Success

```http
{
    "success": true,
    "data": [
        {
            "id": 2,
            "title": "Test task 1",
            "description": "task 1 is in progress",
            "user_id": 1,
            "due_date": "2023-06-27",
            "status": 2,
            "created_at": "15/06/2023 03:43:56",
            "updated_at": "15/06/2023 03:43:56"
        }
    ],
    "message": "All task fetched."
}
```

Error

```http
{
   "success": false,
   "message": "Opsss, theres no task available to fetch."
}
```
---

### Get Task by ID

```http
POST {{baseUrl}}/api/tasks/{id}
```

#### Headers

Authorization **Bearer Token**

#### Responses

Success

```http
{
    "success": true,
    "data": {
        "id": 2,
        "title": "Test task 1",
        "description": "task 1 is in progress",
        "user_id": 1,
        "due_date": "2023-06-27",
        "status": 2,
        "created_at": "15/06/2023 03:43:56",
        "updated_at": "15/06/2023 03:43:56"
    },
    "message": "Task fetched."
}
```

Error

```http
{
    "success": false,
    "message": "Task does not exist."
}
```
---

### Get Task by User

```http
POST {{baseUrl}}/api/tasks/assigned-user/{id}
```

#### Headers

Authorization **Bearer Token**

#### Responses

Success

```http
{
    "success": true,
    "data": [
        {
            "id": 2,
            "title": "Test task 1",
            "description": "task 1 is in progress",
            "user_id": 1,
            "due_date": "2023-06-27",
            "status": 2,
            "created_at": "15/06/2023 03:43:56",
            "updated_at": "15/06/2023 03:43:56"
        }
    ],
    "message": "Task fetched."
}
```

Error

```http
{
    "success": false,
    "message": "User does not have any tasks assigned."
}
```

## License

[MIT](https://choosealicense.com/licenses/mit/)