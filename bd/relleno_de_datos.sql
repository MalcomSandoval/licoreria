-- ============================================================
-- PROVEEDORES
-- ============================================================
 
INSERT INTO `proveedores` (`id`, `nombre`, `empresa`, `telefono`, `email`, `link_web`, `direccion`, `frecuencia_visita`, `activo`, `created_at`, `updated_at`) VALUES
('aa000001-0000-0000-0000-000000000001', 'Carlos Martínez', 'Bavaria S.A.', '3001234567', 'ventas@bavaria.com.co', 'https://www.bavaria.co', 'Calle 94 # 15-46, Bogotá', 'Semanal', 1, NOW(), NOW()),
('aa000001-0000-0000-0000-000000000002', 'Andrés Gómez', 'Diageo Colombia', '3109876543', 'andres.gomez@diageo.com', 'https://www.diageo.com', 'Av. El Dorado # 69C-03, Bogotá', 'Quincenal', 1, NOW(), NOW()),
('aa000001-0000-0000-0000-000000000003', 'Patricia Ríos', 'Casa Luker / Postobón', '3157654321', 'patricia.rios@postobon.com.co', 'https://www.postobon.com.co', 'Carrera 43A # 1-50, Medellín', 'Semanal', 1, NOW(), NOW()),
('aa000001-0000-0000-0000-000000000004', 'Roberto Cárdenas', 'Industrias Licoreras de Caldas', '3204567890', 'rcardenas@ilc.gov.co', 'https://www.licoresdecaldas.com', 'Carrera 23 # 18-03, Manizales', 'Mensual', 1, NOW(), NOW()),
('aa000001-0000-0000-0000-000000000005', 'Juliana Torres', 'Pernod Ricard Colombia', '3012345678', 'jtorres@pernod-ricard.com', 'https://www.pernod-ricard.com', 'Calle 100 # 8A-55, Bogotá', 'Quincenal', 1, NOW(), NOW()),
('aa000001-0000-0000-0000-000000000006', 'Miguel Salazar', 'Distribuidora La Bodega', '3168901234', 'msalazar@labodega.com.co', NULL, 'Carrera 50 # 12-30, Cali', 'Semanal', 1, NOW(), NOW());
 
-- ============================================================
-- PRODUCTOS - CERVEZAS
-- ============================================================
 
INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `stock`, `stock_critico`, `precio`, `precio_compra`, `precio_venta_caja`, `precio_caja`, `cantidad_caja`, `categoria`, `proveedor_id`, `codigo_barras`, `activo`, `created_at`, `updated_at`) VALUES
 
