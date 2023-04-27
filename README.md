## Route map

> **Взаимодействия с пользователем**
> * Регистрация
> * `POST` - `../api/register` - `request_body {"firstname": text,"lastname": text,"email": str,"phone": str,"password": text,"password_confirmation": text,"birthday": date(YYYY-MM-DD),"photo": text}`
> + {"success": "User successfully created"}
> + {"error": "Failed to create user"}
> + Validation errors {"message": "The email has already been taken. (and 1 more error)","errors":{"email":["The email has already been taken."],"phone":["The phone has already been taken."]}}

> * Авторизация 
> * `POST` - `../api/login - request_body{"login(phone)": str || "login(password)": str, "password": text}`
> + {"success": "You are successfully logged in"}
> + {"error": "Failed to login"}

> * Logout 
> * `POST` - `../api/logout`
> + {"success": "User successfully logged out"}

> **Взаимодействия с рабочим днём**
> * Начать рабочий день
> * `POST` - `../api/startDay - request_body{"workplace_id: int"}`
> + {"success": "You are successfully started working day"}
> + {"error": 'Failed to start working day'}

> * Отойти с рабочего места
> * `POST` - `../api/pauseDay`
> + {"success": "You are successfully paused working day"}
> + {"error": 'Failed to pause working day'}> 
> + 
> * Вернуться на рабочее место
> * `POST` - `../api/resumeDay`
> + {"success": "You are successfully resumed working day"}
> + {"error": 'Failed to resume working day'}
