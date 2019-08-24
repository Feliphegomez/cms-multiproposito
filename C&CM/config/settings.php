<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

//Configuration ============================
define("CONTROLADOR_DEFECTO", "Nodos"); // Controlador por defecto
define("ACCION_DEFECTO", "index"); // Action/Accion por defecto
define("MASCARA_DEFECTO", "complete"); // Layout/Plantilla por defecto

//Configuration ============================
define("ENABLED_DEBUG", true); // Habilita los errores PHP
define("LOGIN_REQ", false); // Habilita el login obligatorio para todos los usuarios
define("THEME_DEFAULT", "generic"); // Tema por defecto
define("ADMIN_PREFIX", "admin"); // Prefijo para admin

// Valores predeterminador
define("TITLE_LG", "CMS & CRM MULTI-PROPOSITO - Developer by FelipheGomez"); // Titulo completo
define("TITLE_MD", "CMS Y CRM MULTI-PROPOSITO");
define("TITLE_SM", "C&C MULTI");
define("TITLE_XS", "C&CM");
define("ICON_DEFAUL", "fa fa-leaf");
define("IMAGE_DEFAULT", "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBggGEBUIBw8SERAPDRAPDRANEBAODxEPExAVIBMQEhgXGyYeGCUkGRITHy8iJCcpLywsFh8xNTA2NSYrLCkBCQoKBQUFDQUFDSkYEhgpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKSkpKf/AABEIAMIBAwMBIgACEQEDEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAABQYCAwQBB//EADcQAQACAQIDAgwFAwUAAAAAAAABAhEDBAUhMUFxBhIyUWFzgaGxssHREyJSkaJCY5IVQ2Jygv/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwD7UAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4/wDVtr434cWmZjOZiJxy6zl2KhpTzn/pf5JBM7njmnaMbW2LZ5zetsY9GMo/V4zurWm2neYjsjEYxHoR+TILTtuK7bWrFr3rW0x+aszjE9rorutC3k3pPdev3U7JkF1i0T0n9nuJUmJx0Z119Wvk2tHdaYBcxUK8Q3Vempf/ACltrxfe1/3J9sVn6AtQrNeO72v9UT31hN8L3lt9p/iXiImLTWcdJxjn7wdYAAAAAAAAAAAAAAAAAAAAACnaM859Xf5JXFTNCec+rv8AJINWTLHJkGWXXsuG629/NHKv6p+jm2+n+NaKz07e6OxbNLTjRiKR2dcecENbhW2pynUtM/8AGsTDRq8MnrtrRfHWuJrf9u32J7V0KavXr54cGtozScTymOcTHxBBZMu7ielFojdVjEzM01Mfr7Le2Pgj8gyys3g/GNHPnvb6fZV8rVwGMaFe+8/ykEgAAAAAAAAAAAAAAAAAAAAAApO3nnPq9T5JXZR9vPOfV6nySDXkyxyZB18OvFdSJn0T+0xM+6JWueSlU1J05i1esTlauHbum9pFqTzrGLR2x6QdbRu6RevjdsfBteWjxomPROZnpHpkERvsV0LTPbq0x345+5C5d3Ft9TXmNDQnNKZ5/qvPWyPyDLK3cFjGhT0xM/ylT8rnwmMaGnH9uPfMg6wAAAAAAAAAAAAAAAAAAAAAFE20859XqfJK9qNTQ1NDUto6kTFvE1IxPbPiWxjzg58mWOWVdO9/IrM90TPwAyy09a+jPj6czWY6TWcS204fvNTyNK8/+LfZurwPiN+mlb2zWvxkGynhBvacptFvTalZlo3XE91vPy615x+mMVr+0Omng3xC3WKx33j6N1fBXdT5V6R/lP0BDZMp+ngnb+vWj2U+8t1PBTQjy9S890VgFayvPDo8XR04/tU+WHDTwZ2NedvHt325e6ISsRFeVeURGIiPMD0AAAAAAAAAAAAAAAAAAAAAB5NYt1jp0y9AYRo6Veda1jurEMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB/9k=");

// SolveMedia Capcha
define("SM_KEY_PUBLIC", "J0Myui2rYs-6Ww2Y6dx4bn47Mn6-nX4u");
define("SM_KEY_PRIVATE", "oU6nzE4Rx9HPdI3ut6Oaq.osFkwTTS0i");
define("SM_HASH", "CZXAq6rL6iFTZIAzodbm.c6U6lkXBiKr");

/* *******************************
 * Activar errores
 * *******************************/
if(ENABLED_DEBUG == true){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

//Más constantes de configuración
$thisFile = (__FILE__);
$thisFileDirname = dirname($thisFile);
define('folder_home', dirname($thisFileDirname, 2));
define('folder_data', folder_home . "/C&CM");
define('folder_admin', folder_data . "/admin");
define('folder_public', folder_data . '/public');

require_once 'tables.php';

