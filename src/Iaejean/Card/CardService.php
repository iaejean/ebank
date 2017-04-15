<?php
namespace Iaejean\Card;

use Iaejean\Account\AccountService;
use Iaejean\Base\TraitService;
use Iaejean\Entity\Card;
use Iaejean\Entity\CardType;
use Iaejean\Mail\MailService;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class CardService
 * @package Iaejean\Card
 * @DI\Service()
 */
class CardService
{
    use TraitService;

    /**
     * @var MailService
     * @DI\Inject("iaejean.mail.mail_service")
     */
    public $mailService;

    /**
     * @return array|CardType[]
     */
    public function getAllCardTypes()
    {
        $cardTypeRepository = $this->entityManager->getRepository('IaejeanBundle:CardType');
        return $cardTypeRepository->findAll();
    }

    /**
     * @param \Iaejean\Entity\Card $card
     * @return \Iaejean\Entity\Card
     */
    public function create(Card $card)
    {
        $card->setNumber(AccountService::createNumber(16))
            ->setCvv(AccountService::createNumber(3))
            ->setMonthExpiration(12)
            ->setYearExpiration(24)
            ->setNip(AccountService::createNumber(4));

        $this->entityManager->merge($card);
        $this->entityManager->flush();
        $this->mailService->send($card->getAccount()->getCardholder()->getEmail(), 'New Card', $card->getNumber());

        return $card;
    }

    /**
     * @param \Iaejean\Entity\Card $card
     * @return \Iaejean\Entity\Card|null|object
     */
    public function access(Card $card)
    {
        $cardRepository = $this->entityManager->getRepository('IaejeanBundle:Card');
        $card = $cardRepository->findByNumberNip($card);
        if ($card === null) {
            throw new AccessDeniedException();
        }
        return $card;
    }

    /**
     * @param $id
     * @param $nip
     * @return \Iaejean\Entity\Card|null|object
     */
    public function update($id, $nip)
    {
        $cardRepository = $this->entityManager->getRepository('IaejeanBundle:Card');
        $card = $cardRepository->findOneBy(['id' => $id]);
        $card->setNip($nip);
        $this->entityManager->flush();
        return $card;
    }
}
