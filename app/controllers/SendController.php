<?php

use GenSend\Validators\Interfaces\ValidatorInterface;
use GenSend\Repositories\Interfaces\SendRepositoryInterface;

/**
 * Class SendController
 */
class SendController extends BaseController {

    /**
     * @var GenSend\Validators\Interfaces\ValidatorInterface|Validator
     */
    protected $validator;

    /**
     * @var GenSend\Repositories\Interfaces\SendRepositoryInterface
     */
    protected $sendRepository;

    /**
     * @param \GenSend\Validators\Interfaces\ValidatorInterface|\Validator $validator
     * @param SendRepositoryInterface $sendRepository
     */
    public function __construct(ValidatorInterface $validator, SendRepositoryInterface $sendRepository) {

        $this->validator = $validator;
        $this->sendRepository = $sendRepository;

    }

    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        return View::make('Send.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store() {

        $this->validator->setInput(Input::all());

        if($this->validator->fails()) {
            return Redirect::to('send')
                ->withInput()
                ->withErrors($this->validator->messages());
        }

        $securesend = $this->sendRepository->create(Input::all());

        if($securesend === false) {
            return Redirect::to('send')
                ->withInput()
                ->withErrors('There was a problem storing your password for sending.');
        }
        
        $data = array(
            'url'      =>      $securesend->getUrl()
        );
        return View::make('Send.stored')->with($data);
    }

    /**
     * @param $urlPart
     * @return \Illuminate\View\View
     */
    public function view($urlPart) {

        $setAsViewed = true; // used to determine whether the repository should decrease the views on the item
        $securesend = $this->sendRepository->getByUrl($urlPart);
        $this->sendRepository->setAsViewed($securesend->id);

        $password = $securesend->pass;

        $data = array(
            'password'      =>      $password
        );

        return View::make('Send.view')->with($data);
    }
}