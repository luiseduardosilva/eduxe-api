<?php

namespace App\Rules;

use App\Enums\DiscagemDiretaADistancia;
use Illuminate\Contracts\Validation\Rule;
use App\Shared\Utils;

class Telefone implements Rule
{

    private $message;

    protected $utils;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $utils      = new Utils();
        $telefone   = $utils->onlyNumbers($value);
        $ddd        = substr($telefone, 0,2);

        if(!in_array(strlen($telefone), [10, 11])){
            $this->setMessage('Tamanho do telefone não é valido');
            return false;
        }

        if(!in_array($ddd, DiscagemDiretaADistancia::DDD)){
            $this->setMessage('DDD não é valido');
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->getMessage();
    }


    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }
}
