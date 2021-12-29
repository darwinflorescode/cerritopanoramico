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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO cliente VALUES("1","&","&","&","&","","&","0000-00-00 00:00:00");
INSERT INTO cliente VALUES("2","darwin","flores","2563-9852","dfgdfgdfgdf","","2022-1211","2016-11-15 00:00:00");
INSERT INTO cliente VALUES("3","Josselin","ramos","","\n","","","2016-11-15 15:28:52");
INSERT INTO cliente VALUES("4","Marcos","hernandez","","","","","2016-11-18 06:07:35");
INSERT INTO cliente VALUES("5","Maria de los angeles ","lovato hernadez","2021-2121"," f f ddcchjjjjjjjjjjhgtt t t t t dddd ","marfgfdgfdjgfgefdgfhdgogfhogfria@gmail.com","2012-1212","2016-11-20 15:20:32");
INSERT INTO cliente VALUES("6","Marcos"," df dgd","","","","","2016-11-20 21:32:18");
INSERT INTO cliente VALUES("7","Fernando","ramirez","","","","","2016-11-21 16:25:26");
INSERT INTO cliente VALUES("8","Blanca","juarez","","","","","2016-11-22 14:32:23");
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

DROP TABLE IF EXISTS cortesia; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `cortesia` (
  `idcortesia` int(11) NOT NULL AUTO_INCREMENT,
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idorden` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`idcortesia`,`idorden`,`idproducto`),
  KEY `fk_idcorte` (`idorden`),
  KEY `idcort` (`idproducto`),
  CONSTRAINT `fk_idcorte` FOREIGN KEY (`idorden`) REFERENCES `orden` (`idorden`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idcort` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO cortesia VALUES("1","6.00","3","18.00","13","11");
INSERT INTO cortesia VALUES("2","30.00","1","30.00","13","9");
INSERT INTO cortesia VALUES("3","4.00","1","4.00","13","5");
INSERT INTO cortesia VALUES("4","3.00","2","6.00","13","3");
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
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `idorden` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`iddetalleorden`,`idorden`,`idproducto`),
  KEY `fk_detalleorden_orden1_idx` (`idorden`),
  KEY `fk_detalleorden_producto1_idx` (`idproducto`),
  CONSTRAINT `fk_detalleorden_orden1` FOREIGN KEY (`idorden`) REFERENCES `orden` (`idorden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleorden_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

INSERT INTO detalleorden VALUES("1","0.50","1","0.50","1","2");
INSERT INTO detalleorden VALUES("2","6.00","1","6.00","1","1");
INSERT INTO detalleorden VALUES("3","0.50","5","2.50","2","2");
INSERT INTO detalleorden VALUES("4","6.00","2","12.00","2","1");
INSERT INTO detalleorden VALUES("5","0.50","2","1.00","3","2");
INSERT INTO detalleorden VALUES("6","6.00","2","12.00","3","1");
INSERT INTO detalleorden VALUES("7","0.50","3","1.50","4","2");
INSERT INTO detalleorden VALUES("8","0.50","3","1.50","5","2");
INSERT INTO detalleorden VALUES("9","6.00","2","12.00","5","1");
INSERT INTO detalleorden VALUES("10","5.00","1","5.00","6","3");
INSERT INTO detalleorden VALUES("11","0.50","1","0.50","6","2");
INSERT INTO detalleorden VALUES("12","6.00","1","6.00","6","1");
INSERT INTO detalleorden VALUES("13","6.00","2","12.00","7","11");
INSERT INTO detalleorden VALUES("14","4.00","1","4.00","7","10");
INSERT INTO detalleorden VALUES("15","30.00","1","30.00","7","9");
INSERT INTO detalleorden VALUES("16","20.00","1","20.00","7","8");
INSERT INTO detalleorden VALUES("17","5.00","1","5.00","7","7");
INSERT INTO detalleorden VALUES("18","2.00","1","2.00","7","6");
INSERT INTO detalleorden VALUES("19","4.00","1","4.00","7","5");
INSERT INTO detalleorden VALUES("20","6.00","1","6.00","7","4");
INSERT INTO detalleorden VALUES("21","3.00","1","3.00","7","3");
INSERT INTO detalleorden VALUES("22","1.20","1","1.20","7","2");
INSERT INTO detalleorden VALUES("23","3.00","1","3.00","7","1");
INSERT INTO detalleorden VALUES("24","30.00","1","30.00","8","9");
INSERT INTO detalleorden VALUES("25","2.00","1","2.00","8","6");
INSERT INTO detalleorden VALUES("26","20.00","1","20.00","9","8");
INSERT INTO detalleorden VALUES("27","2.00","1","2.00","9","6");
INSERT INTO detalleorden VALUES("28","1.20","1","1.20","9","2");
INSERT INTO detalleorden VALUES("29","4.00","1","4.00","9","10");
INSERT INTO detalleorden VALUES("30","6.00","1","6.60","10","11");
INSERT INTO detalleorden VALUES("31","2.00","1","2.20","11","6");
INSERT INTO detalleorden VALUES("32","4.00","1","4.40","11","5");
INSERT INTO detalleorden VALUES("33","3.00","1","3.30","11","3");
INSERT INTO detalleorden VALUES("34","6.00","1","6.00","12","11");
INSERT INTO detalleorden VALUES("35","4.00","1","4.00","12","5");
INSERT INTO detalleorden VALUES("36","3.00","1","3.00","12","3");
INSERT INTO detalleorden VALUES("37","6.00","9","54.00","13","11");
INSERT INTO detalleorden VALUES("38","5.00","1","5.00","13","7");
INSERT INTO detalleorden VALUES("39","20.00","7","140.00","14","8");
INSERT INTO detalleorden VALUES("40","4.00","14","56.00","14","10");
INSERT INTO detalleorden VALUES("41","4.00","2","8.00","14","5");
INSERT INTO detalleorden VALUES("42","6.00","1","6.00","14","4");
INSERT INTO detalleorden VALUES("43","6.00","33","198.00","14","11");
INSERT INTO detalleorden VALUES("44","30.00","3","90.00","14","9");
INSERT INTO detalleorden VALUES("45","3.00","1","3.00","14","3");
INSERT INTO detalleorden VALUES("48","3.00","1","3.00","14","1");
INSERT INTO detalleorden VALUES("49","30.00","1","30.00","13","9");
INSERT INTO detalleorden VALUES("50","4.00","1","4.00","13","5");
INSERT INTO detalleorden VALUES("51","4.00","4","16.00","13","10");
INSERT INTO detalleorden VALUES("52","1.20","1","1.20","13","2");
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO mesa VALUES("1","No Mesa","ndandads","ddfdfdfd","0000-00-00 00:00:00","Disponible");
INSERT INTO mesa VALUES("3","1","./mesas/3.jpg","dffgf","2016-11-16 22:57:44","Disponible");
INSERT INTO mesa VALUES("4","2","./mesas/4.jpg","h","2016-11-21 13:46:52","Ocupada");
INSERT INTO mesa VALUES("5","3","./mesas/5.jpg","j","2016-11-21 13:47:06","Disponible");
INSERT INTO mesa VALUES("6","4","./mesas/6.jpg","j","2016-11-21 13:47:20","Disponible");
INSERT INTO mesa VALUES("7","5","./mesas/7.jpg","Es de","2016-11-21 16:30:46","Disponible");
INSERT INTO mesa VALUES("8","6","mesas/8.jpg","comedor","2016-11-21 16:31:03","Ocupada");
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO mesero VALUES("1","mesad2","Jrge","Martinez","2020-0505","Dereicece","0000-00-00 00:00:00","Disponible","0");
INSERT INTO mesero VALUES("2","Mes1","marvin de jesus ","ramirezdf ","2021-2121","san se","2016-11-16 22:10:12","Disponible","0");
INSERT INTO mesero VALUES("3","454","gggfgf","gffdfdf","2021-2010","ggff fdfd fd dfdgg  yyg yygy gy  y yg yg yggygygygy ygygygyg  yg  ygy  g ygy g  h  hghg g grrdededeswsw www ww g jjkuuyyy tt trt rrrrrrrrrrrrrrrrr ggff fdfd fd dfdgg  yyg yygy gy  y yg yg yggygygygy y","2016-11-21 13:49:30","Disponible","0");
INSERT INTO mesero VALUES("4","jh  hh20211","gdggasf gafgsgfdsgfsgfs g","f fgsd sd fdlg lldfg kf gfdjhjfkhj fk hjjhkfj","2012-1211","210212sdfsd dshdg hfdg hidfg ufd gufdg hufhg ufghufhguf ghufghufhgfug ughfg ufkd dfhgfduhgfud ghfdughudfhgudfhgfdug dfug du uf","2016-11-21 13:50:04","Disponible","0");
INSERT INTO mesero VALUES("5","gf ","ffd ","ff ","2012-0012","hg ","2016-11-21 16:35:57","Disponible","1");
INSERT INTO mesero VALUES("6","kkj5","ggfg","fffdf ","2021-2125","gfgfg","2016-11-21 16:36:21","Disponible","0");
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO orden VALUES("1","2016-11-16","1","2","1","2","Pagada");
INSERT INTO orden VALUES("2","2016-11-17","1","3","3","2","Pagada");
INSERT INTO orden VALUES("3","2016-11-18","1","4","3","1","Pagada");
INSERT INTO orden VALUES("4","2016-11-18","1","4","1","1","Pagada");
INSERT INTO orden VALUES("5","2016-11-18","1","3","3","1","Pagada");
INSERT INTO orden VALUES("6","2016-11-18","1","4","3","2","Pagada");
INSERT INTO orden VALUES("7","2016-11-20","1","5","3","2","Pagada");
INSERT INTO orden VALUES("8","2016-11-20","1","4","3","2","Pagada");
INSERT INTO orden VALUES("9","2016-11-21","1","7","4","2","Pagada");
INSERT INTO orden VALUES("10","2016-11-22","1","6","4","1","Pagada");
INSERT INTO orden VALUES("11","2016-11-22","1","4","3","1","Pagada");
INSERT INTO orden VALUES("12","2016-11-22","1","8","3","1","Pagada");
INSERT INTO orden VALUES("13","2016-11-22","1","8","4","5","Pendiente");
INSERT INTO orden VALUES("14","2016-11-22","1","4","3","1","Pagada");
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO pago VALUES("1","1.50","5.00","3.50","4");
INSERT INTO pago VALUES("2","13.00","20.00","7.00","3");
INSERT INTO pago VALUES("5","13.50","40.00","26.50","5");
INSERT INTO pago VALUES("6","11.50","15.00","3.50","6");
INSERT INTO pago VALUES("7","90.20","95.00","4.80","7");
INSERT INTO pago VALUES("8","14.50","30.00","15.50","2");
INSERT INTO pago VALUES("9","32.00","40.00","8.00","8");
INSERT INTO pago VALUES("10","6.50","10.00","3.50","1");
INSERT INTO pago VALUES("11","9.90","10.00","0.10","11");
INSERT INTO pago VALUES("12","14.30","20.00","5.70","12");
INSERT INTO pago VALUES("13","7.26","10.00","2.74","10");
INSERT INTO pago VALUES("14","29.92","30.00","0.08","9");
INSERT INTO pago VALUES("15","554.40","555.00","0.60","14");
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
INSERT INTO producto VALUES("2","gaseosa","Menu a la carta","130","112","0","cocacola","1.20","134.40","Activo","2016-11-20","Activado Correctamente","2016-11-16","2");
INSERT INTO producto VALUES("3","pollo frito","Menu a la carta","50","44","0","Es india","3.00","132.00","Activo","2016-11-20","Activado Correctamente","2016-11-18","1");
INSERT INTO producto VALUES("4","res","Menu a la carta","300","299","0","dsdsd sd sd s","6.00","1794.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
INSERT INTO producto VALUES("5","cerveza","Menu a la carta","300","296","0","dsd sfs","4.00","1184.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","2");
INSERT INTO producto VALUES("6","fresfo","Menu a la carta","50","46","0","de zanahoria","2.00","92.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","2");
INSERT INTO producto VALUES("7","conejo","Menu a la carta","33","31","0","es","5.00","155.00","Activo","2016-11-24","Activado Correctamente","2016-11-20","1");
INSERT INTO producto VALUES("8","cngrejo","Menu a la carta","30","27","0","da dvd c  f f","20.00","540.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
INSERT INTO producto VALUES("9","cafe","Menu a la carta","20","17","0","de ","30.00","510.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
INSERT INTO producto VALUES("10","chocolate","Menu a la carta","20","14","0","de ca","4.00","56.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","2");
INSERT INTO producto VALUES("11","pollo al a majar","Menu a la carta","20","6","0","td fg fdg dg d g dgdfg fg fdg fh fgh fghfg fgh fhf hfdff fh fhf fh hg,hg,h","6.00","36.00","Activo","2016-11-20","Activado Correctamente","2016-11-20","1");
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO proveedor VALUES("1","ads","sfdf","2021-0210","dsds@df.com","sdsds","sdsd","2012-0012","Activo","2016-11-21","Activo Correctamente");
INSERT INTO proveedor VALUES("2","dsds","sdsds","2021-2154","sds@gmail.com","dsfsdf","dfdfd","2021-2121","Activo","2016-11-21","Activo Correctamente");
INSERT INTO proveedor VALUES("3","zcxzcx","ghgh","2021-0212","sds@gail.com","sdfs","dfs","2002-1021","Activo","2016-11-21","Activo Correctamente");
INSERT INTO proveedor VALUES("4","ass","ffd","2032-3013","dad@gmail.com","cer","fdd","2021-0102","Activo","2016-11-21","Activo Correctamente");
INSERT INTO proveedor VALUES("5","fg d","hghg","2023-2310","gh@gmail.com","j","h","2021-2121","Activo","2016-11-21","Activo Correctamente");
INSERT INTO proveedor VALUES("6","d d","jhghgh","2323-0131","sds@gmil.com","dsfsdfs","dfd","2020-2021","Activo","2016-11-21","Activo Correctamente");
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO tipoproducto VALUES("1","comida","2016-11-16 21:17:44");
INSERT INTO tipoproducto VALUES("2","bebidas","2016-11-16 23:08:19");
INSERT INTO tipoproducto VALUES("3","referescos","2016-11-21 17:03:05");
INSERT INTO tipoproducto VALUES("4","pan","2016-11-21 17:03:21");
INSERT INTO tipoproducto VALUES("5","cafe","2016-11-21 17:03:27");
INSERT INTO tipoproducto VALUES("6","leche","2016-11-21 17:03:32");
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS tipousuario; SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `agregado` datetime NOT NULL,
  PRIMARY KEY (`idtipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO tipousuario VALUES("1","administrador","2016-11-15 00:00:00");
INSERT INTO tipousuario VALUES("3","ingerdfd","2016-11-15 20:16:53");
INSERT INTO tipousuario VALUES("4","user","2016-11-15 20:17:00");
INSERT INTO tipousuario VALUES("5","xxvcvc c","2016-11-17 17:16:47");
INSERT INTO tipousuario VALUES("6","dff sf sdf sf sdf sdfs","2016-11-17 17:16:52");
INSERT INTO tipousuario VALUES("7","dash","2016-11-21 17:06:14");
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO usuario VALUES("1","jose","Cortez lovato","jose@gmail.com","jose","827ccb0eea8a706c4c34a16891f84e7b","0","0","hola","hola","Activo","2016-11-15 15:00:00","1","2016-11-26 17:35:48","activo","1");
INSERT INTO usuario VALUES("2","darwi","sds","dae@gmail.com","dar","827ccb0eea8a706c4c34a16891f84e7b","0","0","dar","dar","Activo","2016-11-21 17:09:41","0","0000-00-00 00:00:00","Activado Correctamente","3");
INSERT INTO usuario VALUES("3","marvin","sds","dds@hotmail.com","fsdfd","e10adc3949ba59abbe56e057f20f883e","0","0","hola","hola","Activo","2016-11-21 17:10:19","0","0000-00-00 00:00:00","Activado Correctamente","4");
INSERT INTO usuario VALUES("4","omar","sfd","om@gmai.com","omar","d4466cce49457cfea18222f5a7cd3573","0","0","ommar","omar","Activo","2016-11-21 17:10:53","0","0000-00-00 00:00:00","Activado Correctamente","7");
INSERT INTO usuario VALUES("5","ami","ami","ami@gmail.com","ami","827ccb0eea8a706c4c34a16891f84e7b","0","0","ami","ami","Activo","2016-11-21 17:11:36","0","0000-00-00 00:00:00","Activado Correctamente","6");
INSERT INTO usuario VALUES("6","fran","fran","fran@gmail.com","fran","2c20cb5558626540a1704b1fe524ea9a","0","0","fran","fran","Activo","2016-11-21 17:12:32","0","0000-00-00 00:00:00","Activado Correctamente","6");
SET FOREIGN_KEY_CHECKS=1;

