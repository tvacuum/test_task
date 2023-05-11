## Сборка
>Проект собран в докере. Для старта используется файл **build.sh**. Затем накатить БД `php artisan migrate:fresh --seed`.
>>**На Windows все делать из-под wsl**.
>> Развертка в local env:  
>> `bash build.sh`

# Route map

## Пользователь
>> ### Регистрация
>> * `POST` - `../api/register` - `request_body {"firstname": str, "lastname": str, "email": str, "phone": str, "password": str, "password_confirmation": str}`
>> * {"success" : "User successfully created"}
>> * {"error"   : "Failed to create user"}
>> * Validation errors {"message": "The email has already been taken. (and 1 more error)","errors":{"email":["The email has already been taken."],"phone":["The phone has already been taken."]}}
>
>> ### Авторизация
>> * `POST` - `../api/login - request_body {"login(phone)": str || "login(email)": str, "password": str}`
>> * {"success" : "You are successfully logged in"}
>> * {"error"   : "Failed to login"}
>
>> ### Редактировать профиль
>> * `POST` - `../api/edit_user - request_body {"id": int, "firstname": str, "lastname": str, "email": str, "phone": str}`
>> * {"success" : "User's data successfully updated"}
>> * {"error"   : "Failed to update user's data"}
>
>> ### Удалить
>> * `POST` - `../api/delete_user - request_body {"id": int, "firstname": str, "lastname": str, "email": str, "phone": str}`
>> * {"success" : "User successfully deleted"}
>> * {"error"   : "Failed to delete user"}
>
>> ### Выход
>> * `GET` - `../api/logout`
>> * {"success" : "User successfully logged out"}
>
>> ### Получить 1 пользователя
>> * `GET` - `../api/get_user - request_body {"id": int}`
>
>> ### Получить всех пользователей
>> * `GET` - `../api/get_all_users`
>
>> ### Получить всех читателей
>> * `GET` - `../api/get_all_readers`
>
>> ### Получить всех работников
>> * `GET` - `../api/get_all_workers`

## Книги
>> ### Создать
>> * `POST` - `../api/create_book - request_body {"title": str, "slug": str, "author_id": numeric, "description": str, "rating": numeric(Min:0, Max:5), "cover": image(jpg, jpeg, png)}`
>> * {"success" : "Book successfully created"}
>> * {"error"   : "Failed to create book"}
>
>> ### Обновить
>> * `POST` - `../api/update_book - request_body {"title": str, "slug": str, "author_id": numeric, "description": str, "rating": numeric(Min:0, Max:5)}`
>> * {"success" : "Book's data successfully updated"}
>> * {"error"   : "Failed to update book's data"}
>
>> ### Удалить
>> * `POST` - `../api/delete_book - request_body {"id": int}`
>> * {"success" : "Book successfully deleted"}
>> * {"error"   : "Failed to delete book"}
>
>> ### Получить 1 книгу
>> * `GET` - `../api/get_book - request_body {"id": int}`
>
>> ### Получить все книги (10шт/стр)
>> * `GET` - `../api/get_all_books`

## Категории
>> ### Создать
>> * `POST` - `../api/create_category - request_body {"title": str, "slug": str}`
>> * {"success" : "Category successfully created"}
>> * {"error"   : "Failed to create category"}
>
>> ### Обновить
>> * `POST` - `../api/update_category - request_body {"id": int, "title": str, "slug": str}`
>> * {"success" : "Category's data successfully updated"}
>> * {"error"   : "Failed to update category's data"}
>
>> ### Удалить
>> * `POST` - `../api/delete_category - request_body {"id": int}`
>> * {"success" : "Category successfully deleted"}
>> * {"error"   : "Failed to delete Category"}
>
>> ### Получить категорию, с книгами которые ей присущи
>> * `GET` - `../api/get_category - request_body {"id": int}`

## Excel
>> ### Скачать таблицу xlsx с книгами / категориями / авторами
>> * `GET` - `../api/download_books`
>> * {"success" : "Books.xlsx successfully downloaded"}
>> * {"error"   : "Failed to find any records in database"}
