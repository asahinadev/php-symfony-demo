<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\PrefsRepository")
 */
class Prefs
{

    public function __construct($id = 0, $name = "unanswered", $ruby = "unanswered", $code = null)
    {
        if (is_null($code)) {
            $code = sprint_f("%02d", $id);
        }
        $this->id = $id;
        $this->name = $name;
        $this->ruby = $ruby;
        $this->code = $code;
    }

    /**
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     *
     * @ORM\Column(type="string", length=50)
     */
    private $ruby;

    /**
     *
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRuby(): ?string
    {
        return $this->ruby;
    }

    public function setRuby(string $ruby): self
    {
        $this->ruby = $ruby;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
