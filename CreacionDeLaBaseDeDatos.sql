CREATE DATABASE SDGDT
    CHARACTER SET utf8
    COLLATE utf8_general_ci;


CREATE TABLE `usuarios` (
   `usuario` varchar(50) NOT NULL,
   `contrasenia` varchar(50) NOT NULL,
   `name` varchar(50) DEFAULT NULL,
   `email` varchar(50) DEFAULT NULL,
   PRIMARY KEY (`usuario`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tareas` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `usuario_id` varchar(50) DEFAULT NULL,
   `titulo` varchar(100) DEFAULT NULL,
   `descripcion` text DEFAULT NULL,
   `prioridad` enum('alta','media','baja') DEFAULT NULL,
   `estado` enum('pendiente','completada') DEFAULT 'pendiente',
   PRIMARY KEY (`id`),
   KEY `usuario_id` (`usuario_id`),
   CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario`)
 ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



/*tabla usuarios*/
INSERT INTO `usuarios` (`usuario`,`contrasenia`,`name`,`email`) VALUES ('samx.task','123','samuel martinez','samueldavidmartinez0@gmail.com');

/*tabla tareas*/
INSERT INTO `tareas` (`id`,`usuario_id`,`titulo`,`descripcion`,`prioridad`,`estado`) VALUES (2,'samx.task','Este titulo es una prueba','esta es la descripcion real','alta','completada');
INSERT INTO `tareas` (`id`,`usuario_id`,`titulo`,`descripcion`,`prioridad`,`estado`) VALUES (3,'samx.task','Este titulo es una prueba2024','esta es la descripcion real','alta','pendiente');
INSERT INTO `tareas` (`id`,`usuario_id`,`titulo`,`descripcion`,`prioridad`,`estado`) VALUES (4,'samx.task','Tarea 3','tarea 3','alta','pendiente');
INSERT INTO `tareas` (`id`,`usuario_id`,`titulo`,`descripcion`,`prioridad`,`estado`) VALUES (5,'samx.task','Tarea4','tarea4','alta','pendiente');
INSERT INTO `tareas` (`id`,`usuario_id`,`titulo`,`descripcion`,`prioridad`,`estado`) VALUES (6,'samx.task','Tarea6','tarea6','media','pendiente');

