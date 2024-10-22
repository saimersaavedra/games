Códigos de respuesta:

    200: conectado correctamente
    201: usuario creado
    202: usuario existe
    203: usuario no existe
    204: el usuario o la contraseña son incorrectos
    205: login correcto
    206: edición hecha
    208: se han actualizado correctamente los datos
    210: Registro con existo.

    400: error de conexion
    401: error intentando crear el usuario
    402: faltan datos para ejecutar la acción solicitada
    403: Ya existe un usuario registrado
    404: Error en inicio
    405: Ya existe este correo

Uso de las funcionalidades:

check()
createUser(nombre, apellido, correo, user, password)
login(user, password)
