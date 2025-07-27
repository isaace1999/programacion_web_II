CREATE DATABASE ORGANIZACION;
USE ORGANIZACION;

CREATE TABLE PROYECTO (
    id_proyecto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    presupuesto DECIMAL(10,2),
    fecha_inicio DATE,
    fecha_fin DATE
);

CREATE TABLE DONANTE (
    id_donante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    direccion TEXT,
    telefono VARCHAR(20)
);

CREATE TABLE DONACION (
    id_donacion INT AUTO_INCREMENT PRIMARY KEY,
    monto DECIMAL(10,2),
    fecha DATE,
    id_proyecto INT,
    id_donante INT,
    FOREIGN KEY (id_proyecto) REFERENCES PROYECTO(id_proyecto),
    FOREIGN KEY (id_donante) REFERENCES DONANTE(id_donante)
);

CREATE TABLE VOLUNTARIO (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    direccion TEXT,
    contrasena VARCHAR(255) NOT NULL,
    disponibilidad VARCHAR(50),
    rol VARCHAR(50),
    id_proyecto INT,
    FOREIGN KEY (id_proyecto) REFERENCES PROYECTO(id_proyecto)
);
