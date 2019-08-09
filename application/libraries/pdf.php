<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf
{
    function __construct()
    {
        include_once dirname(__FILE__) . '/fpdf/fpdf.php';
    }
}
