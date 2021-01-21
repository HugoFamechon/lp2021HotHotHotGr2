<?php


final class ControleurDocumentation
{
    public function defautAction()
    {
        Vue::montrer('Documentation/documentation');
    }

    public function frameworkAction(array $A_get_parametres = null, array $A_post_parametres = null)
    {
        if ($A_get_parametres[0]=='ChargementAuto') {
            $this->frameworkAutoload();
        } 
        if($A_get_parametres[0]=='Constantes') {
            $this->frameworkConstantes(); 
        } 
        if($A_get_parametres[0]=='Controleur') {
            $this->frameworkControleur(); 
        } 
        if($A_get_parametres[0]=='Vue') {
            $this->frameworkVue(); 
        }        
    }

    public function frameworkAutoload()
    {
        Vue::montrer('Documentation/framework/autoload');
    }

    public function frameworkConstantes()
    {
        Vue::montrer('Documentation/framework/constantes');
    }

    public function frameworkControleur()
    {
        Vue::montrer('Documentation/framework/controleur');
    }

    public function frameworkVue()
    {
        Vue::montrer('Documentation/framework/vue');
    }

}