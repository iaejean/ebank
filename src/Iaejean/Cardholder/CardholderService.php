<?php
namespace Iaejean\Cardholder;

use Iaejean\Account\AccountService;
use Iaejean\Base\TraitService;
use Iaejean\Entity\Cardholder;
use Iaejean\Entity\CardholderEntity;
use Iaejean\Mail\MailService;
use JMS\DiExtraBundle\Annotation as DI;
use Mailgun\Mailgun;

/**
 * Class CardholderService
 * @package Iaejean\Cardholder
 * @DI\Service()
 */
class CardholderService
{
    use TraitService;

    /**
     * @var AccountService
     * @DI\Inject("iaejean.account.account_service")
     */
    public $accountService;

    /**
     * @var MailService
     * @DI\Inject("iaejean.mail.mail_service")
     */
    public $mailService;

    /**
     * @return array|CardholderEntity[]
     */
    public function getAll(): array
    {
        $cardholderRepository = $this->entityManager->getRepository('IaejeanBundle:Cardholder');
        return $cardholderRepository->findAll();
    }

    /**
     * @param Cardholder $cardholder
     * @return Cardholder
     */
    public function create(Cardholder $cardholder): Cardholder
    {
        $account = AccountService::build();
        $account->setCardholder($cardholder);

        $this->entityManager->persist($cardholder);
        $this->entityManager->persist($account);
        $this->entityManager->flush();

        $this->mailService->send($cardholder->getEmail(), 'Welcome', 'id');
        $this->mailService->send($cardholder->getEmail(), 'Welcome', 'wqe');

        return $cardholder;
    }
}
