<?php
namespace Iaejean\Card;

use Iaejean\Base\BaseRepository;
use Iaejean\Entity\Card;

/**
 * Class CardRepository
 * @package Iaejean\Card
 */
class CardRepository extends BaseRepository
{
    /**
     * @param \Iaejean\Entity\Card $card
     * @return null|object
     */
    public function findByNumberNip(Card $card)
    {
        return $this->findOneBy([
            'number' => $card->getNumber(),
            'nip' => $card->getNip()
        ]);
    }
}
