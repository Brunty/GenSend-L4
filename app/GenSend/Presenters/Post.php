<?php namespace GenSend\Presenters;

/**
 * Class Post
 * @package GenSend\Presenters
 */
class Post extends Presenter {
    
    /**
     * @return string
     */
    public function title()
    {
        return ucwords($this->entity->title);
    }
}