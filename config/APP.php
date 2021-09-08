<?php

	/*----------  
	Ruta o dominio del servidor  
	----------*/
	const SERVERURL="http://localhost/Tienda/";


	/*----------  
	Nombre de la empresa o compañia 
	----------*/
	const COMPANY= "Variedades TD";


	/*----------  Idioma - Language
	Español -> es 
	----------*/
	const LANG="es";

	
	/*----------  
		Palabra clave dashboard - 

	----------*/
	const DASHBOARD="admin";


	/*----------  
	Nombre de la sesion 
	----------*/
	const SESSION_NAME="STO";


	/*----------  Redes sociales  ----------*/
	const FACEBOOK="https://m.facebook.com/tudisenovariedades";
	const INSTAGRAM="";
	const YOUTUBE="https://www.youtube.com/channel/UCQMSS6rl5fa6DCl937FBjjA/videos";
	const TWITTER="";


	/*----------  Direccion  ----------*/
	const COUNTRY="Morazán El Progreso";
	const ADDRESS="Aldea Marajuma, Morazan , EL Progreso";
	

	/*----------  Configuración de moneda  ----------*/
	const COIN_SYMBOL="Q";
	const COIN_NAME="GT";
	const COIN_DECIMALS="2";
	const COIN_SEPARATOR_THOUSAND=",";
	const COIN_SEPARATOR_DECIMAL=".";


	/*----------  Tipos de documentos  ----------*/
	const DOCUMENTS_USERS=["DNI","Cedula","DUI","Licencia","Pasaporte","Otro"];
	const DOCUMENTS_COMPANY=["DNI","Cedula","RUT","NIT","RUC","Otro"];


	/*----------  Tipos de unidades de productos  ----------*/
	const PRODUTS_UNITS=["Unidad","Libra","Kilogramo","Caja","Paquete","Lata","Galon","Botella","Tira","Sobre","Bolsa","Saco","Tarjeta","Otro"];

	/*----------  Límite de tamaño de imágenes de productos en MB  ----------*/
	const COVER_PRODUCT=3;
	const GALLERY_PRODUCT=7;


	/*----------  Marcador de campos obligatorios  ----------*/
	const FIELD_OBLIGATORY='&nbsp; <i class="fab fa-font-awesome-alt"></i> &nbsp;';


	/*----------  Configuración de codigos de barras 

	
	----------*/

	const BARCODE_FORMAT="CODE128";
	const BARCODE_TEXT_ALIGN="center";
	const BARCODE_TEXT_POSITION="bottom";


	/*----------  Tamaño de papel de impresora termica (en milimetros) 
	----------*/
	const THERMAL_PRINT_SIZE="80";


	/*----------  Zona horaria - Time zone  ----------*/
	date_default_timezone_set("America/Guatemala");

