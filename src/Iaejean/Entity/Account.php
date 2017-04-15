<?php
namespace Iaejean\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Account
 *
 * @ORM\Table(name="account", indexes={@ORM\Index(name="fk_account_cardholder1_idx", columns={"fk_cardholder"})})
 * @ORM\Entity(repositoryClass="Iaejean\Account\AccountRepository")
 * @Serializer\AccessorOrder(order="alphabetical")
 */
class Account
{
    /**
     * @var string
     *
     * @ORM\Column(name="c_number", type="string", length=10, nullable=false)
     * @Serializer\Type("string")
     */
    protected $number;

    /**
     * @var string
     *
     * @ORM\Column(name="c_clave", type="string", length=18, nullable=false)
     * @Serializer\Type("string")
     */
    protected $clave;

    /**
     * @var float
     *
     * @ORM\Column(name="d_balance", type="float", precision=8, scale=2, nullable=false)
     * @Serializer\Type("float")
     */
    protected $balance;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_account", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Type("string")
     */
    protected $id;

    /**
     * @var \Iaejean\Entity\Cardholder
     *
     * @ORM\ManyToOne(targetEntity="Cardholder", inversedBy="accounts", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_cardholder", referencedColumnName="id_cardholder", nullable=true)
     * })
     * @Serializer\Type("Iaejean\Entity\Cardholder")
     */
    protected $cardholder;

    /**
     * @var Card[]
     *
     * @ORM\OneToMany(targetEntity="Iaejean\Entity\Card", mappedBy="account")
     * @Serializer\Type("array<Iaejean\Entity\Card>")
     */
    protected $cards;

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
     * @return Account
     */
    public function setNumber(string $number): Account
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getClave(): string
    {
        return $this->clave;
    }

    /**
     * @param string $clave
     *
     * @return Account
     */
    public function setClave(string $clave): Account
    {
        $this->clave = $clave;
        return $this;
    }

    /**
     * @return string
     */
    public function getBalance(): string
    {
        return $this->balance;
    }

    /**
     * @param string $balance
     *
     * @return Account
     */
    public function setBalance(string $balance): Account
    {
        $this->balance = $balance;
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
     * @return Account
     */
    public function setId(int $id): Account
    {
        $this->id = $id;
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
     * @return Account
     */
    public function setCardholder(\Iaejean\Entity\Cardholder $cardholder): Account
    {
        $this->cardholder = $cardholder;
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
     * @return Account
     */
    public function setCards(array $cards): Account
    {
        $this->cards = $cards;
        return $this;
    }
}
