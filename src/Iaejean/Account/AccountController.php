<?php
namespace Iaejean\Account;

use Iaejean\Base\TraitController;
use Iaejean\Entity\Cardholder;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AccountController
 * @package Iaejean\Account
 * @Route("/api/v1")
 */
class AccountController extends Controller
{
    /**
     * @var AccountService
     * @DI\Inject("iaejean.account.account_service")
     */
    protected $accountService;

    use TraitController;

    /**
     * @Route(
     *     "/account.{_locale}.{_format}",
     *     options={"i18n": false},
     *     defaults={"_format": "json", "_locale": "en"},
     *     requirements={"_format": "json|xml", "_locale": "en|es"}
     * )
     * @Method("GET")
     * @Secure(roles="ROLE_EXECUTIVE")
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
        $accountList = $this->accountService->getAll();
        $accountList = $this->serializer->serialize($accountList, $_format);
        return $this->response($accountList, $_format);
    }

    /**
     * @Route(
     *     "/account/cardholder/{id}.{_locale}.{_format}",
     *     options={"i18n": false},
     *     defaults={"_format": "json", "_locale": "en"},
     *     requirements={"_format": "json|xml", "_locale": "en|es"}
     * )
     * @Method("GET")
     * @Secure(roles="ROLE_EXECUTIVE, ROLE_CASHIER")
     *
     * @param Request $request
     * @param string  $id
     * @param string  $_format
     * @param string  $_locale
     *
     * @return Response
     */
    public function getAccountsByCardholderAction(
        Request $request,
        string $id,
        string $_format,
        string $_locale
    ): Response {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $cardholder = new Cardholder();
        $cardholder->setId($id);
        $accountList = $this->accountService->getAccountsByCardholder($cardholder);
        $accountList = $this->serializer->serialize($accountList, $_format);
        return $this->response($accountList, $_format);
    }

    /**
     * @Route(
     *     "/account/amount/{amount}.{_locale}.{_format}",
     *     options={"i18n": false},
     *     defaults={"_format": "json", "_locale": "en"},
     *     requirements={"_format": "json|xml", "_locale": "en|es"}
     * )
     * @Method("PUT")
     * @Secure(roles="ROLE_EXECUTIVE, ROLE_CASHIER")
     *
     * @param Request $request
     * @param string  $id
     * @param string  $_format
     * @param string  $_locale
     *
     * @return Response
     */
    public function putAction(Request $request, string $amount, string $_format, string $_locale): Response {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $account = $request->getContent();
        $account = $this->serializer->deserialize($account, 'Iaejean\Entity\Account', $_format);
        $account = $this->accountService->update($account, $amount);
        return $this->response($account, $_format);
    }
}
