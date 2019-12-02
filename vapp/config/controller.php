<?php
class Controller
{
    var $vars = [];
    var $layout = "default";

    public static function renderView($action,$controller)
    {
        $isvbuilder='';
        if(verifyIfVbuilderResource($controller)){
            $isvbuilder= "_vbuilder_resources/";
        }
        require(ROOT.'view/'.$isvbuilder.$controller.'/'.$action.'.php');

    }

    private function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function secure_form($form)
    {
        foreach ($form as $key => $value)
        {
            $form[$key] = $this->secure_input($value);
        }
    }

    public static function renderSvg($file){

        $svg_file = file_get_contents($file);

        $find_string   = '<svg';
        $position = strpos($svg_file, $find_string);

        $svg_file_new = substr($svg_file, $position);
        echo $svg_file_new;
    }
    public static function renderGetSvg($file){

        $svg_file = file_get_contents($file);

        $find_string   = '<svg';
        $position = strpos($svg_file, $find_string);

        $svg_file_new = substr($svg_file, $position);
        return $svg_file_new;
    }


}
?>