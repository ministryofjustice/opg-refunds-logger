<?php
namespace Opg\Refunds\Log\Factory;

use Opg\Refunds\Log\Logger;

use Zend\Log\Formatter\Simple as SimpleFormatter;
use Zend\Log\Writer\Stream as StreamWriter;

use Interop\Container\ContainerInterface;

class LoggerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $logger = new Logger;

        //---

        $writer = new StreamWriter('php://stderr');

        $writer->setFormatter(new SimpleFormatter([
            'format' => SimpleFormatter::DEFAULT_FORMAT,
            'dateTimeFormat' => 'Y-m-d\TH:i:s.u\Z',
        ]));

        $logger->addWriter($writer);

        //---

        return $logger;
    }
}
