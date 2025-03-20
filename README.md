# CRM Contact Module

## Architecture Overview

This project implements a Contact management module for a CRM system using Laravel 11 and React. The architecture follows these key principles:

### Backend
- **Modular Structure**: The code is organized in a modular monolith pattern under `app/Modules`
- **Domain-Driven Design**: Uses DTOs, Services, and Actions to encapsulate business logic
- **Strong Typing**: Utilizes PHP 8.2+ features with strict typing
- **Command Pattern**: Implements both API and CLI interfaces using shared business logic
- **Validation**: Custom validators for E164 phone numbers and email formats

### Frontend
- **React + TypeScript**: For type safety and better developer experience
- **React Query**: For efficient server state management
- **Mantine UI**: For rapid development of a professional UI
- **Modular Components**: Component-based architecture for reusability

## Future Improvements
Given more time, these areas could be enhanced:
- Implement proper event sourcing for contact actions
- Add more comprehensive error handling
- Implement proper phone number formatting/validation library
- Add pagination for contact searches
- Implement proper authentication/authorization
- Add more comprehensive test coverage
- Add proper logging and monitoring

## Setup Instructions

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL/PostgreSQL

### Installation Steps

1. Clone the repository and install PHP dependencies:
```bash
git clone <your-repo-url>
cd crm-test
composer install
```

2. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
```

3. Configure your database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_test
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. Run migrations:
```bash
php artisan migrate
```

5. Install frontend dependencies:
```bash
npm install
```

### Running the Application

1. Start the Laravel development server:
```bash
php artisan serve
```

2. In a separate terminal, start the Vite development server:
```bash
npm run dev
```

The application will be available at:
- Frontend: http://localhost:5173
- API: http://localhost:8000/api

### Using the CLI Interface

The contact management CLI is available through artisan commands:

```bash
# Create or update a contact
php artisan contacts upsert --name="John Doe" --phone="+61412345678" --email="john@example.com"

# Search for contacts
php artisan contacts search --query="john"

# Show a specific contact
php artisan contacts show --id=1

# Delete a contact
php artisan contacts delete --id=1

# Simulate a call
php artisan contacts call --id=1
```

### API Endpoints

Test the API using curl or Postman:

1. Create/Update Contact:
```bash
curl -X POST http://localhost:8000/api/contacts \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","phone":"+61412345678","email":"john@example.com"}'
```

2. Get Contact:
```bash
curl http://localhost:8000/api/contacts/1
```

3. Search Contacts:
```bash
curl http://localhost:8000/api/contacts/search?q=john&type=name
```

4. Delete Contact:
```bash
curl -X DELETE http://localhost:8000/api/contacts/1
```

5. Simulate Call:
```bash
curl -X POST http://localhost:8000/api/contacts/1/call
```

### Running Tests

Run the test suite:
```bash
php artisan test
```

Run specific test files:
```bash
php artisan test --filter=ContactControllerTest
```

### Development Notes

- The frontend is built with React + TypeScript
- API validation errors will be returned in JSON format
- Phone numbers must be in E164 format (+61 or +64 prefix)
- Search supports filtering by name, phone, or email domain

### Troubleshooting

1. If you get database connection errors:
   - Verify your database credentials in `.env`
   - Ensure your database server is running
   - Create the database if it doesn't exist

2. If the frontend doesn't load:
   - Check if Node.js and npm are installed
   - Clear your npm cache: `npm cache clean --force`
   - Delete node_modules and reinstall: `rm -rf node_modules && npm install`

3. If you get permission errors:
   - Ensure storage and bootstrap/cache directories are writable:
     ```bash
     chmod -R 777 storage bootstrap/cache
     ```

### Additional Commands

- Clear application cache:
  ```bash
  php artisan cache:clear
  ```

- Reset database and re-run migrations:
  ```bash
  php artisan migrate:fresh
  ```

- Seed database with test data (if needed):
  ```bash
  php artisan db:seed
  ```
