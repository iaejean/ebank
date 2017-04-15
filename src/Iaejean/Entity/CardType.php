<?php
namespace Iaejean\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * CardType
 *
 * @ORM\Table(name="card_type")
 * @ORM\Entity(repositoryClass="Iaejean\Card\CardTypeRepository")
 * @Serializer\AccessorOrder(order="alphabetical")
 */
class CardType
{
    /**
     * @var string
     *
     * @ORM\Column(name="v_name", type="string", length=100, nullable=false)
     * @Serializer\Type("string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="v_description", type="string", length=200, nullable=false)
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="c_code", type="string", length=5, nullable=false)
     * @Serializer\Type("string")
     */
    protected $code;

    /**
     * @var boolean
     *
     * @ORM\Column(name="b_credit", type="boolean", nullable=false)
     * @Serializer\Type("boolean")
     */
    protected $credit;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_card_type", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Type("integer")
     */
    protected $id;

    /**
     * @var Card[]
     *
     * @ORM\OneToMany(targetEntity="Iaejean\Entity\Card", mappedBy="cardType")
     * @Serializer\Type("array<Iaejean\Entity\Card>")
     */
    protected $cards;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return CardType
     */
    public function setName(string $name): CardType
    {
        $this->name = $name;
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
     * @return CardType
     */
    public function setDescription(string $description): CardType
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return CardType
     */
    public function setCode(string $code): CardType
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCredit(): bool
    {
        return $this->credit;
    }

    /**
     * @param bool $credit
     *
     * @return CardType
     */
    public function setCredit(bool $credit): CardType
    {
        $this->credit = $credit;
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
     * @return CardType
     */
    public function setId(int $id): CardType
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Iaejean\Entity\Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param \Iaejean\Entity\Card[] $cards
     *
     * @return CardType
     */
    public function setCards(array $cards): CardType
    {
        $this->cards = $cards;
        return $this;
    }
}
