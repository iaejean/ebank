<?php
namespace Iaejean\Transaction;

use Iaejean\Base\TraitController;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TransactionController
 * @package Iaejean\Transaction
 * @Route("/api/v1")
 */
class TransactionController extends Controller
{
    /**
     * @var TransactionService
     * @DI\Inject("iaejean.transaction.transaction_service")
     */
    protected $transactionService;
    use TraitController;

    /**
     * @Route(
     *     "/transaction/card/{id}.{_locale}.{_format}",
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
    public function getAllAction(Request $request, string $id, string $_format, string $_locale): Response
    {
        $this->logger->info('Request ['. mb_strtoupper($request->getMethod()) .']: '. $request->getRequestUri());
        $transactionList = $this->transactionService->getByCard($id);
        $transactionList = $this->serializer->serialize($transactionList, $_format);
        return $this->response($transactionList, $_format);
    }
}
