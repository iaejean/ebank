<?php
namespace Iaejean\Cardholder;

use Iaejean\Base\TraitController;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CardholderController
 * @package Iaejean\Cardholder
 * @Route("/api/v1")
 */
class CardholderController extends Controller
{
    use TraitController;

    /**
     * @var CardholderService
     * @DI\Inject("iaejean.cardholder.cardholder_service")
     */
    protected $cardholderService;

    /**
     * @Route(
     *     "/cardholder.{_locale}.{_format}",
     *     options={"i18n": false},
     *     defaults={"_format": "json", "_locale": "en"},
     *     requirements={"_format": "json|xml", "_locale": "en|es"}
     * )
     * @Method("GET")
     * @Secure(roles="ROLE_EXECUTIVE, ROLE_CASHIER")
     *
     * @param Request $request
     * @param string  $_format
     * @param string  $_locale
     *
     * @return Response
     */
    public function getAllAction(Request $request, string $_format, string $_locale): Response
    {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $cardholderList = $this->cardholderService->getAll();
        $cardholderList = $this->serializer->serialize($cardholderList, $_format);
        return $this->response($cardholderList, $_format);
    }

    /**
     * @Route(
     *     "/cardholder.{_locale}.{_format}",
     *     options={"i18n": false},
     *     defaults={"_format": "json", "_locale": "en"},
     *     requirements={"_format": "json|xml", "_locale": "en|es"}
     * )
     * @Method("POST")
     * @Secure(roles="ROLE_EXECUTIVE")
     *
     * @param Request $request
     * @param string  $_format
     * @param string  $_locale
     *
     * @return Response
     */
    public function postAction(Request $request, string $_format, string $_locale): Response
    {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $cardholder = $request->getContent();
        $cardholder = $this->serializer->deserialize($cardholder, 'Iaejean\Entity\Cardholder', $_format);
        $cardholder = $this->cardholderService->create($cardholder);
        return $this->response($cardholder, $_format);
    }
}
