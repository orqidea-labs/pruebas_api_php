/*
Este script SQL inicializa la base de datos para el entorno de pruebas.
Crea una base de datos llamada 'qa_db', un usuario 'qa_user' con la
contraseña 'qa_pass', y una tabla 'users' para almacenar información de usuarios
*/
CREATE DATABASE qa_db;

USE qa_db;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
