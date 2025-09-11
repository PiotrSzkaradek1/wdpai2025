# Loot Tracker

Loot Tracker is a web application for tracking loot drops, characters, and bosses in an RPG-like environment. It allows users to register, log in, add characters, select bosses, record loot, and view loot statistics.

## Features

- User registration and authentication
- Add and manage characters
- Select bosses and difficulty levels
- Record loot drops (items, gold, rars, synergetics, drifs, etc.)
- View loot statistics and summaries per character and boss
- Responsive UI with modern design

## Technologies

- PHP 8.3 (with PDO and PostgreSQL)
- PostgreSQL database
- Nginx (Dockerized)
- JavaScript (frontend logic)
- HTML/CSS (responsive design)
- Docker & Docker Compose

## Project Structure

- `public/` - Public assets, entry points, and views
- `src/` - PHP source code (controllers, models, repositories)
- `docker/` - Docker configuration for PHP, Nginx, and DB
- `index.php` - Main entry point and router
- `config.php` - Database configuration
- `docs/` - Documentation, database ERD, and SQL backups

## Getting Started

### Prerequisites

- [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)

### Setup

1. Clone the repository:

    ```sh
    git clone https://github.com/PiotrSzkaradek1/wdpai2025
    cd <project-directory>
    ```

2. Start the application using Docker Compose:

    ```sh
    docker-compose up --build
    ```

3. The app will be available at [http://localhost:8080](http://localhost:8080).

4. PgAdmin is available at [http://localhost:5050](http://localhost:5050) (default login: admin@example.com / admin).

### Default Database Credentials

- Host: `db`
- User: `postgres`
- Password: `haslo`
- Database: `db_admin`

## Database

### ERD Diagram

The Entity-Relationship Diagram (ERD) for the database can be found in the `docs` folder:

- [ERD Diagram](docs/erd_diagram.png)

### SQL Backup

The full PostgreSQL database export (structure + data) is available in the `docs` folder:

- [db_admin.sql](docs/db_admin.sql)

## Usage

- Register a new user and log in.
- Add your characters.
- Select a boss and difficulty.
- Record loot drops after each boss fight.
- View your loot statistics in the "stash" section.

## Development

- PHP source code is in the `src/` directory.
- Frontend assets are in `public/`.
- Dockerfiles for PHP, Nginx, and DB are in `docker/`.

## License

This project is for educational purposes.
