<?php
namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(indexes={
 *     @ORM\Index(name="idx_user_genders",columns={"gender_id"}),
 *     @ORM\Index(name="idx_user_prefs"  ,columns={"pref_id"}),
 * })
 */
class Users implements UserInterface
{

    /**
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string", length=50)
     */
    private $username;

    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     *
     * @ORM\Column(type="datetime",options={"default" : "CURRENT_TIMESTAMP"})
     */
    private $created;

    /**
     *
     * @ORM\Column(type="datetime",options={"default" : "CURRENT_TIMESTAMP"})
     */
    private $updated;

    /**
     *
     * @ORM\Column(type="boolean",options={"default" : false })
     */
    private $del_flag;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Genders")
     * @ORM\JoinColumn(nullable=true)
     */
    private $gender;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Prefs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $pref;

    /**
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $birthday_year;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getDelFlag(): ?bool
    {
        return $this->del_flag;
    }

    public function setDelFlag(bool $del_flag): self
    {
        $this->del_flag = $del_flag;

        return $this;
    }

    public function getGender(): ?Genders
    {
        return $this->gender;
    }

    public function setGender(?Genders $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPref(): ?Prefs
    {
        return $this->pref;
    }

    public function setPref(?Prefs $pref): self
    {
        $this->pref = $pref;

        return $this;
    }

    // UserInterface Start
    public function eraseCredentials()
    {
        // nop
    }

    public function getSalt()
    {
        // return md5("password");
        return null;
    }

    public function getRoles(): array
    {
        return (array) "ROLE_ADMIN";
    }

    // UserInterface End

    /**
     *
     * @ORM\PrePersist()
     */
    public function doPrePersist()
    {
        $now = new \DateTime();
        $this->setCreated($now);
        $this->setUpdated($now);
        $this->setDelFlag(false);
    }

    /**
     *
     * @ORM\PreUpdate
     */
    public function doPreUpdate()
    {
        $now = new \DateTime();
        $this->setUpdated($now);
    }

    public function getBirthdayYear(): ?int
    {
        return $this->birthday_year;
    }

    public function setBirthdayYear(int $birthday_year): self
    {
        $this->birthday_year = $birthday_year;

        return $this;
    }
}
