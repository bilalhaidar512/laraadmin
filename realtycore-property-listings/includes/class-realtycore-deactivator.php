<?php
class RealtyCore_Deactivator
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
