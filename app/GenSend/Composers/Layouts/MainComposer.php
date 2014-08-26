<?php namespace GenSend\Composers\Layouts;

use GenSend\Composers\Composer;
use Request;

class MainComposer extends Composer {

    public function compose($view) {
        
        // basically an array holding the menu structure of the site, the key is the URL segment
        // currently it's just a 1 level thing, but it could be extended to be more.
        $siteSections = array(
            // 'url-slug'       =>      'Menu Name',
            'gen'               =>      'Generate',
            'send'              =>      'Send'
            );
        $data = array(
            'menuItems'         =>   $siteSections,
            'activeUrl'         =>   Request::segment(1)
            );

        $view->with($data);
    }
}