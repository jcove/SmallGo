<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2019/6/27
 * Time: 10:22
 */

namespace App;


use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class RestResponse implements   Jsonable, JsonSerializable
{
    private $msg;
    private $code;
    private $data;
    private $ext;

    /**
     * RestResponse constructor.
     * @param $msg
     * @param $code
     * @param $data
     */
    public function __construct($data,$code=0,$msg='success')
    {
        $this->msg = $msg;
        $this->code = $code;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param mixed $ext
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
    }



    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'msg'       => $this->msg,
            'code'      =>  $this->code,
            'data'      =>  $this->data
        ];
    }

    public static function data($data){
        return new RestResponse($data);
    }

}