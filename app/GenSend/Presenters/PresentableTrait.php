<?php namespace GenSend\Presenters;

use GenSend\Presenters\Exceptions\PresenterException;

/**
 * Usage: in a model, simply:
 * use GenSend\Presenters\PresentableTrait
 * 
 * class SomeClass extends \Eloquent implements PresentableInterface {
 *      use PresentableTrait;
 *      
 *      protected $presenter = 'GenSend\Presenters\Post'; // as an example, set to path of presenter for your model
 * }
 * 
 * Once this is done, in a view you can simply use: $entity->present()->property
 */
trait PresentableTrait {

    protected static $presenterInstance;

    /**
     * @throws Exceptions\PresenterException
     * @return mixed
     */
    public function present()
    {
        if ( ! $this->presenter or ! class_exists($this->presenter))
        {
            throw new PresenterException('Please set the $protected property to your presenter path.');
        }

        if ( ! isset(static::$presenterInstance))
        {
            static::$presenterInstance = new $this->presenter($this);
        }

        return static::$presenterInstance;
    }
}