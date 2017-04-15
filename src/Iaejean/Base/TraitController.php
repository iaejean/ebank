<?php
namespace Iaejean\Base;

use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\Serializer;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;

/**
 * Trait TraitController
 * @package Iaejean\Base
 */
trait TraitController
{
    /**
     * @var LoggerInterface
     * @DI\Inject("logger")
     */
    public $logger;
    /**
     * @var Serializer
     * @DI\Inject("jms_serializer")
     */
    protected $serializer;
    /**
     * @var Translator
     * @DI\Inject("translator")
     */
    protected $translator;

    /**
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    private function jsonResponse($data, int $code = 200): JsonResponse
    {
        if (is_string($data)) {
            $data = json_decode($data);
        }

        if (is_array($data) || $data instanceof \stdClass || is_scalar($data)) {
            $options = 0;
            /** @var ContainerInterface $this */
            if ($this->get('kernel')->getEnvironment() === 'dev') {
                $options = JSON_PRETTY_PRINT;
            }
            $data = json_encode($data, $options);
        }

        if (is_object($data) && !$data instanceof \stdClass && !is_string($data)) {
            $data = $this->serializer->serialize($data, 'json');
        }

        return new JsonResponse($data, $code, ['Content-Type' => 'application/json'], true);
    }

    /**
     * @param $data
     * @param int $code
     * @return Response
     * @throws \InvalidArgumentException
     */
    private function xmlResponse($data, int $code = 200): Response
    {
        if (is_string($data)) {
            $xml = new \XMLReader();
            try {
                $xml->XML($data);
                if (!$xml->isValid()) {
                    /** @Desc("Invalid XML format") */
                    throw new \InvalidArgumentException($this->translator->trans('error.invalid_xml_format'));
                }
            } finally {
                $xml->close();
            }
        }

        if (is_object($data) && !is_string($data)) {
            $data = $this->serializer->serialize($data, 'xml');
        }

        return new Response($data, $code, ['Content-Type' => 'application/xml'], true);
    }

    /**
     * @param $data
     * @param string $format
     * @param int $code
     * @return Response
     * @throws \InvalidArgumentException
     */
    private function response($data, string $format = 'json', int $code = 200): Response
    {
        if ($format === 'json') {
            return $this->jsonResponse($data, $code);
        }

        if ($format === 'xml') {
            return $this->xmlResponse($data, $code);
        }
    }
}
