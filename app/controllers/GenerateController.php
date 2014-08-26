<?php

use GenSend\Validators\Interfaces\ValidatorInterface;
use GenSend\Library\Utils\String;

/**
 * Class GenerateController
 */
class GenerateController extends BaseController {

    /**
     * @var GenSend\Validators\Interfaces\ValidatorInterface
     */
    private $validator;
    /**
     * @var String
     */
    private $string;

    /**
     * @param ValidatorInterface $validator
     * @param \GenSend\Library\Utils\String $string
     */
    public function __construct(ValidatorInterface $validator, String $string) {
        $this->validator = $validator;
        $this->string = $string;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        return View::make('Generate.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function generate() {

        $this->validator->setInput(Input::all());

        if($this->validator->fails()) {
            Event::fire('generate.validationFailed', Input::all()); // fire an event and pass all input to it as someone's messed with the form!
            return Redirect::to('gen')
                ->withInput()
                ->withErrors($this->validator->messages());
        }

        // @todo - REFACTOR THIS BLOCK. UGH.
        $optionNames = array('nonSimilarLowercase', 'nonSimilarUppercase', 'standardNumbers', 'punctuation', 'similar', 'checkForRuns');
        $options = array();
        foreach($optionNames as $optionName) {
            // if an option is not set, we need to make sure we at least pass false to the string generator otherwise it'll merge with the default options there
            $options[$optionName] = (boolean)Input::get($optionName, 0);
        }

        try {
            $password = $this->string->randomString(Input::get('length'), $options);
            Event::fire('generate.created', array($password));
            Input::flash(); // flash input so the form gets the previously used values
        }
        catch(InvalidArgumentException $e)
        {
            return Redirect::to('gen')
                ->withInput()
                ->withErrors($e->getMessage());
        }

        $data = array(
            'password'        =>      $password,
            'phonetic'        =>      $this->string->toPhonetic($password)
        );
        return View::make('Generate.index')->with($data);
    }
}