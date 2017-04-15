<?php
namespace Iaejean\Account;

use Iaejean\Base\TraitService;
use Iaejean\Entity\Account;
use Iaejean\Entity\Cardholder;
use Iaejean\Entity\Transaction;
use Iaejean\Mail\MailService;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class AccountService
 * @package Iaejean\Account
 * @DI\Service()
 */
class AccountService
{
    /**
     * @var MailService
     * @DI\Inject("iaejean.mail.mail_service")
     */
    public $mailService;

    use TraitService;

    /**
     * @return Account
     */
    public static function build(): Account
    {
        $number = self::createNumber(10);
        $clave = self::createNumber(2).$number.self::createNumber(6);
        $account = new Account();
        return $account->setBalance(0)
            ->setClave($clave)
            ->setNumber($number);
    }

    /**
     * @param int $length
     * @return string
     */
    public static function createNumber(int $length): string
    {
        $number = "";
        $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $i = 0;
        while ($i < $length) {
            shuffle($numbers);
            $number.= $numbers[0];
            $i++;
        }

        return $number;
    }

    /**
     * @return array|Account[]
     */
    public function getAll()
    {
        $accountRepository = $this->entityManager->getRepository('IaejeanBundle:Account');
        return $accountRepository->findAll();
    }

    /**
     * @param \Iaejean\Entity\Cardholder $cardholder
     * @return array|\Iaejean\Entity\Account[]
     */
    public function getAccountsByCardholder(Cardholder $cardholder)
    {
        $accountRepository = $this->entityManager->getRepository('IaejeanBundle:Account');
        return $accountRepository->findBy(['cardholder' => $cardholder]);
    }

    /**
     * @param \Iaejean\Entity\Account $account
     * @return \Iaejean\Entity\Account
     */
    public function update(Account $account, $amount)
    {
        $accountRepository = $this->entityManager->getRepository('IaejeanBundle:Account');
        $amount = $account->getBalance() + $amount;
        $account  = $accountRepository->findOneBy(['id' => $account->getId()]);
        $account->setBalance($amount);

        $this->entityManager->flush();
        $this->mailService->send($account->getCardholder()->getEmail(), 'Founds', $account->getBalance());
        return $account;
    }
}
