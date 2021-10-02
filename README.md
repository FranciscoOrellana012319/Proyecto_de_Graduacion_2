# Proyecto_de_Graduacion_2

## Pasos para la instalación del sistema 

**#1** Descagar un servidor web local, de preferencia XAMPP con la version de php en 7.4 o mayor, XAMPP esta disponible para diferentes sistemas operativos, dependiendo el de SO de 
su computador asi lo debera descargar. Link de descarga:

https://www.apachefriends.org/es/index.html

![XAMPP](https://user-images.githubusercontent.com/61365060/134227143-92fa59b9-1b9e-472d-8c06-86ba0f5ac7c2.png)

**#2** Despues de descargar e instalar el servidor local de preferencia XAMPP, debera descargar el proyecto desde Github y pegarlo en la carpeta de su servidor local, 
si esta usando XAMPP la ruta sera: 

C:\xampp\htdocs


![RutaXampp](https://user-images.githubusercontent.com/61365060/134230998-149a80c7-39c9-4a9a-8661-7163cf69f841.png)

Debera cambiar el nombre de la carpeta donde descargo el proyecto para su buen funcionamiento, debera ponerle el nombre de **tienda**

![Cambiar nombre](https://user-images.githubusercontent.com/61365060/134236216-c03410a3-9672-4936-8677-722ea1405079.png)


**#3** Despues de haber descargado y pegado el proyecto en la carpeta del servidor local, vamos a crear la base de datos para nuestro proyecto y debemos hacer lo siguiente:

* Abrir phpMyAdmin en nuestro servidor local o el gestor base de datos virtual que este usando

* Crear una nueva base de datos llamada **tienda**


![Tienda base datos](https://user-images.githubusercontent.com/61365060/134234340-52ba85d2-a2bd-453c-9cb3-d6c238ecc97a.png)

* Ya creada la base de datos, importamos los datos de nuestro proyecto con el archivo llamado **tienda.sql**, este archivo esta contenido en la carpeta de nuestro proyecto llamada **DataBase**


![Importar](https://user-images.githubusercontent.com/61365060/134234363-36f148ff-6053-45f5-8159-88f1a21b12fc.png)

* Ahora ya tenemos creada nuestra base de datos con la información del proyecto

**#4** Una vez completados los pasos anteriores vamos a proceder a probar nuestro sistema en este caso es una tienda en linea:

* Para poder entrar a la tienda en linea vamos a pegar o a escribir en nuestro navegador web la siguiente url: **localhost/Tienda/**

* Para poder entrar en la parte administrativa de la tienda en liena vamos a pegar o a escribir en nuestro navegador web la siguiente url: **localhost/tienda/admin**

  Para poder ingresar en la parte administrativa se usara el siguiente Usuario y contraseña
  
  **Usuario:** Administrador
  
  **Contraseña:** Administravor

**#5** El sistema se subio a Github sin información, por la razon de que se puedan hacer todas las pruebas correspondientes (agregar productos, hacer pedidos, entre muchas funciones más)

Abrá una carpeta llamada **Imagenes de productos**, que estara ubicada el parte principal del los archivos del proyecto,la cual se podra usar para las pruebas correspodientes de los productos de la empresa y las demás pruebas.


## Sistema subido a un servidor web:
El sistema de la empresa Variedades tu diseño se esta usando por el momento para pruebas con clientes reales en un servidor web.

*Para poder ingresar en la parte de la **tienda en linea** (parte de clientes) la url es la siguiente: http://variedadestd.epizy.com/

*Para poder ingresar en la parte **administrativa** la url es la siguiente: http://variedadestd.epizy.com/admin

 Por el momento se usara el **usuario** Administrador y la **clave** Administrador.



 ## Recomendaciones 
Como el proyecto se trabajo por sesiones (fue lo más optimo), a la hora de abrir la parte administrativa y loguearse, asi mismo abrir en el mismo navegador al mismo tiempo la parte de la tienda 
en linea, esta se logueara por defecto con el usuario que este abierto en la parte Administrativa, por eso se dan las siguientes recomendaciones:

* No ingresar en el mismo dispositivo con cargos diferentes (en este caso en el mismo navegador).
* Solo tener una sesión activa ya sea en la parte administrativa o el parte cliente (tienda en linea)
* Solo se recomienda usar al mismo tiempo (en el mismo navegador) la parte administrativa y la tienda en linea para la tarea de visualizar los productos correctamente.
* Si probara la parte de la tienda en linea (en la parte de pedidos, de registro y login de cliente) y la parte administrativa al mismo tiempo, se recomienda usar un navegador distinto en el que probara la tienda en linea y en el que probara la parte administrativa.
 

## Video explicando el correcto funcionamiento del sistema el cual es una tienda en linea:

https://youtu.be/VK7vB91KP8M









