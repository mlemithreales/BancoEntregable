# Banco ADSO

Sistema bancario web desarrollado como proyecto de formación para ADSO. La aplicación permite a los usuarios autenticarse mediante su número de cuenta y contraseña, consultar su cuenta y saldo, realizar retiros y transferencias, y consultar el historial de operaciones.

## Descripción del proyecto

**Banco ADSO** es una aplicación web desarrollada con PHP y MySQL. El proyecto utiliza una arquitectura organizada por capas para separar las responsabilidades de la aplicación:

- **Controladores:** reciben las solicitudes del usuario y coordinan las acciones.
- **Servicios:** contienen la lógica de negocio de operaciones como retiros y transferencias.
- **Repositorios:** se encargan de consultar y modificar la información de la base de datos.
- **Modelos:** representan las entidades principales del sistema.
- **Núcleo:** contiene componentes reutilizables como la conexión a la base de datos, el router y el manejo de vistas.
- **Vistas:** contienen la interfaz HTML de la aplicación.
- **SQL:** contiene los scripts para crear y poblar la base de datos.

## Funcionalidades

### Autenticación

El sistema permite:

- Iniciar sesión con número de cuenta y contraseña.
- Validar las credenciales contra la base de datos.
- Proteger las páginas internas mediante sesión.
- Cerrar sesión.
- Regenerar el identificador de sesión después de iniciar sesión correctamente.
- Almacenar las contraseñas utilizando `password_hash()` y validarlas con `password_verify()`.

### Consulta de cuenta

Después de iniciar sesión, el usuario puede consultar:

- Número de cuenta.
- Nombre del cliente.
- Saldo actual.
- Acciones disponibles para retiros y transferencias.

### Retiros

El usuario puede:

- Registrar un retiro.
- Confirmar la operación mediante su contraseña.
- Validar que el valor sea numérico y mayor que cero.
- Validar que exista saldo suficiente.
- Consultar el historial de retiros.
- Consultar la cantidad total de retiros y el valor total retirado.

### Transferencias

El usuario puede:

- Indicar una cuenta destino.
- Especificar el valor a transferir.
- Confirmar la operación mediante su contraseña.
- Validar que la cuenta destino exista.
- Validar que el valor sea mayor que cero.
- Validar que exista saldo suficiente.
- Impedir transferencias hacia la misma cuenta.
- Actualizar el saldo de la cuenta origen y de la cuenta destino.
- Consultar el historial de transferencias enviadas.
- Consultar la cantidad y el valor total de las transferencias realizadas.

## Tecnologías utilizadas

- **PHP 8.1 o superior**
- **MySQL**
- **PDO** para la conexión y operaciones con la base de datos.
- **HTML5**
- **CSS3**
- **Composer** para el autoloading de clases.
- **Git** para el control de versiones.

## Requisitos

Antes de ejecutar el proyecto se necesita tener instalado:

1. PHP 8.1 o superior.
2. MySQL o MariaDB.
3. Composer.
4. Un navegador web.
5. Un servidor local compatible con PHP. También puede utilizarse el servidor integrado de PHP.

## Estructura del proyecto

```text
BancoEntregable/
│
├── config/
│   └── basedatos.php
│
├── public/
│   ├── index.php
│   └── css/
│       └── estilos.css
│
├── sql/
│   ├── 01_crear_bd.sql
│   ├── 02_siembra_db.sql
│   └── siembrausuario.php
│
├── src/
│   ├── Controladores/
│   │   ├── CuentaControlador.php
│   │   ├── LoginControlador.php
│   │   ├── RetiroControlador.php
│   │   └── TransferenciaControlador.php
│   │
│   ├── Modelos/
│   │   ├── Cliente.php
│   │   ├── Cuenta.php
│   │   ├── Retiro.php
│   │   ├── Transferencia.php
│   │   └── Usuario.php
│   │
│   ├── Nucleo/
│   │   ├── Conexion.php
│   │   ├── ControladorBase.php
│   │   ├── Router.php
│   │   └── Vista.php
│   │
│   ├── Repositorios/
│   │   ├── ClienteRepositorio.php
│   │   ├── CuentaRepositorio.php
│   │   ├── RetiroRepositorio.php
│   │   ├── TransferenciaRepositorio.php
│   │   └── UsuarioRepositorio.php
│   │
│   └── Servicios/
│       ├── ServicioLogin.php
│       ├── ServicioRetiro.php
│       └── ServicioTransferencia.php
│
├── vistas/
│   ├── cuenta/
│   │   └── panel.php
│   ├── login/
│   │   └── formulario.php
│   ├── retiros/
│   │   ├── formulario.php
│   │   └── historial.php
│   ├── transferencias/
│   │   ├── formulario.php
│   │   └── historial.php
│   └── layout.php
│
├── composer.json
└── README.md
```

## Arquitectura

