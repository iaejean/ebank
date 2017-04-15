<?php
namespace Iaejean\Card;

use Iaejean\Base\TraitController;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CardController
 * @package Iaejean\Card
 * @Route("/api/v1")
 */
class CardController extends Controller
{
    /**
     * @var CardService
     * @DI\Inject("iaejean.card.card_service")
     */
    protected $cardService;

    use TraitController;

    /**
     * @Route(
     *     "/cardType.{_locale}.{_format}",
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
    public function getAllCardTypesAction(Request $request, string $_format, string $_locale): Response
    {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $cardTypeList = $this->cardService->getAllCardTypes();
        $cardTypeList = $this->serializer->serialize($cardTypeList, $_format);
        return $this->response($cardTypeList, $_format);
    }

    /**
     * @Route(
     *     "/card.{_locale}.{_format}",
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
    public function postAction (Request $request, string $_format, string $_locale): Response
    {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $card = $request->getContent();
        $card = $this->serializer->deserialize($card, 'Iaejean\Entity\Card', $_format);
        $card = $this->cardService->create($card);
        return $this->response($card, $_format);
    }

    /**
     * @Route(
     *     "/card/access.{_locale}.{_format}",
     *     options={"i18n": false},
     *     defaults={"_format": "json", "_locale": "en"},
     *     requirements={"_format": "json|xml", "_locale": "en|es"}
     * )
     * @Method("POST")
     *
     * @param Request $request
     * @param string  $_format
     * @param string  $_locale
     *
     * @return Response
     */
    public function postAccessAction (Request $request, string $_format, string $_locale): Response
    {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $card = $request->getContent();
        $card = $this->serializer->deserialize($card, 'Iaejean\Entity\Card', $_format);
        $card = $this->cardService->access($card);
        return $this->response($card, $_format);
    }

    /**
     * @Route(
     *     "/card/{id}/{nip}.{_locale}.{_format}",
     *     options={"i18n": false},
     *     defaults={"_format": "json", "_locale": "en"},
     *     requirements={"_format": "json|xml", "_locale": "en|es"}
     * )
     * @Method("PUT")
     *
     * @param Request $request
     * @param string  $_format
     * @param string  $_locale
     *
     * @return Response
     */
    public function putAction (Request $request, string $nip, string $id, string $_format, string $_locale): Response
    {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $card = $this->cardService->update($id, $nip);
        return $this->response($card, $_format);
    }
}
