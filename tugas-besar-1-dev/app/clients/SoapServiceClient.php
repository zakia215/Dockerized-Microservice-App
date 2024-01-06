<?php
class SoapServiceClient
{
    private $wsdl;
    private $soapServiceClient;
    private static $instance;

    public function __construct($wsdl) {
        $this->wsdl = $wsdl;

        $options = array(
            'cache_wsdl' => 0,
            'connection_timeout' => 15,
            'trace' => true,
            'encoding' => 'UTF-8',
            'exceptions' => 0,
            'stream_context' => stream_context_create(array(
                'http' => array(
                    'header' => 'api-key: ' . $_ENV['SOAP_API_KEY'],
                ),
            )),
        );

        $this->soapServiceClient = new SoapClient($this->wsdl, $options);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static($_ENV['WSDL_URL']);
        }
        return self::$instance;
    }

    public function call($function, $params) {
        if (!isset($params)) {
            $response = $this->soapServiceClient->$function();
        } else {
            $formattedParams = $this->buildParams($params);
            $response = $this->soapServiceClient->$function($formattedParams);
        }
        return $response;
    }

    private function buildParams($params) {
        $formattedParams = new stdClass();
        $count = 0;
        $arg = 'arg';
        foreach ($params as $_ => $value) {
            $arg_name = $arg . $count;
            $formattedParams->$arg_name = $value;
            $count++;
        }

        return $formattedParams;
    }
}
