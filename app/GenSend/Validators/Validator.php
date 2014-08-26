<?php namespace GenSend\Validators;

use GenSend\Validators\Interfaces\ValidatorInterface;

/**
 * Class Validator
 * @package GenSend\Validators
 */
abstract class Validator implements ValidatorInterface {

    /**
     * @var
     */
    protected $input;

    /**
     * @var \Illuminate\Support\MessageBag  Holds the messages from the validation object if validation fails.
     */
    public $messages;
    /**
     * @var
     */
    public static $rules;

    /**
     *
     */
    public function __construct()
    {
        
    }

    /**
     * @param $input
     * @return mixed|void
     */
    public function setInput($input) {
        $this->input = $input;
    }

    /**
     * @return mixed
     */
    public function getInput() {
        return $this->input;
    }

    /**
     * @return bool
     */
    public function fails()
    {
        $validation = \Validator::make($this->input, static::$rules);

        if ($validation->fails())
        {
            $this->messages = $validation->messages();
            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Support\MessageBag
     */
    public function messages()
    {
        return $this->messages;
    }
}
