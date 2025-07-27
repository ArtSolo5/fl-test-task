# Contact Form - Middle Fullstack Developer Test Task

## Опис завдання

Це тестове завдання на позицію Middle Fullstack Developer. Потрібно було створити контактну форму з можливістю завантаження резюме.

## Архітектура проекту

Проект розділений на дві частини:

- **Frontend** (`frontend/`) - Vue.js додаток з Vite
- **Backend** (`backend/`) - Laravel API

## Реалізований функціонал

### Frontend (Vue.js)

- ✅ Контактна форма з полями:
  - Ім'я (обов'язкове, максимум 35 символів)
  - Email (обов'язковий, валідація email, максимум 35 символів)
  - Телефон (обов'язковий, використовується `intl-tel-input` з початковою країною Україна)
  - Повідомлення (опціональне, максимум 500 символів)
  - Чекбокс згоди на обробку персональних даних
  - Завантаження файлу (обов'язкове, якщо відмічено чекбокс, тільки зображення)
- ✅ Валідація форми з використанням VeeValidate + Yup
- ✅ AJAX відправка форми через fetch API
- ✅ Відображення помилок валідації
- ✅ Лоадер під час відправки
- ✅ Повідомлення про успіх/помилку
- ✅ Адаптивний дизайн з Tailwind CSS

### Backend (Laravel)

- ✅ API endpoint для прийому даних форми
- ✅ Валідація даних на сервері
- ✅ Збереження даних в базу даних
- ✅ Відправка email з даними форми (через Mailtrap.io)
- ✅ Обробка файлів

## Технології

### Frontend

- Vue.js 3
- Vite
- Tailwind CSS
- VeeValidate + Yup
- intl-tel-input

### Backend

- Laravel 11
- MySQL/PostgreSQL
- Mailtrap.io для email

## Встановлення та запуск

### Передумови

- Node.js (версія 18+)
- PHP 8.2+
- Composer
- MySQL або PostgreSQL

### Backend

1. Перейдіть в папку backend:

```bash
cd backend
```

2. Встановіть залежності:

```bash
composer install
```

3. Скопіюйте .env.example в .env:

```bash
cp .env.example .env
```

4. Налаштуйте базу даних в .env файлі:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contact_form
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Налаштуйте Mailtrap в .env:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

6. Згенеруйте ключ додатку:

```bash
php artisan key:generate
```

7. Запустіть міграції:

```bash
php artisan migrate
```

8. Запустіть сервер:

```bash
php artisan serve
```

Backend буде доступний за адресою: http://localhost:8000

### Frontend

1. Перейдіть в папку frontend:

```bash
cd frontend
```

2. Встановіть залежності:

```bash
npm install
```

3. Запустіть dev сервер:

```bash
npm run dev
```

Frontend буде доступний за адресою: http://localhost:3000

## Тестування

1. Відкрийте http://localhost:3000 в браузері
2. Заповніть форму тестовими даними
3. Спробуйте відправити форму з різними комбінаціями полів
4. Перевірте, що дані зберігаються в базі даних
5. Перевірте, що email відправляється в Mailtrap

## Структура проекту

```
fl-test-task/
├── frontend/
│   ├── src/
│   │   ├── components/
│   │   │   ├── ContactForm.vue
│   │   │   ├── TextInput.vue
│   │   │   ├── PhoneInput.vue
│   │   │   ├── TheButton.vue
│   │   │   ├── TheTextarea.vue
│   │   │   ├── TheCheckbox.vue
│   │   │   └── UploadFile.vue
│   │   ├── App.vue
│   │   └── main.js
│   ├── index.html
│   ├── package.json
│   └── vite.config.js
└── backend/
    ├── app/
    │   ├── Http/
    │   │   └── Controllers/
    │   │       └── SubmissionController.php
    │   │   └── Requests/
    │   │       └── StoreSubmissionRequest.php
    │   └── Models/
    │       └── Submission.php
    ├── database/
    │   └── migrations/
    └── routes/
        └── api.php
```

## Особливості реалізації

- Використовується розділена архітектура frontend/backend
- Валідація відбувається як на фронтенді, так і на бекенді
- Телефонне поле використовує міжнародну бібліотеку з підтримкою країн
- Файли зберігаються локально (можна легко змінити на cloud storage)
- Email відправляється на адресу, вказану в формі
- Форма має адаптивний дизайн
