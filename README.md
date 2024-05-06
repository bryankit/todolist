# Task Manager

The Task Manager is a web application designed to help users manage their tasks efficiently. It provides features for creating, updating, and deleting tasks, as well as filtering and sorting options to organize tasks effectively.

## Features

-   **Task Management**: Create, update, and delete tasks.
-   **Filtering**: Filter tasks by status.
-   **Sorting**: Sort tasks by title or date created.
-   **Search**: Search tasks by title.
-   **Status Update**: Change the status/publish of tasks.
-   **Trash**: Move tasks to trash, automatically removed within 30 days.

## Technologies Used

-   **Framework**: Laravel 11
-   **Database**: SQLite
-   **Frontend**: HTML, CSS, JavaScript (with Tailwind CSS for styling)
-   **Testing**: PHPUnit

## Getting Started

To get started with the Task Manager, follow these steps:

1. **Clone the Repository**: `git clone https://github.com/bryankit/todolist.git`
2. **Install Dependencies**: `composer install then npm run dev`
3. **Set Up Environment Variables**: Copy the `.env.example` file to `.env`.
4. **Run Migrations**: `php artisan migrate`
5. **Serve the Application**: `php artisan serve`
6. **Start the development server**: `npm run dev`
7. **Access the Application**: Open your web browser and navigate to `http://localhost:8000`.
8. **Seed Database (Optional)**: If you want to populate the database with sample data, run `php artisan db:seed --class=TaskSeeder` after registering a user. Note : user_id is set to 1 so the first user to be registered will have this data.

## Feature Testing

1. **Run the PHP Unit testing Command**: `php artisan test`

## Contributing

Contributions are welcome! If you have any suggestions, feature requests, or bug reports, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).
