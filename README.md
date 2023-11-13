# TPE-WEB-3RA-ENTREGA
## Integrantes:
- Cambareri Joaquin, Email: 
- De la Penna Bruno, Email: bdelapenna@gmail.com

# Endpoints

## GET
- GET /user/token: Mediante este endpoint, se puede generar un token limitado para poder acceder a las funciones PUT y POST.
- GET /productos: Se puede acceder a la coleccion entera de productos.
- GET /productos/?order=...&sort=... : Se permite ordenar los productos de manera descendente o ascendente y por un campo en especifico.
- GET /productos/?limit=...&offset=... : Se permite establecer un limite(limit) de productos que se mostrara depende la pagina(offset) elegida.
- GET /productos/?filterBy=... : Se permite filtrar los productos dada una condicion.
- GET /productos/:ID : Se permite acceder a un determinado producto dado por su ID.
- GET /marcas : Se permite acceder a la coleccion entera de marcas.
- GET /marcas/?order=...&sort=... : Se permite ordenar las marcas de manera descendente o ascendente y por un campo en especifico.
- GET /marcas/?limit=...&offset=... : Se permite establecer un limite(limit) de marcas que se mostrara depende la pagina(offset) elegida.
- GET /marcas/:ID : Se permite acceder a una determinada marca dada por su ID.

## POST
- POST /productos: Se permite agregar un nuevo producto. Esta accion se realiza mediante el BODY de POSTMAN.
- POST /marcas: Se permite agregar una nueva marca. Esta accion se realiza mediante el BODY de POSTMAN.

## PUT
- PUT /productos/:ID : Se permite actualizar un producto mediante su ID. Esta accion se realiza mediante el BODY de POSTMAN.
- PUT /marcas/:ID : Se permite actualizar una marca mediante su ID. Esta accion se realiza mediante el BODY de POSTMAN.

## DELETE
- DELETE /productos/:ID : Se permite eliminar un producto mediante su ID.