-- Cervezas Bavaria
('bb000001-0000-0000-0000-000000000001', 'Águila Lata 330ml', 'Cerveza tipo lager, lata 330ml', 120, 24, 3500.00, 2200.00, 77000.00, 52800.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000011', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000002', 'Águila Botella 330ml', 'Cerveza tipo lager, botella 330ml retornable', 96, 24, 3200.00, 1900.00, 70400.00, 45600.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000012', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000003', 'Águila Light Lata 330ml', 'Cerveza baja en calorías, lata 330ml', 96, 24, 3500.00, 2200.00, 77000.00, 52800.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000013', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000004', 'Poker Lata 330ml', 'Cerveza poker lata 330ml', 96, 24, 3200.00, 2000.00, 70400.00, 48000.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000014', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000005', 'Poker Botella 330ml', 'Cerveza poker botella 330ml retornable', 144, 24, 3000.00, 1800.00, 66000.00, 43200.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000015', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000006', 'Costeña Lata 330ml', 'Cerveza costeña lata 330ml', 72, 24, 3200.00, 2000.00, 70400.00, 48000.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000016', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000007', 'Club Colombia Roja Lata 330ml', 'Cerveza premium tipo amber, lata 330ml', 72, 12, 5000.00, 3200.00, 110000.00, 76800.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000017', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000008', 'Club Colombia Dorada Lata 330ml', 'Cerveza premium tipo lager, lata 330ml', 72, 12, 5000.00, 3200.00, 110000.00, 76800.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000018', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000009', 'Heineken Lata 330ml', 'Cerveza importada holandesa, lata 330ml', 48, 12, 6500.00, 4200.00, 143000.00, 100800.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '8711000000019', 1, NOW(), NOW()),
('bb000001-0000-0000-0000-000000000010', 'Corona Extra Botella 355ml', 'Cerveza importada mexicana, botella 355ml', 36, 12, 7000.00, 4500.00, 154000.00, 108000.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000006', '7501064000010', 1, NOW(), NOW()),
 
-- ============================================================
-- PRODUCTOS - AGUARDIENTES Y RONES
-- ============================================================
 
('bb000002-0000-0000-0000-000000000001', 'Aguardiente Antioqueño 750ml', 'Aguardiente sin azúcar, botella 750ml', 48, 12, 35000.00, 22000.00, 385000.00, 264000.00, 12, 'Aguardiente', 'aa000001-0000-0000-0000-000000000004', '7702065000021', 1, NOW(), NOW()),
('bb000002-0000-0000-0000-000000000002', 'Aguardiente Antioqueño 375ml', 'Aguardiente sin azúcar, media botella 375ml', 60, 12, 18500.00, 12000.00, 204000.00, 144000.00, 12, 'Aguardiente', 'aa000001-0000-0000-0000-000000000004', '7702065000022', 1, NOW(), NOW()),
('bb000002-0000-0000-0000-000000000003', 'Aguardiente Antioqueño 250ml', 'Aguardiente sin azúcar, botella 250ml', 60, 12, 13000.00, 8000.00, 143000.00, 96000.00, 12, 'Aguardiente', 'aa000001-0000-0000-0000-000000000004', '7702065000023', 1, NOW(), NOW()),
('bb000002-0000-0000-0000-000000000004', 'Aguardiente Néctar 750ml', 'Aguardiente del Valle, botella 750ml', 36, 12, 33000.00, 20000.00, 363000.00, 240000.00, 12, 'Aguardiente', 'aa000001-0000-0000-0000-000000000004', '7702065000024', 1, NOW(), NOW()),
('bb000002-0000-0000-0000-000000000005', 'Aguardiente Néctar 375ml', 'Aguardiente del Valle, media botella 375ml', 48, 12, 17500.00, 11000.00, 192500.00, 132000.00, 12, 'Aguardiente', 'aa000001-0000-0000-0000-000000000004', '7702065000025', 1, NOW(), NOW()),
('bb000002-0000-0000-0000-000000000006', 'Ron Medellín 8 Años 750ml', 'Ron añejo premium, botella 750ml', 24, 6, 68000.00, 44000.00, 748000.00, 528000.00, 12, 'Ron', 'aa000001-0000-0000-0000-000000000004', '7702065000026', 1, NOW(), NOW()),
('bb000002-0000-0000-0000-000000000007', 'Ron Medellín Extra Añejo 750ml', 'Ron extra añejo, botella 750ml', 18, 6, 95000.00, 62000.00, 1045000.00, 744000.00, 12, 'Ron', 'aa000001-0000-0000-0000-000000000004', '7702065000027', 1, NOW(), NOW()),
('bb000002-0000-0000-0000-000000000008', 'Rum Bacardí Blanco 750ml', 'Ron blanco importado, botella 750ml', 24, 6, 72000.00, 47000.00, 792000.00, 564000.00, 12, 'Ron', 'aa000001-0000-0000-0000-000000000005', '0080480000028', 1, NOW(), NOW()),
 
-- ============================================================
-- PRODUCTOS - WHISKIES
-- ============================================================
 
('bb000003-0000-0000-0000-000000000001', 'Whisky Old Parr 750ml', 'Whisky escocés blended 12 años, 750ml', 18, 6, 120000.00, 78000.00, 1320000.00, 936000.00, 12, 'Whisky', 'aa000001-0000-0000-0000-000000000002', '5000267000031', 1, NOW(), NOW()),
('bb000003-0000-0000-0000-000000000002', 'Whisky Johnnie Walker Red Label 750ml', 'Whisky escocés blended, botella 750ml', 24, 6, 115000.00, 74000.00, 1265000.00, 888000.00, 12, 'Whisky', 'aa000001-0000-0000-0000-000000000002', '5000267000032', 1, NOW(), NOW()),
('bb000003-0000-0000-0000-000000000003', 'Whisky Johnnie Walker Black Label 750ml', 'Whisky escocés 12 años, botella 750ml', 12, 4, 185000.00, 120000.00, 2035000.00, 1440000.00, 12, 'Whisky', 'aa000001-0000-0000-0000-000000000002', '5000267000033', 1, NOW(), NOW()),
('bb000003-0000-0000-0000-000000000004', 'Whisky Jack Daniels 750ml', 'Tennessee whiskey americano, botella 750ml', 18, 6, 145000.00, 94000.00, 1595000.00, 1128000.00, 12, 'Whisky', 'aa000001-0000-0000-0000-000000000005', '0082184000034', 1, NOW(), NOW()),
 
-- ============================================================
-- PRODUCTOS - VINOS
-- ============================================================
 
('bb000004-0000-0000-0000-000000000001', 'Vino Santa Helena Reservado Tinto 750ml', 'Vino tinto chileno, botella 750ml', 36, 6, 28000.00, 18000.00, 308000.00, 216000.00, 12, 'Vino', 'aa000001-0000-0000-0000-000000000006', '7804320000041', 1, NOW(), NOW()),
('bb000004-0000-0000-0000-000000000002', 'Vino Santa Helena Reservado Blanco 750ml', 'Vino blanco chileno, botella 750ml', 24, 6, 28000.00, 18000.00, 308000.00, 216000.00, 12, 'Vino', 'aa000001-0000-0000-0000-000000000006', '7804320000042', 1, NOW(), NOW()),
('bb000004-0000-0000-0000-000000000003', 'Vino Gato Negro Tinto 750ml', 'Vino tinto chileno suave, botella 750ml', 30, 6, 25000.00, 16000.00, 275000.00, 192000.00, 12, 'Vino', 'aa000001-0000-0000-0000-000000000006', '7804320000043', 1, NOW(), NOW()),
('bb000004-0000-0000-0000-000000000004', 'Vino Casillero del Diablo Cabernet 750ml', 'Vino tinto premium chileno, botella 750ml', 18, 4, 45000.00, 29000.00, 495000.00, 348000.00, 12, 'Vino', 'aa000001-0000-0000-0000-000000000006', '7804320000044', 1, NOW(), NOW()),
 
-- ============================================================
-- PRODUCTOS - VODKA Y GIN
-- ============================================================
 
('bb000005-0000-0000-0000-000000000001', 'Vodka Smirnoff 750ml', 'Vodka triple destilado, botella 750ml', 24, 6, 72000.00, 46000.00, 792000.00, 552000.00, 12, 'Vodka', 'aa000001-0000-0000-0000-000000000002', '0082000000051', 1, NOW(), NOW()),
('bb000005-0000-0000-0000-000000000002', 'Vodka Smirnoff 375ml', 'Vodka triple destilado, media botella 375ml', 36, 6, 39000.00, 25000.00, 429000.00, 300000.00, 12, 'Vodka', 'aa000001-0000-0000-0000-000000000002', '0082000000052', 1, NOW(), NOW()),
('bb000005-0000-0000-0000-000000000003', 'Gin Gordon\'s 750ml', 'Gin inglés clásico, botella 750ml', 18, 4, 78000.00, 50000.00, 858000.00, 600000.00, 12, 'Gin', 'aa000001-0000-0000-0000-000000000002', '5000289000053', 1, NOW(), NOW()),
('bb000005-0000-0000-0000-000000000004', 'Gin Tanqueray 750ml', 'Gin premium inglés, botella 750ml', 12, 4, 120000.00, 78000.00, 1320000.00, 936000.00, 12, 'Gin', 'aa000001-0000-0000-0000-000000000002', '5000291000054', 1, NOW(), NOW()),
 
-- ============================================================
-- PRODUCTOS - BEBIDAS MEZCLADORES
-- ============================================================
 
('bb000006-0000-0000-0000-000000000001', 'Coca-Cola 400ml', 'Gaseosa coca-cola PET 400ml', 120, 24, 3000.00, 1800.00, 66000.00, 43200.00, 24, 'Gaseosas', 'aa000001-0000-0000-0000-000000000003', '7791813000061', 1, NOW(), NOW()),
('bb000006-0000-0000-0000-000000000002', 'Coca-Cola 1.5L', 'Gaseosa coca-cola PET 1.5L', 72, 12, 6500.00, 4200.00, 71500.00, 50400.00, 12, 'Gaseosas', 'aa000001-0000-0000-0000-000000000003', '7791813000062', 1, NOW(), NOW()),
('bb000006-0000-0000-0000-000000000003', 'Sprite 400ml', 'Gaseosa sprite PET 400ml', 96, 24, 3000.00, 1800.00, 66000.00, 43200.00, 24, 'Gaseosas', 'aa000001-0000-0000-0000-000000000003', '7791813000063', 1, NOW(), NOW()),
('bb000006-0000-0000-0000-000000000004', 'Agua Cristal 600ml', 'Agua purificada sin gas, botella 600ml', 120, 24, 2500.00, 1500.00, 55000.00, 36000.00, 24, 'Agua', 'aa000001-0000-0000-0000-000000000003', '7791813000064', 1, NOW(), NOW()),
('bb000006-0000-0000-0000-000000000005', 'Agua Cristal con Gas 600ml', 'Agua con gas, botella 600ml', 72, 12, 3000.00, 1800.00, 66000.00, 43200.00, 24, 'Agua', 'aa000001-0000-0000-0000-000000000003', '7791813000065', 1, NOW(), NOW()),
('bb000006-0000-0000-0000-000000000006', 'Jugo Hit Lulo 250ml', 'Jugo Hit sabor lulo 250ml', 96, 24, 2500.00, 1500.00, 55000.00, 36000.00, 24, 'Jugos', 'aa000001-0000-0000-0000-000000000003', '7791813000066', 1, NOW(), NOW()),
('bb000006-0000-0000-0000-000000000007', 'Tónica Schweppes 250ml', 'Agua tónica, lata 250ml - ideal para gin', 60, 12, 4500.00, 2800.00, 99000.00, 67200.00, 24, 'Mezcladores', 'aa000001-0000-0000-0000-000000000003', '5449000000067', 1, NOW(), NOW()),
('bb000006-0000-0000-0000-000000000008', 'Red Bull 250ml', 'Bebida energizante, lata 250ml', 72, 12, 8500.00, 5500.00, 187000.00, 132000.00, 24, 'Energizantes', 'aa000001-0000-0000-0000-000000000006', '9002490000068', 1, NOW(), NOW()),
 
-- ============================================================
-- PRODUCTOS - LICORES NACIONALES ESPECIALES
-- ============================================================
 
('bb000007-0000-0000-0000-000000000001', 'Tequila José Cuervo Gold 750ml', 'Tequila reposado mexicano, botella 750ml', 18, 4, 95000.00, 62000.00, 1045000.00, 744000.00, 12, 'Tequila', 'aa000001-0000-0000-0000-000000000005', '0081127000071', 1, NOW(), NOW()),
('bb000007-0000-0000-0000-000000000002', 'Champaña Cook\'s California Brut 750ml', 'Vino espumoso, botella 750ml', 24, 6, 42000.00, 27000.00, 462000.00, 324000.00, 12, 'Espumosos', 'aa000001-0000-0000-0000-000000000006', '0085000000072', 1, NOW(), NOW()),
('bb000007-0000-0000-0000-000000000003', 'Brandy Cardenal Mendoza 700ml', 'Brandy español premium, botella 700ml', 12, 4, 185000.00, 120000.00, 2035000.00, 1440000.00, 12, 'Brandy', 'aa000001-0000-0000-0000-000000000005', '8410010000073', 1, NOW(), NOW()),
('bb000007-0000-0000-0000-000000000004', 'Crema de Whisky Baileys 750ml', 'Licor de crema irlandés, botella 750ml', 18, 4, 98000.00, 64000.00, 1078000.00, 768000.00, 12, 'Licores de Crema', 'aa000001-0000-0000-0000-000000000002', '5011013000074', 1, NOW(), NOW()),
 
-- ============================================================
-- PRODUCTOS - SNACKS Y COMPLEMENTOS
-- ============================================================
 
('bb000008-0000-0000-0000-000000000001', 'Maní La Primavera 100g', 'Maní salado empaque 100g', 60, 12, 4500.00, 2800.00, 49500.00, 33600.00, 12, 'Snacks', 'aa000001-0000-0000-0000-000000000006', '7701000000081', 1, NOW(), NOW()),
('bb000008-0000-0000-0000-000000000002', 'Papas Margarita Sal 85g', 'Papas fritas sal tradicional 85g', 60, 12, 4000.00, 2500.00, 44000.00, 30000.00, 12, 'Snacks', 'aa000001-0000-0000-0000-000000000006', '7702098000082', 1, NOW(), NOW()),
('bb000008-0000-0000-0000-000000000003', 'Cigarrillos Marlboro Rojo x20', 'Cigarrillos marlboro rojo, cajetilla x20', 60, 10, 16000.00, 11000.00, 176000.00, 132000.00, 12, 'Cigarrillos', 'aa000001-0000-0000-0000-000000000006', '0012300000083', 1, NOW(), NOW()),
('bb000008-0000-0000-0000-000000000004', 'Vasos Desechables x50', 'Vasos plásticos 7oz, paquete x50 unidades', 30, 5, 5500.00, 3500.00, 60500.00, 42000.00, 12, 'Accesorios', NULL, '7701000000084', 1, NOW(), NOW()),
('bb000008-0000-0000-0000-000000000005', 'Hielo en Bolsa 2kg', 'Hielo en cubos, bolsa de 2kg', 40, 10, 5000.00, 2500.00, 55000.00, 27500.00, 12, 'Congelados', NULL, NULL, 1, NOW(), NOW());

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `stock`, `stock_critico`, `precio`, `precio_compra`, `precio_venta_caja`, `precio_caja`, `cantidad_caja`, `categoria`, `proveedor_id`, `codigo_barras`, `activo`, `created_at`, `updated_at`) VALUES

