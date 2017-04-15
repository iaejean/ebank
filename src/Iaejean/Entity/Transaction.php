<?php

namespace Iaejean\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Transaction
 *
 * @ORM\Table(
 *     name="transaction",
 *     indexes={
 *          @ORM\Index(name="fk_transaction_card1_idx", columns={"fk_card"}),
 *          @ORM\Index(name="fk_transaction_cardholder1_idx", columns={"fk_cardholder"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="Iaejean\Transaction\TransactionRepository")
 * @Serializer\AccessorOrder(order="alphabetical")
 */
class Transaction
{
    /**
     * @var float
     *
     * @ORM\Column(name="d_amount", type="float", precision=8, scale=2, nullable=false)
     * @Serializer\Type("float")
     */
    protected $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_datetime", type="datetime", nullable=false)
     * @Serializer\Type("DateTime<'y-m-d H:i:s'>")
     */
    protected $datetime;

    /**
     * @var string
     *
     * @ORM\Column(name="v_description", type="string", length=100, nullable=false)
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_transaction", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Type("integer")
     */
    protected $id;

    /**
     * @var \Iaejean\Entity\Card
     *
     * @ORM\ManyToOne(targetEntity="Iaejean\Entity\Card", inversedBy="transactions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_card", referencedColumnName="id_card")
     * })
     * @Serializer\Type("Iaejean\Entity\Card")
     */
    protected $card;

    /**
     * @var \Iaejean\Entity\Cardholder
     *
     * @ORM\ManyToOne(targetEntity="Iaejean\Entity\Cardholder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_cardholder", referencedColumnName="id_cardholder")
     * })
     * @Serializer\Type("Iaeejean\Entity\Cardholder")
     */
    protected $cardholder;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return Transaction
     */
    public function setAmount(float $amount): Transaction
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime(): \DateTime
    {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     *
     * @return Transaction
     */
    public function setDatetime(\DateTime $datetime): Transaction
    {
        $this->datetime = $datetime;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Transaction
     */
    public function setDescription(string $description): Transaction
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Transaction
     */
    public function setId(int $id): Transaction
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Iaejean\Entity\Card
     */
    public function getCard(): \Iaejean\Entity\Card
    {
        return $this->card;
    }

    /**
     * @param \Iaejean\Entity\Card $card
     *
     * @return Transaction
     */
    public function setCard(\Iaejean\Entity\Card $card): Transaction
    {
        $this->card = $card;
        return $this;
    }

    /**
     * @return \Iaejean\Entity\Cardholder
     */
    public function getCardholder(): \Iaejean\Entity\Cardholder
    {
        return $this->cardholder;
    }

    /**
     * @param \Iaejean\Entity\Cardholder $cardholder
     *
     * @return Transaction
     */
    public function setCardholder(\Iaejean\Entity\Cardholder $cardholder): Transaction
    {
        $this->cardholder = $cardholder;
        return $this;
    }
}
