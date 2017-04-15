<?php
namespace Iaejean\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Card
 *
 * @ORM\Table(
 *     name="card",
 *     indexes={
 *          @ORM\Index(name="fk_card_card_type1_idx", columns={"fk_card_type"}),
 *          @ORM\Index(name="fk_card_account1_idx", columns={"fk_account"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="Iaejean\Card\CardRepository")
 * @Serializer\AccessorOrder(order="alphabetical")
 */
class Card
{
    /**
     * @var string
     *
     * @ORM\Column(name="v_number", type="string", length=16, nullable=false)
     * @Serializer\Type("string")
     */
    protected $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="i_year_expiration", type="integer", nullable=false)
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("yearExpiration")
     */
    protected $yearExpiration;

    /**
     * @var integer
     *
     * @ORM\Column(name="i_month_expiration", type="integer", nullable=false)
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("monthExpiration")
     */
    protected $monthExpiration;

    /**
     * @var string
     *
     * @ORM\Column(name="v_cvv", type="string", length=4, nullable=false)
     * @Serializer\Type("string")
     */
    protected $cvv;

    /**
     * @var float
     *
     * @ORM\Column(name="d_limit", type="float", precision=8, scale=2, nullable=false)
     * @Serializer\Type("float")
     */
    protected $limit;

    /**
     * @var float
     *
     * @ORM\Column(name="d_balance", type="float", precision=8, scale=2, nullable=false)
     * @Serializer\Type("float")
     */
    protected $balance;

    /**
     * @var string
     *
     * @ORM\Column(name="c_nip", type="string", length=4, nullable=false)
     * @Serializer\Type("string")
     */
    protected $nip;

    /**
     * @var float
     *
     * @ORM\Column(name="d_credit", type="float", precision=8, scale=2, nullable=false)
     * @Serializer\Type("float")
     */
    protected $credit;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_card", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Type("integer")
     */
    protected $id;

    /**
     * @var \Iaejean\Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="Iaejean\Entity\Account", inversedBy="cards", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_account", referencedColumnName="id_account")
     * })
     * @Serializer\Type("Iaejean\Entity\Account")
     */
    protected $account;

    /**
     * @var \Iaejean\Entity\CardType
     *
     * @ORM\ManyToOne(targetEntity="Iaejean\Entity\CardType", inversedBy="cards", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_card_type", referencedColumnName="id_card_type")
     * })
     * @Serializer\Type("Iaejean\Entity\CardType")
     * @Serializer\SerializedName("cardType")
     */
    protected $cardType;

    /**
     * @var Transaction[]
     *
     * @ORM\OneToMany(targetEntity="Iaejean\Entity\Transaction", mappedBy="card")
     * @Serializer\Type("array<IaeJean\Entity\Transaction>")
     */
    protected $transactions;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return Card
     */
    public function setNumber(string $number): Card
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return int
     */
    public function getYearExpiration(): int
    {
        return $this->yearExpiration;
    }

    /**
     * @param int $yearExpiration
     *
     * @return Card
     */
    public function setYearExpiration(int $yearExpiration): Card
    {
        $this->yearExpiration = $yearExpiration;
        return $this;
    }

    /**
     * @return int
     */
    public function getMonthExpiration(): int
    {
        return $this->monthExpiration;
    }

    /**
     * @param int $monthExpiration
     *
     * @return Card
     */
    public function setMonthExpiration(int $monthExpiration): Card
    {
        $this->monthExpiration = $monthExpiration;
        return $this;
    }

    /**
     * @return string
     */
    public function getCvv(): string
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     *
     * @return Card
     */
    public function setCvv(string $cvv): Card
    {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * @return float
     */
    public function getLimit(): float
    {
        return $this->limit;
    }

    /**
     * @param float $limit
     *
     * @return Card
     */
    public function setLimit(float $limit): Card
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     *
     * @return Card
     */
    public function setBalance(float $balance): Card
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return string
     */
    public function getNip(): string
    {
        return $this->nip;
    }

    /**
     * @param string $nip
     *
     * @return Card
     */
    public function setNip(string $nip): Card
    {
        $this->nip = $nip;
        return $this;
    }

    /**
     * @return float
     */
    public function getCredit(): float
    {
        return $this->credit;
    }

    /**
     * @param float $credit
     *
     * @return Card
     */
    public function setCredit(float $credit): Card
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
     * @return Card
     */
    public function setId(int $id): Card
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Iaejean\Entity\Account
     */
    public function getAccount(): \Iaejean\Entity\Account
    {
        return $this->account;
    }

    /**
     * @param \Iaejean\Entity\Account $account
     *
     * @return Card
     */
    public function setAccount(\Iaejean\Entity\Account $account): Card
    {
        $this->account = $account;
        return $this;
    }

    /**
     * @return \Iaejean\Entity\CardType
     */
    public function getCardType(): \Iaejean\Entity\CardType
    {
        return $this->cardType;
    }

    /**
     * @param \Iaejean\Entity\CardType $cardType
     *
     * @return Card
     */
    public function setCardType(\Iaejean\Entity\CardType $cardType): Card
    {
        $this->cardType = $cardType;
        return $this;
    }

    /**
     * @return \Iaejean\Entity\Transaction[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @param \Iaejean\Entity\Transaction[] $transactions
     *
     * @return Card
     */
    public function setTransactions(array $transactions): Card
    {
        $this->transactions = $transactions;
        return $this;
    }
}
