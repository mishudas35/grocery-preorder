# Grocery Pre-Order Backend (Laravel)

This is the backend for the Grocery Pre-Order system, built using Laravel. It handles pre-order management, admin and manager roles, and email notifications.

## Features

- Pre-order form handling (name, email, product).
- Conditional phone field (when email ends with "@xyz.com").
- reCAPTCHA for spam prevention.
- Rate-limiting (maximum of 10 submissions per minute).
- Admin and Manager roles:
    - **Admin**: Full CRUD permissions.
    - **Manager**: View only.
- Soft delete with `deleted_by_id` (records who deleted a pre-order).
- Email notifications:
    - Confirmation emails to users.
    - Admin notifications after user confirmation.
- Queue-based email sending.
- Full API support (decoupled front-end).
- Search, pagination, and ordering functionalities.

## Tech Stack

- **Laravel** (Backend Framework)
- **PostgreSQL** (Database)
- **Vue.js** (Frontend - Separate repository)
- **Bootstrap** (For some default styling)
- **Google reCAPTCHA** (Spam prevention)

## Prerequisites

- PHP >= 8.0
- Composer
- PostgreSQL
- Node.js & npm (for building assets)

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/mishudas35/grocery-preorder.git
   cd grocery-backend


2. Install dependencies:

   bash

   Copy code composer install npm install

3. Copy .env.example to .env and update the environment variables: bash

   Copy code

   cp .env.example .env
4.
   Update the following keys in .env :
- DB_CONNECTION=pgsql
- DB_HOST=127.0.0.1
- DB_PORT=5432
- DB_DATABASE=grocery_preorder
- DB_USERNAME=postgres
- DB_PASSWORD=Postgre5@PrOgTamA
- RECAPTCHA_SITE_KEY="6Lf1sksqAAAAALp8HJb1A4rwNf1w6ONzlHF37Lfn"
- RECAPTCHA_SECRET_KEY="6Lf1sksqAAAAAJe4u9ixPfbUy-qbjaJDKavWgv8M"

- ADMIN_EMAIL="admin@example.com"
- MAIL_MAILER=smtp
- MAIL_HOST=sandbox.smtp.mailtrap.io
- MAIL_PORT=2525
- MAIL_USERNAME=58ffd6007c3e43
- MAIL_PASSWORD=0b91e428a47b3c
- MAIL_ENCRYPTION=tls
mail_from_address="mishu.das35bng@gmail.com"
- MAIL_FROM_NAME="${APP_NAME}"

4. Generate the application key:

   bash

   Copy code

   php artisan key:generate

5. Run database migrations and seed the database (for initial data):

   bash

   Copy code

   php artisan migrate --seed

6. Serve the application:

   bash

   Copy code

   php artisan serve

7. (Optional) To run queues for email notifications, use:

   bash

   Copy code

   php artisan queue:work

**Usage**

- **Admin Access**: The admin has full control over pre-orders (CRUD operations).
- **Manager Access**: Managers can only view pre-orders.

**API Endpoints**

1. **Pre-order Submission POST** /api/preorders
- Body:

  json

  Copy code

  {

  `  `"name": "John Doe",   "email": "john.doe@example.com",   "phone": "1234567890",   "product\_id": 1,   "recaptchaToken": "RECAPTCHA\_TOKEN" }

- Conditional: The phone field is required if the email ends with @xyz.com .
2. **Pre-order List GET** /api/preorders
- Query Params:
    - search : Search by name or email.
    - order\_by : Order by any column.
    - order\_direction : asc or desc .
    - page : For pagination.
    - per\_page : Number of results per page.
3. **Soft Delete a Pre-order (Admin Only) DELETE** /api/preorders/{id}

   **Running Tests**

   To run unit and feature tests:

   bash

   Copy code php artisan test

   **License**

   This project is open-sourced under the MIT license.


