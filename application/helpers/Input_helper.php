<?php
/**
 * Clase que crea inputs
 */
class Input
{
    private $name;
    
    function __construct()
    {
        $name = '';
    }

    function Select($atributos, $opciones, $indice, $etiqueta, $seleccionado){
        $input = "<select ";
        foreach ($atributos as $atributo => $valor) {
            $input .= " $atributo=\"$valor\" ";
        }
        $input .= ">";
        $input .= "<option value=\"\">-Seleccione-</option>";
        if ($opciones!=false) {
            foreach ($opciones->result_array() as $opcion) {
                $selected = "";
                if ($opcion["$indice"] == $seleccionado) {
                    $selected = "selected=\"selected\"";
                }
                $input .= "<option $selected value=\"".$opcion["$indice"]."\">".$opcion["$etiqueta"]."</option>";
            }
        }
        $input .= "</select>";
        return $input;
    }

    function Text($atributos, $type){
        $input = "<input type=\"$type\" ";
        foreach ($atributos as $atributo => $valor) {
            $input .= " $atributo=\"$valor\" ";
        }
        $input .= ">";
        return $input;
    }

    function Textarea($atributos, $texto){
        $input = "<textarea ";
        foreach ($atributos as $atributo => $valor) {
            $input .= " $atributo=\"$valor\" ";
        }
        $input .= ">$texto</textarea>";
        return $input;
    }

}