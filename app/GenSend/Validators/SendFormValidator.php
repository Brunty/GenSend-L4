<?php namespace GenSend\Validators;

/**
 * Class SendFormValidator
 * @package GenSend\Validators
 */
/**
 * Class SendFormValidator
 * @package GenSend\Validators
 */
class SendFormValidator extends Validator {

    /**
     * @var array
     */
    public static $rules = array(
        'password'      =>      'required|max:255',
        'views'         =>      'required|min:1|max:90|integer',
        'days'          =>      'required|min:1|max:90|integer',
    );
}
