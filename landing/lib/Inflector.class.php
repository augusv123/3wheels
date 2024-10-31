<?php
/**
 * Versi�n compatible con PHP 4
 * @author Daniel Wyrytowski <dandanielw@gmail.com>
 *
 */
class Inflector
{
	/**
	 * Toma un string de palabras separadas por guiones bajos (underscore), convierte la primera letra de cada palabra en mayúscula y las demás 
	 * en minúsculas. Si se pasa el parámetro $no_underscore = true, también elimina los guiones bajos, por defecto, no se eliminan.
	 * 
	 * Por ej:  
	 * 		echo Inflector::camelize('tabla_ejemPLO'); // Imprimiría: Tabla_Ejemplo
	 * 
	 * 		echo Inflector::camelize('tabla_ejemPLO', true); // Imprimiría: TablaEjemplo 
	 * 
	 * @param string $string
	 * @param bool $no_underscore
	 */
	function camelize($string, $no_underscore = false)
	{
		$string = ucwords( str_replace('_', ' ', strtolower($string)) );

		if ($no_underscore) $string = str_replace(' ', '', $string);
		else 				$string = str_replace(' ', '_', $string);

		return $string; 
	}

	function humanize($string, $ucwords = true)
	{
		$string = strtolower( str_replace('_', ' ', $string));
		$string = strtolower( str_replace('-', ' ', $string));
		
		if ( $ucwords) $string = ucwords($string);
		else $string = ucfirst($string);

		return $string; 
	}
}