El proyecto utiliza una estructura similar a MVC complementada con repositorios y servicios.

```text
Usuario
   │
   ▼
Vistas
   │
   ▼
Controladores
   │
   ▼
Servicios
   │
   ▼
Repositorios
   │
   ▼
PDO / MySQL
```

### Controladores

Los controladores reciben las solicitudes HTTP y determinan qué acción debe realizarse.

Ejemplos:

- `LoginControlador`: inicio y cierre de sesión.
- `CuentaControlador`: consulta de la información de la cuenta.
- `RetiroControlador`: creación y consulta de retiros.
- `TransferenciaControlador`: creación y consulta de transferencias.

### Servicios

Los servicios concentran las reglas de negocio.

`ServicioRetiro` valida:

- Contraseña.
- Valor del retiro.
- Saldo disponible.
- Actualización del saldo.
- Registro del retiro.

`ServicioTransferencia` valida:

- Contraseña.
- Existencia de la cuenta destino.
- Valor de la operación.
- Saldo disponible.
- Que la cuenta origen y destino sean diferentes.
- Actualización de ambas cuentas.
- Registro de la transferencia.

Las operaciones que modifican saldos utilizan transacciones de MySQL mediante PDO para intentar mantener la operación completa o revertirla si ocurre un error.

### Repositorios

Los repositorios encapsulan las consultas SQL relacionadas con cada entidad.

Por ejemplo:

- `CuentaRepositorio`
- `UsuarioRepositorio`
- `RetiroRepositorio`
- `TransferenciaRepositorio`
- `ClienteRepositorio`

Las consultas utilizan sentencias preparadas de PDO.

### Modelos

Los modelos representan los datos obtenidos desde la base de datos:

- `Cliente`
- `Cuenta`
- `Usuario`
- `Retiro`
- `Transferencia`

## Base de datos

La base de datos utilizada por el proyecto se llama:

```text
db_banco_adso
```

Las tablas principales son:

```text
clientes
cuentas
usuarios
retiros
transferencias
```

Relaciones principales:

```text
clientes
   │
   └── cuentas
          │
          ├── usuarios
          └── retiros

cuentas ───── transferencias ───── cuentas
```

Una cuenta pertenece a un cliente y tiene asociado un usuario para la autenticación. Los retiros pertenecen a una cuenta y las transferencias relacionan una cuenta de origen con una cuenta de destino.

## Configuración de la base de datos

La configuración se encuentra en:

```text
config/basedatos.php
```

El proyecto está configurado para una instalación local de MySQL con valores similares a:

```php
return [
    'host'      => '127.0.0.1',
    'puerto'    => '3306',
    'basedatos' => 'db_banco_adso',
    'usuario'   => 'root',
    'clave'     => 'TU_CONTRASEÑA',
    'charset'   => 'utf8mb4',
];
```

Se recomienda reemplazar la contraseña por la correspondiente a la instalación local de MySQL y no publicar credenciales reales en repositorios públicos.

## Instalación

### 1. Clonar o descargar el proyecto

Ubicar el proyecto en la carpeta donde se trabajará localmente.

### 2. Instalar dependencias

Desde la carpeta raíz del proyecto ejecutar:

```bash
composer install
```

El proyecto utiliza el autoload PSR-4 definido en `composer.json`:

```text
App\  →  src/
```

### 3. Crear la base de datos

Abrir MySQL, phpMyAdmin, MySQL Workbench o un cliente compatible y ejecutar:

```text
sql/01_crear_bd.sql
```

Este archivo:

- Crea `db_banco_adso`.
- Crea la tabla `clientes`.
- Crea la tabla `cuentas`.
- Crea la tabla `usuarios`.
- Crea la tabla `retiros`.
- Crea la tabla `transferencias`.
- Configura las relaciones mediante claves foráneas.

### 4. Cargar datos de prueba

Después de crear las tablas se puede ejecutar:

```text
sql/02_siembra_db.sql
```

Este script inserta clientes, cuentas, usuarios, retiros y transferencias de prueba.

### 5. Crear usuarios con contraseñas hasheadas

También existe:

```text
sql/siembrausuario.php
```

Este script utiliza `password_hash()` para generar las contraseñas y almacenarlas como hashes.

Para ejecutarlo desde la raíz del proyecto:

```bash
php sql/siembrausuario.php
```

Debe ejecutarse después de crear la base de datos y las cuentas correspondientes.

## Ejecutar el proyecto

La aplicación utiliza `public/index.php` como punto de entrada.

Una opción sencilla para desarrollo es utilizar el servidor integrado de PHP.

Desde la carpeta del proyecto:

```bash
php -S localhost:8000 -t public
```

Después abrir en el navegador:

```text
http://localhost:8000
```

Si se utiliza Apache/XAMPP, el servidor debe estar configurado para servir la carpeta:

```text
public/
```

## Rutas principales

