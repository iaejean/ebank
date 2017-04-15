<?php
namespace Iaejean\Transaction;

use Iaejean\Base\TraitService;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class TransactionService
 * @package Iaejean\Transaction
 * @DI\Service()
 */
class TransactionService
{
    use TraitService;

    /**
     * @param $id
     * @return array|\Iaejean\Entity\Transaction[]
     */
    public function getByCard($id)
    {
        $transactionRepository = $this->entityManager->getRepository('IaejeanBundle:Transaction');
        return $transactionRepository->findBy(['card' => $id]);
    }
}
