CREATE TABLE `encomendas` (
`order_id` int(11) NOT NULL,
`order_date` datetime NOT NULL,
`product_sku` varchar(150) NOT NULL,
`size` varchar(5) NOT NULL,
`color` varchar(50) NOT NULL,
`quantity` int(11) NOT NULL,
`price` float NOT NULL,
 UNIQUE KEY `UNIQUE_ENCOMENDAS` (`order_id`,`product_sku`,`size`,`color`,`quantity`,`price`)
) CHARSET=utf8