| Método | Ruta | Función |
|---|---|---|
| GET | `/` | Mostrar formulario de inicio de sesión |
| POST | `/login` | Autenticar usuario |
| GET | `/logout` | Cerrar sesión |
| GET | `/cuenta` | Mostrar información de la cuenta |
| GET | `/retiro` | Mostrar formulario de retiro |
| POST | `/retiro` | Registrar retiro |
| GET | `/retiros` | Mostrar historial de retiros |
| GET | `/transferencia` | Mostrar formulario de transferencia |
| POST | `/transferencia` | Registrar transferencia |
| GET | `/transferencias` | Mostrar historial de transferencias |

El archivo `public/index.php` registra estas rutas mediante el router propio de la aplicación.

## Seguridad implementada

El proyecto incorpora varias medidas básicas de seguridad:

- Contraseñas almacenadas mediante `password_hash()`.
- Validación de contraseñas mediante `password_verify()`.
- Sentencias preparadas de PDO para reducir el riesgo de inyección SQL.
- Uso de sesiones para controlar el acceso.
- Regeneración del identificador de sesión después del inicio de sesión.
- Validación de sesión antes de acceder a las operaciones bancarias.
- Escapado de datos mostrados en HTML mediante `htmlspecialchars()`.
- Transacciones de base de datos para retiros y transferencias.
- Validación de saldo antes de modificar una cuenta.

## Flujo de un retiro

```text
Usuario inicia sesión
        │
        ▼
Accede a Retiro
        │
        ▼
Ingresa valor + contraseña
        │
        ▼
RetiroControlador
        │
        ▼
ServicioRetiro
        │
        ├── Verifica contraseña
        ├── Valida valor
        ├── Consulta saldo
        └── Verifica saldo suficiente
                │
                ▼
          Inicia transacción
                │
                ├── Descuenta saldo
                └── Registra retiro
                │
                ▼
              COMMIT
```

Si ocurre un error durante la operación, se realiza `ROLLBACK`.

## Flujo de una transferencia

```text
Usuario inicia sesión
        │
        ▼
Accede a Transferencia
        │
        ▼
Cuenta destino + valor + contraseña
        │
        ▼
TransferenciaControlador
        │
        ▼
ServicioTransferencia
        │
        ├── Verifica contraseña
        ├── Busca cuenta destino
        ├── Valida valor
        ├── Consulta saldo
        └── Evita transferencia a la misma cuenta
                │
                ▼
          Inicia transacción
                │
                ├── Descuenta saldo origen
                ├── Aumenta saldo destino
                └── Registra transferencia
                │
                ▼
              COMMIT
```

## Ejemplo de usuarios de prueba

El archivo `sql/siembrausuario.php` contiene usuarios de prueba asociados a las cuentas:

| Número de cuenta | Contraseña de prueba |
|---|---|
| `100001` | `123` |
| `100002` | `1234` |
| `100003` | `12345` |
| `100004` | `123456` |
| `100005` | `1234567` |

Estas credenciales son únicamente para pruebas locales. En un entorno real deben reemplazarse por credenciales seguras.

## Archivos principales

### `public/index.php`

Es el punto de entrada de la aplicación. Inicia la sesión, crea los controladores, registra las rutas y ejecuta la acción correspondiente según el método HTTP y la URL.

### `src/Nucleo/Conexion.php`

Implementa una conexión reutilizable a MySQL mediante PDO.

### `src/Nucleo/Router.php`

Administra las rutas `GET` y `POST` de la aplicación.

### `src/Nucleo/ControladorBase.php`

Proporciona funciones comunes a los controladores, como renderizar vistas, redireccionar y verificar la sesión.

### `src/Nucleo/Vista.php`

Se encarga de cargar las vistas dentro del layout general.

### `src/Servicios/ServicioLogin.php`

Realiza la autenticación del usuario y verifica la contraseña.

### `src/Servicios/ServicioRetiro.php`

Contiene la lógica de negocio necesaria para realizar retiros.

### `src/Servicios/ServicioTransferencia.php`

Contiene la lógica de negocio necesaria para realizar transferencias entre cuentas.

## Objetivo académico

El proyecto permite aplicar conceptos de desarrollo web y programación orientada a objetos, incluyendo:

- PHP.
- Programación orientada a objetos.
- Arquitectura por capas.
- Patrón MVC.
- Repositorios.
- Servicios.
- PDO.
- MySQL.
- Relaciones entre tablas.
- Sentencias preparadas.
- Sesiones.
- Hash de contraseñas.
- Transacciones.
- Validación de datos.
- Manejo de excepciones.
- Composer y autoload PSR-4.
- Control de versiones con Git.

## Autor

Proyecto desarrollado como parte de la formación **ADSO (Análisis y Desarrollo de Software)**.

**Proyecto:** Banco ADSO  
**Tecnología principal:** PHP + MySQL
