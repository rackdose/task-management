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

Login (get token) [POST]
```
{{baseUrl}}/api/login/
```

Get all task [GET]
```
{{baseUrl}}/api/tasks
```

Get task by id [GET]
```
{{baseUrl}}/api/tasks/{id}
```

Get task by assigned user [GET]
```
{{baseUrl}}/api/tasks/assigned_user/{id}
```

## License

[MIT](https://choosealicense.com/licenses/mit/)