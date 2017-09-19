<?php
namespace Opg\Refunds\Log\Formatter;

use Zend\Log\Formatter;

class Logstash extends Formatter\Base implements Formatter\FormatterInterface
{
    /**
     * Formats data to be written by the writer.
     *
     * @param array $event event data
     * @return array
     */
    public function format($event)
    {
        $event = array_merge($event, [
            '@version' => 1,
            'host' => isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'Unknown',
            'uri' => isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'Unknown',
        ]);

        if (isset($event['timestamp'])) {
            if ($event['timestamp'] instanceof \DateTime) {
                $event['timestamp'] = $event['timestamp']->format($this->getDateTimeFormat());
            }

            $event['@timestamp'] = $event['timestamp'];
            unset($event['timestamp']);
        }

        return @json_encode($event, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }
}
