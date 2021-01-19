<?php


final class ControleurDocumentation
{
    public function defautAction()
    {
        Vue::montrer('Documentation/documentation');
    }

    public function frameworkAction(array $A_get_parametres = null, array $A_post_parametres = null)
    {
        var_dump($A_post_parametres);
        Vue::montrer('Documentation/framework/autoload');
    }

}