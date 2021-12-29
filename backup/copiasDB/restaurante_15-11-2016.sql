DROP TABLE IF EXISTS cliente; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO cliente VALUES("1","fercito","ramos","2020-0808","zacatecoluca","","2020-0808","2016-11-15 00:00:00");
INSERT INTO cliente VALUES("2","darwin","flores","2563-9852","dfgdfgdfgdf","","2022-1211","2016-11-15 00:00:00");
INSERT INTO cliente VALUES("3","Josselin","ramos","","\n","","","2016-11-15 15:28:52");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS clienteconfirmaevento; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `clienteconfirmaevento` (
  `idclienteconfirmaevento` int(11) NOT NULL AUTO_INCREMENT,
  `precioporpersona` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cantidadpersona` int(11) NOT NULL DEFAULT '0',
  `preciototal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fecha` date NOT NULL,
  `horainicio` varchar(45) NOT NULL,
  `horafin` varchar(45) NOT NULL,
  `adelanto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pendiente` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fecharegistro` date NOT NULL,
  `idcliente` int(11) NOT NULL,
  `ideventosespeciales` int(11) NOT NULL,
  PRIMARY KEY (`idclienteconfirmaevento`,`idcliente`,`ideventosespeciales`),
  KEY `fk_clienteconfirmaevento_cliente1_idx` (`idcliente`),
  KEY `fk_clienteconfirmaevento_eventosespeciales1_idx` (`ideventosespeciales`),
  CONSTRAINT `fk_clienteconfirmaevento_cliente1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_clienteconfirmaevento_eventosespeciales1` FOREIGN KEY (`ideventosespeciales`) REFERENCES `eventosespeciales` (`ideventosespeciales`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS compra; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `fechacompra` datetime NOT NULL,
  `estado` varchar(45) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcompra`,`idproveedor`,`usuario_idusuario`),
  KEY `fk_compra_proveedor1_idx` (`idproveedor`),
  KEY `fk_compra_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_compra_proveedor1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_compra_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS condiciones; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `condiciones` (
  `idcondiciones` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` longtext NOT NULL,
  `ideventosespeciales` int(11) NOT NULL,
  PRIMARY KEY (`idcondiciones`,`ideventosespeciales`),
  KEY `fk_condiciones_eventosespeciales1_idx` (`ideventosespeciales`),
  CONSTRAINT `fk_condiciones_eventosespeciales1` FOREIGN KEY (`ideventosespeciales`) REFERENCES `eventosespeciales` (`ideventosespeciales`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS detallecompra; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `detallecompra` (
  `iddetallecompra` int(11) NOT NULL AUTO_INCREMENT,
  `fechav` date DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idcompra` int(11) NOT NULL,
  `idproductocompra` int(11) NOT NULL,
  PRIMARY KEY (`iddetallecompra`,`idcompra`,`idproductocompra`),
  KEY `fk_detallecompra_compra1_idx` (`idcompra`),
  KEY `fk_detallecompra_productocompra1_idx` (`idproductocompra`),
  CONSTRAINT `fk_detallecompra_compra1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detallecompra_productocompra1` FOREIGN KEY (`idproductocompra`) REFERENCES `productocompra` (`idproductocompra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS detalleorden; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `detalleorden` (
  `iddetalleorden` int(11) NOT NULL AUTO_INCREMENT,
  `precioactual` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `cortesia` varchar(45) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idorden` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`iddetalleorden`,`idorden`,`idproducto`),
  KEY `fk_detalleorden_orden1_idx` (`idorden`),
  KEY `fk_detalleorden_producto1_idx` (`idproducto`),
  CONSTRAINT `fk_detalleorden_orden1` FOREIGN KEY (`idorden`) REFERENCES `orden` (`idorden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleorden_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS detallevento; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `detallevento` (
  `iddetallevento` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idproducto` int(11) NOT NULL,
  `idclienteconfirmaevento` int(11) NOT NULL,
  PRIMARY KEY (`iddetallevento`,`idproducto`,`idclienteconfirmaevento`),
  KEY `fk_detallevento_producto1_idx` (`idproducto`),
  KEY `fk_detallevento_clienteconfirmaevento1_idx` (`idclienteconfirmaevento`),
  CONSTRAINT `fk_detallevento_clienteconfirmaevento1` FOREIGN KEY (`idclienteconfirmaevento`) REFERENCES `clienteconfirmaevento` (`idclienteconfirmaevento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detallevento_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS entradas; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `entradas` (
  `identradas` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` longtext NOT NULL,
  `ideventosespeciales` int(11) NOT NULL,
  PRIMARY KEY (`identradas`,`ideventosespeciales`),
  KEY `fk_entradas_eventosespeciales1_idx` (`ideventosespeciales`),
  CONSTRAINT `fk_entradas_eventosespeciales1` FOREIGN KEY (`ideventosespeciales`) REFERENCES `eventosespeciales` (`ideventosespeciales`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS eventosespeciales; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `eventosespeciales` (
  `ideventosespeciales` int(11) NOT NULL AUTO_INCREMENT,
  `opcion` varchar(75) NOT NULL,
  `pastel` varchar(100) DEFAULT NULL,
  `postre` varchar(100) DEFAULT NULL,
  `preciopersona` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ideventosespeciales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS mesa; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `mesa` (
  `idmesa` int(11) NOT NULL AUTO_INCREMENT,
  `numeromesa` varchar(45) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idmesa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS mesero; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `mesero` (
  `idmesero` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(45) NOT NULL,
  `contadormesa` int(11) NOT NULL,
  PRIMARY KEY (`idmesero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS orden; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `orden` (
  `idorden` int(11) NOT NULL AUTO_INCREMENT,
  `fechaorden` date NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `idmesero` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idorden`,`idusuario`,`idcliente`,`idmesa`,`idmesero`),
  KEY `fk_orden_mesa1_idx` (`idmesa`),
  KEY `fk_orden_mesero1_idx` (`idmesero`),
  KEY `fk_orden_cliente1_idx` (`idcliente`),
  KEY `fk_orden_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_orden_cliente1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orden_mesa1` FOREIGN KEY (`idmesa`) REFERENCES `mesa` (`idmesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orden_mesero1` FOREIGN KEY (`idmesero`) REFERENCES `mesero` (`idmesero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orden_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS produccion; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `produccion` (
  `idproduccion` int(11) NOT NULL AUTO_INCREMENT,
  `fechaproduccion` date NOT NULL,
  `fechavencimiento` date NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `preciounitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`idproduccion`,`idproducto`),
  KEY `fk_produccion_producto1_idx` (`idproducto`),
  CONSTRAINT `fk_produccion_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS producto; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `tipomenu` varchar(45) NOT NULL,
  `entrada` int(11) NOT NULL DEFAULT '0',
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `salida` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(350) NOT NULL,
  `preciounitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estado` varchar(45) NOT NULL,
  `fechav` date NOT NULL,
  `razon` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `idtipoproducto` int(11) NOT NULL,
  PRIMARY KEY (`idproducto`,`idtipoproducto`),
  KEY `fk_producto_tipoproducto_idx` (`idtipoproducto`),
  CONSTRAINT `fk_producto_tipoproducto` FOREIGN KEY (`idtipoproducto`) REFERENCES `tipoproducto` (`idtipoproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS productocompra; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `productocompra` (
  `idproductocompra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(200) NOT NULL,
  `preciounitario` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `razon` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idproductocompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS proveedor; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `nombrecontacto` varchar(45) NOT NULL,
  `telefonocontacto` varchar(15) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `razon` varchar(300) NOT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS tipoadicional; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `tipoadicional` (
  `idtipoadicional` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` longtext NOT NULL,
  `ideventosespeciales` int(11) NOT NULL,
  PRIMARY KEY (`idtipoadicional`,`ideventosespeciales`),
  KEY `fk_tipoadicional_eventosespeciales1_idx` (`ideventosespeciales`),
  CONSTRAINT `fk_tipoadicional_eventosespeciales1` FOREIGN KEY (`ideventosespeciales`) REFERENCES `eventosespeciales` (`ideventosespeciales`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS tipoplatillofuerte; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `tipoplatillofuerte` (
  `idtipoplatillofuerte` int(11) NOT NULL AUTO_INCREMENT,
  `nombreplatillo` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `ideventosespeciales` int(11) NOT NULL,
  PRIMARY KEY (`idtipoplatillofuerte`,`ideventosespeciales`),
  KEY `fk_tipoplatillofuerte_eventosespeciales1_idx` (`ideventosespeciales`),
  CONSTRAINT `fk_tipoplatillofuerte_eventosespeciales1` FOREIGN KEY (`ideventosespeciales`) REFERENCES `eventosespeciales` (`ideventosespeciales`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS tipoproducto; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `tipoproducto` (
  `idtipoproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idtipoproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS tipousuario; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `agregado` datetime NOT NULL,
  PRIMARY KEY (`idtipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO tipousuario VALUES("1","administrador","2016-11-15 00:00:00");
INSERT INTO tipousuario VALUES("3","ingerdfd","2016-11-15 20:16:53");
INSERT INTO tipousuario VALUES("4","user","2016-11-15 20:17:00");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS usuario; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `intentos` int(11) NOT NULL,
  `bloqueado` int(11) NOT NULL,
  `pregunta` varchar(75) NOT NULL,
  `respuesta` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `isadmin` varchar(45) NOT NULL,
  `ultimoingreso` datetime NOT NULL,
  `razon` varchar(200) NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`,`idtipousuario`),
  KEY `fk_usuario_tipousuario1_idx` (`idtipousuario`),
  CONSTRAINT `fk_usuario_tipousuario1` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuario` (`idtipousuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO usuario VALUES("1","jose","Cortez lovato","jose@gmail.com","jose","827ccb0eea8a706c4c34a16891f84e7b","0","0","hola","hola","Activo","2016-11-15 15:00:00","1","2016-11-15 18:51:33","activo","1");
SET FOREIGN_KEY_CHECKS=1;

