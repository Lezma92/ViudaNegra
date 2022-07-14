create database viuda_negra;

update mesas set estado = 'vacia' where idmesas > 0;
truncate clientes;

use viuda_negra;

CREATE TABLE usuarios (
    id INT(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'llave primaria de la tabla, registro de control',
    id_datos_usuario INT(11) NOT NULL COMMENT 'llave secundaria, nos sirve para conocer los datos personales de cada usuario',
    usuario VARCHAR(50) NOT NULL COMMENT 'aqui se guardará el nombre del usuario con el que se dará acceso al sistema',
    passw VARCHAR(50) NOT NULL COMMENT 'Campo para guardar la contraseña del usuario',
    tipo_usu ENUM('ADMIN', 'MESERO', 'COCINERO', 'SuPPort') COMMENT 'Identificador de nivel de privilegios que se le otorgan a cada usuario',
    ult_fecha_conexion DATETIME NOT NULL COMMENT 'Se guardará la ultima conexion de cada usuarios, cada vez que le usuario ingrese al sistema se actualizará'
)  ENGINE=INNODB;

CREATE TABLE usuarios_datos (
    id INT(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'llave unica de registro',
    nombre VARCHAR(50) NOT NULL COMMENT 'Sirve para almacenar el nombre del usuario',
    apellidos VARCHAR(150) NOT NULL COMMENT 'Sirve para almacenar los apellidos del usuario',
    num_tel VARCHAR(20) NOT NULL COMMENT 'Se almacena el numero de telefono',
    correo VARCHAR(250) NOT NULL COMMENT 'Se almacena el correo electronico del usuario'
)  ENGINE=INNODB;

CREATE TABLE terrazas (
    idterrazas INT(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'identificador unico de control de la tabla',
    nombreterraza VARCHAR(50) NOT NULL COMMENT 'Se almacena el nombre con el cual se identifica cada terraza'
)  ENGINE=INNODB;

CREATE TABLE mesas (
    idmesas INT(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'identificador unico',
    id_terrazas INT(11) NOT NULL COMMENT 'se almacena el identificar de las terrrazas para conocer a la que pertence cada mesa',
    nummesa VARCHAR(70) NOT NULL COMMENT 'se almacena el nombre de la mesa con el cual se identifica',
    estado ENUM('ocupada', 'vacia', 'mantenimiento') COMMENT 'Se almacena el estado de las mesas, para saber si estan en servicio o no'
)  ENGINE=INNODB;



CREATE TABLE categoriademenu (
    id INT(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Llave primaria de la tabla, se encarga de llevar un registro unico',
    nombremenu VARCHAR(80) NOT NULL COMMENT 'Se registra el nombre de la categoria que se maneja dentro del bar, ej. cocteles, bebidas, botanas,. etc..',
    url_imagen VARCHAR(250) COMMENT 'Aqui se guardara la dirección de una imagen que representará la categoria de la que se habla'
)  ENGINE=INNODB;

CREATE TABLE botellasycocteles (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_categoriademenu INT(11) NOT NULL COMMENT 'llave foranea, sirve para saber a que categoria perteneces una bebida',
    nombre VARCHAR(200) NOT NULL COMMENT 'Se guardará el nombre de la bebida',
    estadocontrol ENUM('vigente', 'agotado', 'debaja') COMMENT 'Este campo servira para saber si la bebida sigue vigente, si se encuentra dentro del stock',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Se guardara la fecha de cuando fue registrada cada bebida'
)  ENGINE=INNODB;

CREATE TABLE tiposcoctelesytragos (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_botellasycocteles INT(11),
    nombrecob VARCHAR(250) COMMENT 'Se guarda el nombre del coctel o de la bebida',
    ingredientes TEXT NOT NULL,
    precio VARCHAR(40) NOT NULL,
    descripcion TEXT NULL
)  ENGINE=INNODB;

CREATE TABLE pedidos (
    idpedididos INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_clientes INT(11) NOT NULL,
    id_tiposcoctelesytragos INT(11) NOT NULL,
    cantidad INT(11) NOT NULL,
    ingredientes text default("c/todo"),
    fechayhora datetime,
    status_orden enum('ordenado','preparacion','servido','cancelado','finalizado')
)  ENGINE=INNODB;


CREATE TABLE clientes (
    idcliente INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT(11) NOT NULL,
    id_mesa INT(11) NOT NULL,
    nombre VARCHAR(80) NOT NULL,
    estado ENUM('Abierto', 'Finalizado'),
    fecha_hora_registro DATETIME
)  ENGINE=INNODB;



