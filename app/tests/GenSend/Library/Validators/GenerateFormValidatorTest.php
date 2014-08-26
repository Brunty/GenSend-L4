<?php

use \GenSend\Validators\GenerateFormValidator as PasswordFormValidator;

class GenerateFormValidatorTest extends \TestCase {

    public function testSetInput()
    {
        $validator = new PasswordFormValidator;
        $input = array('foo'    =>  'bar');
        $validator->setInput($input);
        $this->assertEquals($input, $validator->getInput());
    }

    public function testValidatorPasses()
    {
        $validator = new PasswordFormValidator;
        $input = array('length'    =>  4);
        $validator->setInput($input);
        $this->assertFalse($validator->fails());

        $validator = new PasswordFormValidator;
        $input = array('length'    =>  5);
        $validator->setInput($input);
        $this->assertFalse($validator->fails());

        $validator = new PasswordFormValidator;
        $input = array('length'    =>  26);
        $validator->setInput($input);
        $this->assertFalse($validator->fails());

        $validator = new PasswordFormValidator;
        $input = array('length'    =>  98);
        $validator->setInput($input);
        $this->assertFalse($validator->fails());

        $validator = new PasswordFormValidator;
        $input = array('length'    =>  99);
        $validator->setInput($input);
        $this->assertFalse($validator->fails());

    }
    public function testValidatorFails()
    {
        $validator = new PasswordFormValidator;
        $input = array('length'    =>  'bar');
        $validator->setInput($input);
        $this->assertTrue($validator->fails());

        $validator = new PasswordFormValidator;
        $input = array('length'    =>  1);
        $validator->setInput($input);
        $this->assertTrue($validator->fails());
        
        $validator = new PasswordFormValidator;
        $input = array('length'    =>  3);
        $validator->setInput($input);
        $this->assertTrue($validator->fails());
        
        $validator = new PasswordFormValidator;
        $input = array('length'    =>  100);
        $validator->setInput($input);
        $this->assertTrue($validator->fails());
        
        $validator = new PasswordFormValidator;
        $input = array('length'    =>  500);
        $validator->setInput($input);
        $this->assertTrue($validator->fails());

        $validator = new PasswordFormValidator;
        $input = array();
        $validator->setInput($input);
        $this->assertTrue($validator->fails());
    }

    public function testMessages() {
        $validator = new PasswordFormValidator;
        $input = array();
        $validator->setInput($input);
        $validator->fails($input);
        $this->assertTrue($validator->messages() instanceof \Illuminate\Support\MessageBag);
    }
}