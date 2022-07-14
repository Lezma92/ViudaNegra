use viuda_negra;
select *from clientes;

SELECT 
    *
FROM
    categoriademenu AS catm,
    botellasycocteles AS btyc,
    tiposcoctelesytragos AS tip_cocttra
WHERE
    catm.id = btyc.id_categoriademenu
        AND btyc.id = tip_cocttra.id_botellasycocteles;
SELECT 
    usu.id AS id_usuarios,
    us_dat.id AS id_datos,
    usu.usuario,
    usu.tipo_usu,
    us_dat.nombre,
    us_dat.apellidos,
    us_dat.num_tel,
    us_dat.correo
FROM
    usuarios AS usu,
    usuarios_datos AS us_dat
WHERE
    usu.id_datos_usuario = us_dat.id
        AND us_dat.id = 33; 

SELECT 
    *
FROM
    usuarios AS usu
        INNER JOIN
    usuarios_datos AS usu_dat ON usu_dat.id_datos_usuario = 1
        AND usu.id = 33;


SELECT 
    us_da.id AS id_datos,
    us.id AS id_usuario,
    us.usuario,
    us_da.nombre,
    us_da.apellidos,
    us_da.num_tel,
    us_da.correo,
    us.tipo_usu,
    us.ult_fecha_conexion
FROM
    usuarios_datos AS us_da
        INNER JOIN
    usuarios AS us ON us_da.id = us.id;