<?php
namespace Opg\Refunds\Log\Writer;

use Zend\Log\Writer;
use Aws\Sns\SnsClient;

class Sns extends Writer\AbstractWriter implements Writer\WriterInterface
{

    private $snsClient = null;

    public function __construct(SnsClient $snsClient, $options = null)
    {
        parent::__construct($options);
        $this->snsClient = $snsClient;
    }

    public function doWrite(array $event)
    {

    }

}
