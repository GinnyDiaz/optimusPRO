# optimusPRO
Repositorio del código fuente del Sistema OptimusPRO, elaborado para el curso de Metodologías de Desarrollo Ágil - UGR

CONFIGURACIÓN INICIAL: 

BASE DE DATOS:
-------------------
El sistema hace uso del gestor de base de datos MySQL, y hay que importar el archivo BD - procesos.sql ubicado en .\BD-Sprint2\

SISTEMA:
-----------
Para poder acceder al sistema, se debe configurar la ruta y el puerto del servidor. Hay dos archivos donde se debe realizar esta acción: 

	1. 	.\Código fuente\processManagement\application\config\config.php - Línea 26
		La variable $config['base_url'] almacena almacena la ruta para acceder al código fuente y del primer archivo de 		donde se inicializa la aplicación. 

		$config['base_url']  =  'http://localhost[:puerto]/[carpeta_código_fuente]/index.php/';


	2 .	.\Código fuente\processManagement\application\config\constants.php - Línea 88
		La variable $config['base_url'] almacena almacena solo la ruta para acceder al código fuente. 
	
		define('PROJECT_NAME', 'http://localhost[:puerto]/[carpeta_código_fuente]/' );
	
		
