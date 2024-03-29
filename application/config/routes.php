<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'App';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login/(:any)/(:num)'] = 'App/index';
$route['logout'] = 'App/logout';
$route['exit'] = 'App/salida';
$route['registro'] = 'App/registro';
$route['nuevo_usuario'] = 'App/nuevo';
$route['recuperar_contrasena/(:any)'] = 'App/recuperar';
$route['buscar_correo'] = 'App/enviar_correo_recuperacion';
$route['actualizar_contrasena/(:any)/(:any)/(:any)/(:any)'] = 'App/actualizar';
$route['nueva_contrasena'] = 'App/nueva';

/*Productos*/
$route['productos'] = 'Productos/index';
$route['producto_nuevo'] = 'Productos/nuevo';
$route['registrar_producto'] = 'Productos/registro';
$route['actualizar_producto'] = 'Productos/actualizar';
$route['productos_quitar/(:any)']	= 'Productos/eliminar';
$route['productos_editar/(:any)/(:any)']	= 'Productos/editar';
$route['productos_registrados'] = 'Productos/registrados';
$route['producto_descripcion'] = 'Productos/descripcion';
$route['productos_grupos']	= 'Productos/grupos';
$route['productos_grupos_nuevo']	= 'Productos/grupo_nuevo';
$route['productos_grupos_quitar/(:any)']	= 'Productos/grupo_eliminar';
$route['productos_imagenes/(:any)/(:any)']	= 'Productos/nueva_imagen';
$route['eliminar_imagenes/(:any)/(:any)']	= 'Productos/eliminar_imagen';
$route['productos_grupos_editar/(:any)/(:any)']	= 'Productos/grupo_editar';
$route['producto_grafica_maximize/(:any)/(:any)/(:any)']	= 'Productos/grafica_maximize';
$route['producto_grafica_maximize_nrf/(:any)/(:any)']	= 'Productos/grafica_maximize_nrf';
$route['producto_grafica_maximize_others/(:any)/(:any)']	= 'Productos/grafica_maximize_others';
$route['productos_informacion/(:any)']	= 'Productos/informacion';

/*$route['productos_reformulation'] = 'Productos/reformulation';
$route['productos_reform_editar/(:any)/(:any)'] = 'Productos/editar_reform';
$route['grupos_reform'] = 'Productos/grupo_reform_view';
$route['registrar_reform'] = 'Productos/registro_reform';*/

/*Reportes*/
$route['reportes'] = 'Reportes/index';
$route['reporte_grupos'] = 'Reportes/grupos';
$route['reporte_tipos'] = 'Reportes/tipos';

/*Administración*/
$route['usuarios'] = 'Administrador/index';
$route['usuarios/(:num)'] = 'Administrador/index';
$route['permisos_usuarios'] = 'Administrador/permisos';
$route['usuarios_editar/(:any)/(:num)'] = 'Administrador/usuario_editar';
$route['usuarios_eliminar/(:any)'] = 'Administrador/usuario_eliminar';
$route['usuarios_guardar_editar'] = 'Administrador/usuario_guardar_editar';
$route['usuarios_as'] = 'Administrador/actualizar_subpermisos';
$route['usuarios_ab'] = 'Administrador/actualizar_labs';
$route['usuarios_al'] = 'Administrador/actualizar_labels';
$route['usuarios_ai'] = 'Administrador/actualizar_index';
$route['usuarios_nuevo'] = 'Administrador/usuario_nuevo';
$route['usuarios_guardar_nuevo'] = 'Administrador/usuario_guardar_nuevo';

/*Home*/
$route['inicio'] = 'Home';

/*Sellos*/
$route['sellos'] = 'Sellos/quitar';
$route['sellos_formulas'] = 'Sellos/formulas';

/*Optimización*/
$route['optimizacion']	= 'Optimizacion/index';
$route['agregar_token'] = 'Optimizacion/agregar';
$route['guardar_token'] = 'Optimizacion/guardar';
$route['nom051'] = 'Optimizacion/nom051';
$route['nutriscore'] = 'Optimizacion/nutriscore';
$route['nutriscore/(:any)'] = 'Optimizacion/nutriscore';
//$route['nom051_formulas'] = 'Optimizacion/nom051Formulas';
$route['nom051_formulas'] = 'Optimizacion/nom051Formulas_ver2';
$route['crear_token'] = 'Optimizacion/token';
$route['recuperar_token/(:any)'] = 'Optimizacion/getToken';
$route['borrar_token/(:any)'] = 'Optimizacion/deleteToken';
$route['optimizar'] = 'Optimizacion/optimizar';

/*Reformulación*/
$route['reformulacion'] 			= 'Reformulacion/index';
$route['productos_reformulation'] 	= 'Reformulacion/reformulation';
$route['productos_reform_editar/(:any)/(:any)'] = 'Reformulacion/editar_reform';
$route['grupos_reform/(:any)'] 			= 'Reformulacion/grupos_reform';
$route['registrar_reform'] 			= 'Reformulacion/registro_reform';