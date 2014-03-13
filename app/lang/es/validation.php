<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"         => "El campo :attribute tiene que ser aceptado.",
	"active_url"       => "El campo :attribute no es una URL válida.",
	"after"            => "El campo :attribute tiene que ser una fecha posterior a :date.",
	"alpha"            => "El campo :attribute solo puede contener letras.",
	"alpha_dash"       => "El campo :attribute solo puede contener letras, números y guiones.",
	"alpha_num"        => "El campo :attribute solo puede contener letras y números.",
	"array"            => "El campo :attribute tiene que ser un array.",
	"before"           => "El campo :attribute tiene que ser una fecha anterior a :date.",
	"between"          => array(
		"numeric" => "El campo :attribute tiene que estar entre :min y :max.",
		"file"    => "El campo :attribute tiene que tener entre :min y :max kilobytes.",
		"string"  => "El campo :attribute tiene que tener entre :min y :max caracteres.",
		"array"   => "El campo :attribute tiene que tener entre :min y :max items.",
	),
	"confirmed"        => "El campo :attribute de confirmación no coincide.",
	"date"             => "El campo :attribute no es una fecha válida.",
	"date_format"      => "El campo :attribute no coincide con el formato :format.",
	"different"        => "El campo :attribute y :other tienen que ser diferentes.",
	"digits"           => "El campo :attribute tiene que tener :digits digitos.",
	"digits_between"   => "El campo :attribute tiene que tener entre :min y :max digitos.",
	"email"            => "El formato del campo :attribute no es válido.",
	"exists"           => "El campo seleccionado :attribute no es válido.",
	"image"            => "El campo :attribute tiene que ser una imagen.",
	"in"               => "El campo seleccionado :attribute no es válido.",
	"integer"          => "El campo :attribute tiene que ser un número entero.",
	"ip"               => "El campo :attribute tiene que ser una dirección IP válida.",
	"max"              => array(
		"numeric" => "El campo :attribute no puede ser mayor que :max.",
		"file"    => "El campo :attribute no puede ser mayor de :max kilobytes.",
		"string"  => "El campo :attribute no puede tener más de :max caracteres.",
		"array"   => "El campo :attribute no puede tener más de :max items.",
	),
	"mimes"            => "El campo :attribute tiene que ser un archivo de type: :values.",
	"min"              => array(
		"numeric" => "El campo :attribute tiene que tener al menos :min.",
		"file"    => "El campo :attribute tiene que tener al menos :min kilobytes.",
		"string"  => "El campo :attribute tiene que tener al menos :min caracteres.",
		"array"   => "El campo :attribute tiene que tener al menos :min items.",
	),
	"not_in"           => "El campo seleccionado :attribute no es válido.",
	"numeric"          => "El campo :attribute tiene que ser numérico.",
	"regex"            => "El campo :attribute no tiene un formato válido.",
	"required"         => "El campo :attribute es obligatorio.",
	"required_if"      => "El campo :attribute es obligatorio cuando :other es :value.",
	"required_with"    => "El campo :attribute es obligatorio cuando existe :values.",
	"required_without" => "El campo :attribute es obligatorio cuando :values no existe.",
	"same"             => "Los campos :attribute y :other tienen que coincidir.",
	"size"             => array(
		"numeric" => "El tamaño del campo :attribute tiene que ser :size.",
		"file"    => "El tamaño del campo :attribute tiene que tener :size kilobytes.",
		"string"  => "El tamaño del campo :attribute tiene que tener :size caracteres.",
		"array"   => "El tamaño del campo :attribute tiene que contener :size items.",
	),
	"unique"           => "El campo :attribute ya esta en uso.",
	"url"              => "El campo :attribute no tiene un formato válido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
