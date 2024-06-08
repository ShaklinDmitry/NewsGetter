<?php

namespace App\Modules\NewsGetter\Infrastructure\Bus;

use App\Modules\NewsGetter\Infrastructure\DTOs\NewsDTO;
use Illuminate\Support\Facades\Log;
use RdKafka\Conf;
use RdKafka\Message;
use RdKafka\Producer;

class Bus implements BusInterface
{

    /**
     * @param array $messages
     * @return mixed|void
     * @throws \RdKafka\Exception
     */
    public function sendMessage(array $messages)
    {

    //    dd($messages);

        $conf = new Conf();
        $conf->set('metadata.broker.list', 'kafka:29092');
    //    $conf->set('enable.ssl.certificate.verification', 'false');
        $conf->set('enable.idempotence', 'true');

        $conf->setDrMsgCb(function ($kafka, $message) {
            if ($message->err) {
                Log::debug('error');
            } else {
                //TODO Добавить сюда сохранение в БД факта что отправка в кафку произошла удачно
                Log::debug('message sended');
                Log::debug(preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
                }, $message->payload));
                Log::debug($message->topic_name);
            }
        });
        $producer = new Producer($conf);

        $topic = $producer->newTopic("news");

        for ($i = 0; $i < count($messages); $i++) {
            $message = $messages[$i];

            $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode($message));
            $producer->poll(5);
        }

        for ($flushRetries = 0; $flushRetries < 10; $flushRetries++) {
            $result = $producer->flush(10000);
            if (RD_KAFKA_RESP_ERR_NO_ERROR === $result) {
                break;
            }
        }

        if (RD_KAFKA_RESP_ERR_NO_ERROR !== $result) {
            throw new \RuntimeException('Was unable to flush, messages might be lost!');
        }

    }
}
