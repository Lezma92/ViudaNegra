use viuda_negra;
show tables;
select * from mesas,clientes;

select * from clientes as cli inner join mesas as m on cli.id_mesa = m.idmesas and m.estado = 'ocupada' and m.idmesas = 1;



SELECT 
    tcyt.id,
    tcyt.nombrecob,
    tcyt.ingredientes,
    tcyt.precio,
    tcyt.descripcion,
    btyc.nombre
FROM
    tiposcoctelesytragos AS tcyt
        INNER JOIN
    botellasycocteles AS btyc ON tcyt.id_botellasycocteles = btyc.id
WHERE
    id_botellasycocteles = 1;
    select * from pedidos as ped inner join clientes as cl on ped.id_clientes = cl.idcliente inner join tiposcoctelesytragos as tcyt on tcyt.id = ped.id_tiposcoctelesytragos where cl.idcliente = 1;
    SELECT 
    ped.idpedididos AS idPedido,
    tcyt.nombrecob,
    tcyt.precio,
    ped.cantidad,
    ped.ingredientes,
    ped.fechayhora,
    ped.status_orden,
    (ped.cantidad * tcyt.precio) AS TotalCuenta
FROM
    pedidos AS ped
        INNER JOIN
    clientes AS cl ON ped.id_clientes = cl.idcliente
        INNER JOIN
    tiposcoctelesytragos AS tcyt ON tcyt.id = ped.id_tiposcoctelesytragos
WHERE
    cl.idcliente = 1;
    
    
     SELECT 
    ped.idpedididos AS idPedido,
    us.id,
    us.usuario,
    cl.nombre as nombreCliente,
    ms.idmesas,
    ms.nummesa,
    tcyt.nombrecob,
    tcyt.precio,
    ped.cantidad,
    ped.ingredientes,
    ped.fechayhora,
    ped.status_orden,
    (ped.cantidad * tcyt.precio) AS TotalCuenta
FROM
    pedidos AS ped
        INNER JOIN
    clientes AS cl ON ped.id_clientes = cl.idcliente inner join usuarios as us on cl.id_usuario = us.id
        INNER JOIN
    tiposcoctelesytragos AS tcyt ON tcyt.id = ped.id_tiposcoctelesytragos
inner join mesas as ms on ms.idmesas = cl.id_mesa
WHERE
    us.id = 3 and DATE(ped.fechayhora) = CURDATE();
    
    
    
    /*
    Consulta para ver el consumo por cada cliente
    */
    
SELECT 
    ped.idpedididos,
    tcyt.id AS idtCyT,
    tcyt.nombrecob,
    ped.cantidad,
    convert(tcyt.precio,decimal(6,2)) as precio,
    CONVERT( (tcyt.precio * ped.cantidad) , DECIMAL(6,2)) AS Total
FROM
    pedidos AS ped
        INNER JOIN
    tiposcoctelesytragos AS tcyt ON ped.id_tiposcoctelesytragos = tcyt.id
WHERE
    ped.id_clientes = 7;
    
    
    /*
    consulta para llenar la tabla del principal del cocinero
    */
SELECT 
    *
FROM
    pedidos AS ped
        INNER JOIN
    clientes AS cl ON ped.id_clientes = cl.idcliente
        INNER JOIN
    usuarios AS usu ON usu.id = cl.id_usuario
        INNER JOIN
    tiposcoctelesytragos AS tcyt ON ped.id_tiposcoctelesytragos = tcyt.id
WHERE
    cl.estado = 'Abierto'
        AND ped.status_orden = 'ordenado';
        
        
        
        
        SELECT 
    ped.idpedididos,
    m.nummesa,
    tcyt.nombrecob,
    ped.cantidad,
    ped.ingredientes,
    ped.fechayhora,
    usu.usuario
