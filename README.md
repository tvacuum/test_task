## Route map

> **Взаимодействия с пользователем**
>> Регистрация  
>> * `POST` - `../api/register` - `request_body {"firstname": str, "lastname": str, "email": str, "phone": str, "password": str, "password_confirmation": str, "birthday": date(YYYY-MM-DD), "photo": file(jpg, png)}`  
>> * {"success" : "User successfully created"}  
>> * {"error"   : "Failed to create user"}  
>> * Validation errors {"message": "The email has already been taken. (and 1 more error)","errors":{"email":["The email has already been taken."],"phone":["The phone has already been taken."]}}
> 
>> Авторизация 
>> * `POST` - `../api/login - request_body {"login(phone)": str || "login(email)": str, "password": text}`
>> * {"success" : "You are successfully logged in"}
>> * {"error"   : "Failed to login"}
> 
>> Выход 
>> * `POST` - `../api/logout`
>> * {"success" : "User successfully logged out"}

> **Взаимодействия с рабочим днём**
>> Начать рабочий день
>> * `POST` - `../api/startDay - request_body {"workplace_id: int"}`
>> * {"success" : "You are successfully started working day"}
>> * {"error"   : "Failed to start working day"}
> 
>> Отойти с рабочего места
>> * `POST` - `../api/pauseDay`
>> * {"success" : "You are successfully paused working day"}
>> * {"error"   : "Failed to pause working day"} 
> 
>> Вернуться на рабочее место
>> * `POST` - `../api/resumeDay`
>> * {"success" : "You are successfully resumed working day"}
>> * {"error"   : "Failed to resume working day"}
>
>> Закончить рабочий день
>> * `POST` - `../api/endDay - request_body {"without_lanch": bool(null)"}`
>> * {"success" : "You are successfully ended working day"}
>> * {"error"   : "Failed to end working day"}
>
>> Добавить комментарий к рабочему дню
>> * `POST` - `../api/addComment - request_body {"comment": str"}`
>> * {"success" : "Your comment has been successfully attached"}
>> * {"error"   : "Failed to attach your comment"}

> **Отчётность**
>> Скачать отчёт сотрудника
>> * `GET` - `../api/downloadReport`
>> * {"success" : "Personal fact report successfully download"}
>> * {"error"   : "Failed to find any records in database for that month"}