-- CERVEZAS CRÍTICAS
('cc000001-0000-0000-0000-000000000001', 'Águila Mega 1L', 'Cerveza lata grande 1 litro', 3, 8, 8500.00, 5500.00, 93500.00, 66000.00, 12, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000101', 1, NOW(), NOW()),
('cc000001-0000-0000-0000-000000000002', 'Poker Litro 1L', 'Cerveza poker botella 1 litro retornable', 2, 6, 7500.00, 4800.00, 82500.00, 57600.00, 12, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '7702020000102', 1, NOW(), NOW()),
('cc000001-0000-0000-0000-000000000003', 'Stella Artois Lata 330ml', 'Cerveza belga premium importada', 4, 8, 7000.00, 4500.00, 154000.00, 108000.00, 24, 'Cervezas', 'aa000001-0000-0000-0000-000000000001', '5411544000103', 1, NOW(), NOW()),

-- AGUARDIENTES CRÍTICOS
('cc000002-0000-0000-0000-000000000001', 'Aguardiente Cristal 750ml', 'Aguardiente del Valle con azúcar 750ml', 3, 8, 32000.00, 20000.00, 352000.00, 240000.00, 12, 'Aguardiente', 'aa000001-0000-0000-0000-000000000004', '7702065000201', 1, NOW(), NOW()),
('cc000002-0000-0000-0000-000000000002', 'Aguardiente Llanero 750ml', 'Aguardiente de los Llanos 750ml', 2, 6, 30000.00, 19000.00, 330000.00, 228000.00, 12, 'Aguardiente', 'aa000001-0000-0000-0000-000000000004', '7702065000202', 1, NOW(), NOW()),
('cc000002-0000-0000-0000-000000000003', 'Aguardiente Antioqueño 100ml', 'Aguardiente miniatura 100ml', 5, 10, 6500.00, 4000.00, 71500.00, 48000.00, 12, 'Aguardiente', 'aa000001-0000-0000-0000-000000000004', '7702065000203', 1, NOW(), NOW()),

-- RONES CRÍTICOS
('cc000003-0000-0000-0000-000000000001', 'Ron Viejo de Caldas 750ml', 'Ron colombiano clásico 750ml', 3, 6, 42000.00, 27000.00, 462000.00, 324000.00, 12, 'Ron', 'aa000001-0000-0000-0000-000000000004', '7702065000301', 1, NOW(), NOW()),
('cc000003-0000-0000-0000-000000000002', 'Ron Viejo de Caldas 375ml', 'Ron colombiano clásico media botella', 4, 8, 22000.00, 14000.00, 242000.00, 168000.00, 12, 'Ron', 'aa000001-0000-0000-0000-000000000004', '7702065000302', 1, NOW(), NOW()),
('cc000003-0000-0000-0000-000000000003', 'Ron Capitán Morgan 750ml', 'Ron especiado importado 750ml', 2, 5, 85000.00, 55000.00, 935000.00, 660000.00, 12, 'Ron', 'aa000001-0000-0000-0000-000000000005', '0082000000303', 1, NOW(), NOW()),

-- WHISKIES CRÍTICOS
('cc000004-0000-0000-0000-000000000001', 'Whisky Old Parr 12 Años 1L', 'Whisky escocés premium botella 1 litro', 2, 5, 195000.00, 127000.00, 2145000.00, 1524000.00, 12, 'Whisky', 'aa000001-0000-0000-0000-000000000002', '5000267000401', 1, NOW(), NOW()),
('cc000004-0000-0000-0000-000000000002', 'Whisky Chivas Regal 12A 750ml', 'Whisky escocés blended 12 años', 1, 5, 210000.00, 136000.00, 2310000.00, 1632000.00, 12, 'Whisky', 'aa000001-0000-0000-0000-000000000002', '5000299000402', 1, NOW(), NOW()),
('cc000004-0000-0000-0000-000000000003', 'Whisky JW Double Black 750ml', 'Johnnie Walker Double Black 750ml', 3, 5, 220000.00, 143000.00, 2420000.00, 1716000.00, 12, 'Whisky', 'aa000001-0000-0000-0000-000000000002', '5000267000403', 1, NOW(), NOW()),

-- VINOS CRÍTICOS
('cc000005-0000-0000-0000-000000000001', 'Vino Concha y Toro Tinto 750ml', 'Vino tinto chileno reserva 750ml', 3, 6, 38000.00, 24000.00, 418000.00, 288000.00, 12, 'Vino', 'aa000001-0000-0000-0000-000000000006', '7804320000501', 1, NOW(), NOW()),
('cc000005-0000-0000-0000-000000000002', 'Vino Frontera Rosado 750ml', 'Vino rosado chileno suave 750ml', 4, 6, 22000.00, 14000.00, 242000.00, 168000.00, 12, 'Vino', 'aa000001-0000-0000-0000-000000000006', '7804320000502', 1, NOW(), NOW()),
('cc000005-0000-0000-0000-000000000003', 'Vino Don Simón Tinto 1L', 'Vino tinto español en caja 1 litro', 2, 5, 18000.00, 11000.00, 198000.00, 132000.00, 12, 'Vino', 'aa000001-0000-0000-0000-000000000006', '8410261000503', 1, NOW(), NOW()),

-- VODKA / GIN CRÍTICOS
('cc000006-0000-0000-0000-000000000001', 'Vodka Absolut 750ml', 'Vodka sueco premium 750ml', 2, 5, 95000.00, 62000.00, 1045000.00, 744000.00, 12, 'Vodka', 'aa000001-0000-0000-0000-000000000005', '7312040000601', 1, NOW(), NOW()),
('cc000006-0000-0000-0000-000000000002', 'Gin Beefeater 750ml', 'Gin inglés London Dry 750ml', 3, 5, 110000.00, 71000.00, 1210000.00, 852000.00, 12, 'Gin', 'aa000001-0000-0000-0000-000000000002', '5000299000602', 1, NOW(), NOW()),

-- ENERGIZANTES / MEZCLADORES CRÍTICOS
('cc000007-0000-0000-0000-000000000001', 'Monster Energy 473ml', 'Bebida energizante lata 473ml', 5, 12, 9500.00, 6200.00, 209000.00, 148800.00, 24, 'Energizantes', 'aa000001-0000-0000-0000-000000000006', '0070847000701', 1, NOW(), NOW()),
('cc000007-0000-0000-0000-000000000002', 'Ginger Ale Schweppes 250ml', 'Mezclador ginger ale lata 250ml', 8, 12, 4500.00, 2800.00, 99000.00, 67200.00, 24, 'Mezcladores', 'aa000001-0000-0000-0000-000000000003', '5449000000702', 1, NOW(), NOW()),
('cc000007-0000-0000-0000-000000000003', 'Agua Tónica Schweppes 500ml', 'Tónica premium botella 500ml', 4, 10, 5500.00, 3500.00, 121000.00, 84000.00, 24, 'Mezcladores', 'aa000001-0000-0000-0000-000000000003', '5449000000703', 1, NOW(), NOW()),

-- SNACKS CRÍTICOS
('cc000008-0000-0000-0000-000000000001', 'Cigarrillos Pielroja x20', 'Cigarrillos nacionales cajetilla x20', 4, 8, 14000.00, 9500.00, 154000.00, 114000.00, 12, 'Cigarrillos', 'aa000001-0000-0000-0000-000000000006', '7701000000801', 1, NOW(), NOW()),
('cc000008-0000-0000-0000-000000000002', 'Maní Tostado La Constancia 200g', 'Maní tostado y salado bolsa 200g', 3, 8, 7500.00, 4800.00, 82500.00, 57600.00, 12, 'Snacks', 'aa000001-0000-0000-0000-000000000006', '7701000000802', 1, NOW(), NOW()),
('cc000008-0000-0000-0000-000000000003', 'Chitos Rizados 85g', 'Snack de maíz bolsa 85g', 5, 10, 4000.00, 2500.00, 44000.00, 30000.00, 12, 'Snacks', 'aa000001-0000-0000-0000-000000000006', '7702098000803', 1, NOW(), NOW());