DROP TABLE IF EXISTS cliente; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `dui` varchar(15) DEFAULT NULL,
  `direccion` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO cliente VALUES("1","Jose","martinez","2020-1210","20212121-0","dadffgf fd fg d","2016-10-18");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS compra; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `fechacompra` datetime NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `estado` varchar(25) NOT NULL,
  PRIMARY KEY (`idcompra`,`idusuario`,`idproveedor`),
  KEY `fk_compra_usuario2_idx` (`idusuario`),
  KEY `fk_compra_proveedor2_idx` (`idproveedor`),
  CONSTRAINT `fk_compra_proveedor2` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_compra_usuario2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS compramateria; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `compramateria` (
  `idcompramateria` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `estado` varchar(45) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcompramateria`,`idproveedor`,`idusuario`),
  KEY `fk_compramateria_proveedor1_idx` (`idproveedor`),
  KEY `fk_compramateria_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_compramateria_proveedor1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_compramateria_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS detallecompra; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `detallecompra` (
  `iddetallecompra` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idcompra` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`iddetallecompra`,`idcompra`,`idproducto`),
  KEY `fk_detallecompra_compra2_idx` (`idcompra`),
  KEY `fk_detallecompra_producto2_idx` (`idproducto`),
  CONSTRAINT `fk_detallecompra_compra2` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detallecompra_producto2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS detallemateriaprima; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `detallemateriaprima` (
  `iddetallemateriaprima` int(11) NOT NULL AUTO_INCREMENT,
  `fechav` date NOT NULL,
  `idmateriaprima` int(11) NOT NULL,
  `idcompramateria` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `unidad` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`iddetallemateriaprima`,`idmateriaprima`,`idcompramateria`),
  KEY `fk_detallemateriaprima_materiaprima1_idx` (`idmateriaprima`),
  KEY `fk_detallemateriaprima_compramateria1_idx` (`idcompramateria`),
  CONSTRAINT `fk_detallemateriaprima_compramateria1` FOREIGN KEY (`idcompramateria`) REFERENCES `compramateria` (`idcompramateria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detallemateriaprima_materiaprima1` FOREIGN KEY (`idmateriaprima`) REFERENCES `materiaprima` (`idmateriaprima`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS detalleorden; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `detalleorden` (
  `iddetalleorden` int(11) NOT NULL AUTO_INCREMENT,
  `precioactual` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idorden` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`iddetalleorden`,`idorden`,`idproducto`),
  KEY `fk_detalleorden_orden1_idx` (`idorden`),
  KEY `fk_detalleorden_producto1_idx` (`idproducto`),
  CONSTRAINT `fk_detalleorden_orden1` FOREIGN KEY (`idorden`) REFERENCES `orden` (`idorden`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detalleorden_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO detalleorden VALUES("1","2.00","10","20.00","1","1");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS materiaprima; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `materiaprima` (
  `idmateriaprima` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `unidad` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `descripcion` varchar(500) NOT NULL,
  `fechavencimiento` date NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idmateriaprima`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO mesa VALUES("1","1","./mesas/1.jpg","es para dos personas","2016-10-18 16:03:32","Disponible");
INSERT INTO mesa VALUES("2","2","./mesas/2.jpg","admin","2016-10-18 16:03:49","Ocupada");
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
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`idmesero`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO mesero VALUES("1","1","maria","ramirez","2021-2120","dfsd","2016-10-18 16:04:26","Fuera de orden");
INSERT INTO mesero VALUES("2","ddad","dzdz","dz","7012-1121","fgdfg","2016-10-18 16:05:15","Fuera de orden");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS orden; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `orden` (
  `idorden` int(11) NOT NULL AUTO_INCREMENT,
  `fechaorden` datetime NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `idmesero` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'Pendiente',
  PRIMARY KEY (`idorden`,`idusuario`,`idcliente`,`idmesa`,`idmesero`),
  KEY `fk_orden_usuario2_idx` (`idusuario`),
  KEY `fk_orden_cliente1_idx` (`idcliente`),
  KEY `fk_orden_mesa1_idx` (`idmesa`),
  KEY `fk_orden_mesero1_idx` (`idmesero`),
  CONSTRAINT `fk_orden_cliente1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orden_mesa1` FOREIGN KEY (`idmesa`) REFERENCES `mesa` (`idmesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orden_mesero1` FOREIGN KEY (`idmesero`) REFERENCES `mesero` (`idmesero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orden_usuario2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO orden VALUES("1","2016-10-18 16:05:44","1","1","2","1","Pendiente");
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO produccion VALUES("1","2016-10-18","2016-10-19","20","2.00","40.00","1");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS producto; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipomenu` varchar(45) NOT NULL,
  `entrada` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `salida` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `preciounitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estado` varchar(45) NOT NULL,
  `fechav` date NOT NULL,
  `razon` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  `idtipoproducto` int(11) NOT NULL,
  PRIMARY KEY (`idproducto`,`idtipoproducto`),
  KEY `fk_producto_tipoproducto1_idx` (`idtipoproducto`),
  CONSTRAINT `fk_producto_tipoproducto1` FOREIGN KEY (`idtipoproducto`) REFERENCES `tipoproducto` (`idtipoproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO producto VALUES("1","carne de cerdo","Menu a la carta","20","10","0","Esbuena para la salud","2.00","20.00","Activo","2016-10-19","Activado Correctamente","2016-10-18 16:01:33","1");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS productovencido; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `productovencido` (
  `idproductovencido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `precio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`idproductovencido`,`idproducto`),
  KEY `fk_productovencido_producto1_idx` (`idproducto`),
  CONSTRAINT `fk_productovencido_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO proveedor VALUES("1","Vendedor","1212","","","","josefa","2021-2012","Activo","2016-10-18","Activo Correctamente");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS tipoproducto; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `tipoproducto` (
  `idtipoproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idtipoproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO tipoproducto VALUES("1","comida rapida","2016-10-17 17:28:44");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS tipousuario; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `agregado` datetime NOT NULL,
  PRIMARY KEY (`idtipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO tipousuario VALUES("1","administrador","2016-10-17 15:00:00");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS usuario; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `intentos` int(11) NOT NULL DEFAULT '0',
  `bloqueado` int(11) NOT NULL DEFAULT '0',
  `pregunta` varchar(75) NOT NULL,
  `respuesta` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `isadmin` varchar(45) NOT NULL,
  `ultimoingreso` datetime NOT NULL,
  `razon` text NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`,`idtipousuario`),
  KEY `fk_usuario_tipousuario1_idx` (`idtipousuario`),
  CONSTRAINT `fk_usuario_tipousuario1` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuario` (`idtipousuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO usuario VALUES("1","Franciso","viscarra","francisco@gmail.com","admin","21232f297a57a5a743894a0e4a801fc3","0","0","admin","admin","Activo","2016-10-17 17:00:00","1","2016-10-18 18:33:28","Activado correctamente","1");
SET FOREIGN_KEY_CHECKS=1;

