<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/8/25
 * Time: 10:35
 */

namespace App\Exceptions;


class ValidateException extends \Exception
{


    /**
     * ValidateException constructor.
     */
    public function __construct($message, $code)
    {
        parent::__construct($message,$code);
    }



}