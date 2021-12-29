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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO cliente VALUES("1","&","&","&","&","","&","0000-00-00 00:00:00");
INSERT INTO cliente VALUES("2","darwin","flores","2563-9852","dfgdfgdfgdf","","2022-1211","2016-11-15 00:00:00");
INSERT INTO cliente VALUES("3","Josselin","ramos","","\n","","","2016-11-15 15:28:52");
INSERT INTO cliente VALUES("4","Marcos","hernandez","","","","","2016-11-18 06:07:35");
INSERT INTO cliente VALUES("5","Maria de los angeles ","lovato hernadez","2021-2121","hhg gh bvbvb v bv bvbv r fffffff f f f f ht h h gggf gfgfg fgft  tuu ugh  dddd eesesesethgfdr  r r r rr gggggggggggggggggggg f f ddcchjjjjjjjjjjhgtt t t t t dddd ","marfgfdgfdjgfgefdgfhdgogfhogfria@gmail.com","2012-1212","2016-11-20 15:20:32");
INSERT INTO cliente VALUES("6","Marcos"," df dgd","","","","","2016-11-20 21:32:18");
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

INSERT INTO detalleorden VALUES("1","0.50","1","","0.50","1","2");
INSERT INTO detalleorden VALUES("2","6.00","1","","6.00","1","1");
INSERT INTO detalleorden VALUES("3","0.50","5","","2.50","2","2");
INSERT INTO detalleorden VALUES("4","6.00","2","","12.00","2","1");
INSERT INTO detalleorden VALUES("5","0.50","2","","1.00","3","2");
INSERT INTO detalleorden VALUES("6","6.00","2","","12.00","3","1");
INSERT INTO detalleorden VALUES("7","0.50","3","","1.50","4","2");
INSERT INTO detalleorden VALUES("8","0.50","3","","1.50","5","2");
INSERT INTO detalleorden VALUES("9","6.00","2","","12.00","5","1");
INSERT INTO detalleorden VALUES("10","5.00","1","","5.00","6","3");
INSERT INTO detalleorden VALUES("11","0.50","1","","0.50","6","2");
INSERT INTO detalleorden VALUES("12","6.00","1","","6.00","6","1");
INSERT INTO detalleorden VALUES("13","6.00","2","","12.00","7","11");
INSERT INTO detalleorden VALUES("14","4.00","1","","4.00","7","10");
INSERT INTO detalleorden VALUES("15","30.00","1","","30.00","7","9");
INSERT INTO detalleorden VALUES("16","20.00","1","","20.00","7","8");
INSERT INTO detalleorden VALUES("17","5.00","1","","5.00","7","7");
INSERT INTO detalleorden VALUES("18","2.00","1","","2.00","7","6");
INSERT INTO detalleorden VALUES("19","4.00","1","","4.00","7","5");
INSERT INTO detalleorden VALUES("20","6.00","1","","6.00","7","4");
INSERT INTO detalleorden VALUES("21","3.00","1","","3.00","7","3");
INSERT INTO detalleorden VALUES("22","1.20","1","","1.20","7","2");
INSERT INTO detalleorden VALUES("23","3.00","1","","3.00","7","1");
INSERT INTO detalleorden VALUES("24","30.00","1","","30.00","8","9");
INSERT INTO detalleorden VALUES("25","2.00","1","","2.00","8","6");
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO mesa VALUES("1","No Mesa","ndandads","ddfdfdfd","0000-00-00 00:00:00","Disponible");
INSERT INTO mesa VALUES("3","1","./mesas/3.jpg","dffgf","2016-11-16 22:57:44","Disponible");
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO mesero VALUES("1","mesad2","Jrge","Martinez","2020-0505","Dereicece","0000-00-00 00:00:00","Disponible","0");
INSERT INTO mesero VALUES("2","Mes1","marvin de jesus ","ramirezdf ","2021-2121","san se","2016-11-16 22:10:12","Disponible","-1");
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO orden VALUES("1","2016-11-16","1","2","1","2","Pagada");
INSERT INTO orden VALUES("2","2016-11-17","1","3","3","2","Pagada");
INSERT INTO orden VALUES("3","2016-11-18","1","4","3","1","Pendiente");
INSERT INTO orden VALUES("4","2016-11-18","1","4","1","1","Pagada");
INSERT INTO orden VALUES("5","2016-11-18","1","3","3","1","Pagada");
INSERT INTO orden VALUES("6","2016-11-18","1","4","3","2","Pagada");
INSERT INTO orden VALUES("7","2016-11-20","1","5","3","2","Pagada");
INSERT INTO orden VALUES("8","2016-11-20","1","4","3","2","Pagada");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS pago; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pagocliente` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cambio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idorden` int(11) NOT NULL,
  PRIMARY KEY (`idpago`),
  KEY `fk_idord` (`idorden`),
  CONSTRAINT `fk_idord` FOREIGN KEY (`idorden`) REFERENCES `orden` (`idorden`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO pago VALUES("1","1.50","5.00","3.50","4");
INSERT INTO pago VALUES("2","13.00","20.00","7.00","3");
INSERT INTO pago VALUES("4","6.50","10.00","3.50","1");
INSERT INTO pago VALUES("5","13.50","40.00","26.50","5");
INSERT INTO pago VALUES("6","11.50","15.00","3.50","6");
INSERT INTO pago VALUES("7","90.20","95.00","4.80","7");
INSERT INTO pago VALUES("8","14.50","30.00","15.50","2");
INSERT INTO pago VALUES("9","32.00","40.00","8.00","8");
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO produccion VALUES("1","2016-11-16","2016-11-16","16","6.00","96.00","1");
INSERT INTO produccion VALUES("2","2016-11-16","2016-11-16","30","0.50","15.00","2");
INSERT INTO produccion VALUES("3","2016-11-18","2016-11-18","30","5.00","150.00","3");
INSERT INTO produccion VALUES("4","2016-11-20","2016-11-20","20","6.00","120.00","11");
INSERT INTO produccion VALUES("5","2016-11-20","2016-11-20","20","4.00","80.00","10");
INSERT INTO produccion VALUES("6","2016-11-20","2016-11-20","20","30.00","600.00","9");
INSERT INTO produccion VALUES("7","2016-11-20","2016-11-20","30","20.00","600.00","8");
INSERT INTO produccion VALUES("8","2016-11-20","2016-11-20","30","5.00","150.00","7");
INSERT INTO produccion VALUES("9","2016-11-20","2016-11-20","50","2.00","100.00","6");
INSERT INTO produccion VALUES("10","2016-11-20","2016-11-20","300","4.00","1200.00","5");
INSERT INTO produccion VALUES("11","2016-11-20","2016-11-20","300","6.00","1800.00","4");
INSERT INTO produccion VALUES("12","2016-11-20","2016-11-20","20","3.00","60.00","3");
INSERT INTO produccion VALUES("13","2016-11-20","2016-11-20","100","1.20","120.00","2");
INSERT INTO produccion VALUES("14","2016-11-20","2016-11-20","50","3.00","150.00","1");
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO producto VALUES("1","carne","Menu a la carta","66","57","0","es de carne","3.00","171.00","Activo","2016-11-20","Activado Correctamente","2016-11-16","1");
INSERT INTO producto VALUES("2","gaseosa","Menu a la carta","130","114","0","cocacola","1.20","136.80","Activo","2016-11-20","Activado Correctamente","2016-11-16","2");
INSERT INTO producto VALUES("3","pollo frito","Menu a la carta","50","48","0","Es india","3.00","144.00","Activo","2016-11-20","Activado Correctamente","2016-11-18","1");
INSERT INTO producto VALUES("4","res","Menu a la carta","300","299","0","dsdsd sd sd s","6.00","1794.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
INSERT INTO producto VALUES("5","cerveza","Menu a la carta","300","299","0","dsd sfs","4.00","1196.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","2");
INSERT INTO producto VALUES("6","fresfo","Menu a la carta","50","48","0","de zanahoria","2.00","96.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","2");
INSERT INTO producto VALUES("7","conejo","Menu a la carta","30","29","0","es","5.00","145.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
INSERT INTO producto VALUES("8","cngrejo","Menu a la carta","30","29","0","da dvd c  f f","20.00","580.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
INSERT INTO producto VALUES("9","cafe","Menu a la carta","20","18","0","de ","30.00","540.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
INSERT INTO producto VALUES("10","chocolate","Menu a la carta","20","19","0","de ca","4.00","76.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","2");
INSERT INTO producto VALUES("11","pollo al a majar","Menu a la carta","20","18","0","td fg fdg dg d g dgdfg fg fdg fh fgh fghfg fgh fhf hfdff fh fhf fh gfhgh gh ghg g hgh ghg gh gh gh ghg hgh gh ,hg ,h ,g hg,hg,h ,gh,gh ,ghg","6.00","108.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO tipoproducto VALUES("1","comida","2016-11-16 21:17:44");
INSERT INTO tipoproducto VALUES("2","bebidas","2016-11-16 23:08:19");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS tipousuario; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `agregado` datetime NOT NULL,
  PRIMARY KEY (`idtipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO tipousuario VALUES("1","administrador","2016-11-15 00:00:00");
INSERT INTO tipousuario VALUES("3","ingerdfd","2016-11-15 20:16:53");
INSERT INTO tipousuario VALUES("4","user","2016-11-15 20:17:00");
INSERT INTO tipousuario VALUES("5","xxvcvc c","2016-11-17 17:16:47");
INSERT INTO tipousuario VALUES("6","dff sf sdf sf sdf sdfs","2016-11-17 17:16:52");
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

INSERT INTO usuario VALUES("1","jose","Cortez lovato","jose@gmail.com","jose","827ccb0eea8a706c4c34a16891f84e7b","0","0","hola","hola","Activo","2016-11-15 15:00:00","1","2016-11-21 13:42:24","activo","1");
SET FOREIGN_KEY_CHECKS=1;

