<?php


final class ControleurDocumentation
{
    public function defautAction()
    {
        Vue::montrer('Documentation/documentation');
    }

    public function frameworkAction()
    {
        Vue::montrer('Documentation/framework/autoload');
    }

}