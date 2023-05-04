# Route map

## Взаимодействия с пользователем
>> ### Регистрация  
>> * `POST` - `../api/register` - `request_body {"firstname": str, "lastname": str, "email": str, "phone": str, "password": str, "password_confirmation": str, "birthday": date(YYYY-MM-DD), "photo": file(jpg, jpeg, png), "position_id": numeric}`  
>> * {"success" : "User successfully created"}  
>> * {"error"   : "Failed to create user"}  
>> * Validation errors {"message": "The email has already been taken. (and 1 more error)","errors":{"email":["The email has already been taken."],"phone":["The phone has already been taken."]}}
>>> #### Получить все отделы
>>> * `POST` - `../api/departments`
>>> #### Получить все должности отдела
>>> * `POST` - `../api/positions` - `request_body {"department_id": numeric}`
> 
>> ### Авторизация 
>> * `POST` - `../api/login - request_body {"login(phone)": str || "login(email)": str, "password": text}`
>> * {"success" : "You are successfully logged in"}
>> * {"error"   : "Failed to login"}
> 
>> ### Выход 
>> * `POST` - `../api/logout`
>> * {"success" : "User successfully logged out"}

## Взаимодействия с рабочим днём
>> ### Начать рабочий день
>> * `POST` - `../api/startDay - request_body {"workplace_id: numeric"}`
>> * {"success" : "You are successfully started working day"}
>> * {"error"   : "Failed to start working day"}
> 
>> ### Отойти с рабочего места
>> * `POST` - `../api/pauseDay`
>> * {"success" : "You are successfully paused working day"}
>> * {"error"   : "Failed to pause working day"} 
> 
>> ### Вернуться на рабочее место
>> * `POST` - `../api/resumeDay - request_body {"workplace_id: numeric"}`
>> * {"success" : "You are successfully resumed working day"}
>> * {"error"   : "Failed to resume working day"}
>
>> ### Закончить рабочий день
>> * `POST` - `../api/endDay - request_body {"without_lunch": bool(null)"}`
>> * {"success" : "You are successfully ended working day"}
>> * {"error"   : "Failed to end working day"}
>
>> ### Добавить комментарий к рабочему дню
>> * `POST` - `../api/addComment - request_body {"comment": str"}`
>> * {"success" : "Your comment has been successfully attached"}
>> * {"error"   : "Failed to attach your comment"}

## Отчётность
>> ### Скачать отчёт факт-смен для одного сотрудника
>> * `GET` - `../api/downloadPersonalReport`
>> * {"success" : "Personal fact report successfully download"}
>> * {"error"   : "Failed to find any records in database for that month"}
>
>> ### Скачать отчёт факт-смен для всех сотрудников
>> * `GET` - `../api/downloadTotalReport`
>> * {"success" : "Total fact report successfully download"}
>> * {"error"   : "Failed to find any records in database for that month"}
>
>> ### Скачать полный отчёт для всех сотрудников
>> * `GET` - `../api/downloadFullReport`
>> * {"success" : "Full report successfully download"}
>> * {"error"   : "Failed to find any records in database for that month"}