FROM
    pedidos AS ped
        INNER JOIN
    clientes AS cl ON ped.id_clientes = cl.idcliente
        INNER JOIN
    usuarios AS usu ON usu.id = cl.id_usuario
        INNER JOIN
    mesas AS m ON m.idmesas = cl.id_mesa
        INNER JOIN
    tiposcoctelesytragos AS tcyt ON ped.id_tiposcoctelesytragos = tcyt.id
WHERE
    cl.estado = 'Abierto'
        AND ped.status_orden = 'ordenado'
        AND DATE(ped.fechayhora) = CURDATE() order by ped.fechayhora ASC;
        
        
        
        /*
        mostrar los pedidos pendientes por mesa        */
        
SELECT 
    me.idmesas,
    me.nummesa,
    cl.idcliente,
    cl.nombre,
    count(ped.id_clientes) as CantPedidos
FROM
    mesas AS me
        INNER JOIN
    clientes AS cl ON me.idmesas = cl.id_mesa
        INNER JOIN
    pedidos AS ped ON ped.status_orden = 'ordenado'
        AND cl.idcliente = ped.id_clientes
WHERE
    me.estado = 'ocupada'
        AND cl.estado = 'Abierto'
        AND DATE(ped.fechayhora) = CURDATE()
GROUP BY ped.id_clientes
ORDER BY ped.fechayhora ASC;

/*
listar Pedidos por clientes
*/

SELECT 
    ped.idpedididos,
    tcyt.nombrecob,
    ped.ingredientes,
    ped.cantidad,
    ped.status_orden
FROM
    pedidos AS ped
        INNER JOIN
    tiposcoctelesytragos AS tcyt ON ped.id_tiposcoctelesytragos = tcyt.id
WHERE
    ped.id_clientes = 35;
    
    
    /*Mostrar historial de pedidos atendidos por el cocinero 'HISTORIAL'*/
    SELECT 
    ped.idpedididos AS idPedido,
    us.id,
    us.usuario,
    te.nombreterraza,
    cl.nombre AS nombreCliente,
    ms.idmesas,
    ms.nummesa,
    tcyt.nombrecob,
    tcyt.precio,
    ped.cantidad,
    ped.ingredientes,
    ped.fechayhora,
    ped.status_orden,
    (ped.cantidad * tcyt.precio) AS TotalCuenta
FROM
    pedidos AS ped
        INNER JOIN
    clientes AS cl ON ped.id_clientes = cl.idcliente
        INNER JOIN
    usuarios AS us ON cl.id_usuario = us.id
        INNER JOIN
    tiposcoctelesytragos AS tcyt ON tcyt.id = ped.id_tiposcoctelesytragos
        INNER JOIN
    mesas AS ms ON ms.idmesas = cl.id_mesa inner join terrazas as te on te.idterrazas = ms.id_terrazas
WHERE
    DATE(ped.fechayhora) = CURDATE()
        AND ped.status_orden <> 'preparacion'
        AND ped.status_orden <> 'ordenado'
ORDER BY ped.fechayhora DESC;



/*
//Consulta para ver todos los clientes que han visitado el bar por dia
//
//
*/
select * from tiposcoctelesytragos;
select * from clientes;
select * from pedidos;
describe pedidos;



SELECT 
    cl.idcliente,
    me.idmesas,me.nummesa,
    cl.nombre,
    te.nombreterraza,
    usu.usuario,
    cl.estado,
    COUNT(ped.idpedididos) AS totalPedidos,
    SUM(tcyt.precio) AS totalConsumo
FROM
    clientes AS cl
        INNER JOIN
    usuarios AS usu ON usu.id = cl.id_usuario
        INNER JOIN
    pedidos AS ped ON cl.idcliente = ped.id_clientes
        INNER JOIN
    mesas AS me ON cl.id_mesa = me.idmesas
        INNER JOIN
    terrazas AS te ON te.idterrazas = me.id_terrazas
        INNER JOIN
    tiposcoctelesytragos AS tcyt ON ped.id_tiposcoctelesytragos = tcyt.id
WHERE
    DATE(ped.fechayhora) = CURDATE()
GROUP BY ped.id_clientes
ORDER BY cl.estado ASC;









