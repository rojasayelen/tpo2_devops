# 🚀 Proyecto DevOps - TPO N° 2: Estudio RVP

Este repositorio contiene el Trabajo Práctico Obligatorio N° 2 para la materia de DevOps. El objetivo es dockerizar una aplicación web completa, incluyendo un servidor web con PHP y una base de datos MySQL, gestionando la comunicación entre contenedores.

---

## 🛠️ Tecnologías Utilizadas

*   **Contenerización:** <img src="https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
*   **Servidor Web:** <img src="https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=Apache&logoColor=white" alt="Apache">
*   **Lenguaje:** <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
*   **Base de Datos:** <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">

---

## 🐳 Arquitectura Docker

La aplicación se compone de dos contenedores principales que se comunican a través de una red personalizada:

-   📦 **Contenedor Web (`mi-servidor-web-AyelenRojas`):**
    -   Servicio: Apache
    -   Intérprete: PHP 8.4
    -   Responsable de servir la aplicación web.

-   🗃️ **Contenedor BD (`estudioRVP`):**
    -   Servicio: MySQL
    -   Almacena los datos de la aplicación.

-   🌐 **Red (`red-Estudio-app`):**
    -   Permite que el contenedor web se comunique con el contenedor de la base de datos utilizando sus nombres de servicio como hostnames.

---

## ⚙️ Configuración y Uso

Sigue estos pasos para levantar el entorno de desarrollo local.

### Prerrequisitos

-   [Docker](https://www.docker.com/get-started) instalado.
-   [Docker Compose](https://docs.docker.com/compose/install/) (generalmente incluido con Docker Desktop).
-   Un cliente de base de datos como [MySQL Workbench](https://www.mysql.com/products/workbench/) (Opcional).

### 1. Levantar los Servicios

Para iniciar todos los servicios, ejecuta el siguiente comando en la raíz del proyecto:

```bash
docker-compose up -d
```

Esto creará y ejecutará los contenedores de la aplicación web y la base de datos en segundo plano (`-d`).

### 2. Acceso a los Servicios

Una vez que los contenedores estén en funcionamiento, puedes acceder a ellos de la siguiente manera:

-   **Aplicación Web:**
    -   URL: `http://localhost:8080`

-   **Base de Datos (desde tu PC/Workbench):**
    -   **Host:** `localhost`
    -   **Puerto:** `3307`
    -   **Usuario:** `root`
    -   **Contraseña:** `root`

### 3. Conexión desde PHP a MySQL

Dentro del entorno Docker, el código PHP se conecta a la base de datos utilizando el nombre del servicio de MySQL como host y el puerto interno por defecto.

```php
<?php
// Variables de conexión dentro de la red de Docker
$host = "estudioRVP";  // Nombre del contenedor/servicio de MySQL
$port = "3306";        // Puerto interno del contenedor de MySQL
$user = "root";
$pass = "root";
$dbname = "Estudio";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    // Configurar el modo de error de PDO para que lance excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos!";
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
```

---
## 📄 Archivos de Configuración

-   `Dockerfile`: Define la imagen personalizada para el servicio web (Apache + PHP).
-   `docker-compose.yml`: Orquesta la creación y conexión de todos los contenedores y redes.
---

## ✒️ Autora

-   **Ayelen Rojas**
