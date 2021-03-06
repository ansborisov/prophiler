<?php
/**
 * @author Fabian Fuelling <fabian@fabfuel.de>
 * @created: 14.11.14 12:08
 */

namespace Fabfuel\Prophiler\Adapter\Fabfuel;

class MongoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Fabfuel\Prophiler\Adapter\Fabfuel\Mongo::__construct
     * @covers Fabfuel\Prophiler\Adapter\Fabfuel\Mongo::start
     * @covers Fabfuel\Prophiler\Adapter\Fabfuel\Mongo::stop
     * @uses Fabfuel\Prophiler\Adapter\AdapterAbstract
     */
    public function testConstruct()
    {
        $name = 'foobar';
        $metadata = ['lorem' => 'ipsum'];
        $token = 'abcdefgh';

        $profiler = $this->getMockBuilder('Fabfuel\Prophiler\Profiler')
            ->disableOriginalConstructor()
            ->getMock();

        $profiler->expects($this->once())
            ->method('start')
            ->with($name, $metadata, 'MongoDB')
            ->will($this->returnValue($token));

        $profiler->expects($this->once())
            ->method('stop')
            ->with($token);

        $adapter = new Mongo($profiler);

        $benchmarkToken = $adapter->start($name, $metadata);
        $this->assertSame($benchmarkToken, $token);

        $adapter->stop($token);
    }
}
