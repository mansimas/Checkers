<?php

namespace AppBundle\Tests\Unit\Controller;

use AppBundle\Controller\DefaultController;

class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $cont = new DefaultController();
        $result = $cont->add(12, 14);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(26, $result);
        $this->assertRegExp('/^.*sum.*1.*2.*3/', 'The sum on 1 plus 2 is 3');
    }
}