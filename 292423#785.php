<?php
class StubTest extends PHPUnit_Framework_TestCase
{
    public function testReturnCallbackStub()
    {
        $stub = $this->getMock(
          'SomeClass', array('doSomething')
        );

        $stub->expects($this->any())
             ->method('doSomething')
             ->will($this->returnCallback('callback'));

        // $stub->doSomething() returns callback(...)
    }
}

function callback() {
    $args = func_get_args();
    // ...
}
?>
