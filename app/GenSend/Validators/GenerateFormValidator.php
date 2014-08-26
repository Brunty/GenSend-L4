<?php namespace GenSend\Validators;

/**
 * Class GenerateFormValidator
 * @package GenSend\Validators
 */
/**
 * Class GenerateFormValidator
 * @package GenSend\Validators
 */
class GenerateFormValidator extends Validator {

    /**
     * @var array
     */
    public static $rules = array(
        'length'      =>     'required|min:4|max:99|integer'
    );
}
