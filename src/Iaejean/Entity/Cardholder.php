<?php
namespace Iaejean\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Cardholder
 *
 * @ORM\Table(name="cardholder")
 * @ORM\Entity(repositoryClass="Iaejean\Cardholder\CardholderRepository")
 * @Serializer\AccessorOrder(order="alphabetical")
 */
class Cardholder
{
    /**
     * @var string
     *
     * @ORM\Column(name="v_first_name", type="string", length=100, nullable=false)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("firstName")
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="v_last_name", type="string", length=100, nullable=false)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("lastName")
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="v_email", type="string", length=100, nullable=false)
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_birthday", type="date", nullable=false)
     * @Serializer\Type("DateTime<'Y-m-d'>")
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="c_locale", type="string", length=2, nullable=true)
     * @Serializer\Type("string")
     */
    protected $locale;

    /**
     * @var string
     *
     * @ORM\Column(name="v_address", type="string", length=200, nullable=false)
     * @Serializer\Type("string")
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="c_cp", type="string", length=5, nullable=false)
     * @Serializer\Type("string")
     */
    protected $cp;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cardholder", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Type("integer")
     */
    protected $id;

    /***
     * @var Account[]
     *
     * @ORM\OneToMany(targetEntity="Account", mappedBy="cardholder", orphanRemoval=true, cascade={"persist", "remove"})
     * @Serializer\Type("array<Iaejean\Entity\Account>")
     */
    protected $accounts;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return Cardholder
     */
    public function setFirstName(string $firstName): Cardholder
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return Cardholder
     */
    public function setLastName(string $lastName): Cardholder
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Cardholder
     */
    public function setEmail(string $email): Cardholder
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     *
     * @return Cardholder
     */
    public function setBirthday(\DateTime $birthday): Cardholder
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     *
     * @return Cardholder
     */
    public function setLocale(string $locale): Cardholder
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return Cardholder
     */
    public function setAddress(string $address): Cardholder
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCp(): string
    {
        return $this->cp;
    }

    /**
     * @param string $cp
     *
     * @return Cardholder
     */
    public function setCp(string $cp): Cardholder
    {
        $this->cp = $cp;
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
     * @return Cardholder
     */
    public function setId(int $id): Cardholder
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Iaejean\Account\Account[]
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * @param \Iaejean\Account\Account[] $accounts
     *
     * @return Cardholder
     */
    public function setAccounts(array $accounts): Cardholder
    {
        $this->accounts = $accounts;
        return $this;
    }
}
