<?php
namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @Assert\NotNull()
     * @Assert\Length(max=50)
     */
    private $username;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(groups={"r"})
     * @Assert\Length(max=255)
     */
    private $password;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Length(max=255)
     * @Assert\Email()
     */
    private $email;

    /**
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     *
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     *
     * @ORM\Column(type="boolean")
     */
    private $del_flag;

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
}
