# TPE-WEB-3RA-ENTREGA
## Integrantes:

| Nombre                | Email                 |
|-----------------------|-----------------------|
| Cambareri Joaquín     | [joaquin.cambareri@eest3necochea.edu.ar](mailto:joaquin.cambareri@eest3necochea.edu.ar) |
| De la Penna Bruno     | [bdelapenna@gmail.com](mailto:bdelapenna@gmail.com) |

# Endpoints

## GET
- GET /user/token: El endpoint `GET /user/token` se utiliza para validar la autenticidad de un usuario mediante la presentación de un token. tiene una duración limitada, lo que significa que solo es válido durante un período específico de tiempo.
- #### Detalles del Endpoint

- **Método HTTP:** GET
- **Ruta:** `/user/token`
- #### Parámetros de la Solicitud
  Este endpoint requiere que se incluya el token en la URL o en la cabecera de la solicitud.
  #### Respuestas Posibles
-  1. **Éxito (200 OK):** Si el token es válido y aún está dentro de su período de vigencia, el servidor puede responder con un estado 200 OK, indicando que la validación fue exitosa.
   2. **Error de Autenticación (401 Unauthorized):** Si el token no es válido, expiró o no se proporcionó, el servidor puede devolver un estado 401 Unauthorized, indicando que la autenticación ha fallado.
   3. #### Ejemplo de Uso
     Para validar un usuario, se realizaría una solicitud GET a la ruta `/user/token` con el token correspondiente, y la respuesta indicará el resultado de la validación.
- GET /productos: Se puede acceder a la coleccion entera de productos.
 ```json
[
    {
        "ProductoID": 51,
        "Imagen": "",
        "NombreProducto": " ",
        "Descripcion": "Último modelo de Galactic con cámara cuádruple, pantalla AMOLED de 6.5 pulgadas y batería de larga duración.",
        "Precio": 850,
        "Stock": 150,
        "IDmarca": 9,
        "Condicion": "usado"
    },
  ```
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
