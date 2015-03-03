<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Checkers
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Checkers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="whites", type="string", length=255)
     */
    private $whites;

    /**
     * @var string
     *
     * @ORM\Column(name="blacks", type="string", length=255)
     */
    private $blacks;

    /**
     * @var string
     *
     * @ORM\Column(name="turn", type="string", length=255)
     */
    private $turn;

    /**
     * @var string
     *
     * @ORM\Column(name="A1", type="string", length=255)
     */
    private $a1;

    /**
     * @var string
     *
     * @ORM\Column(name="A3", type="string", length=255)
     */
    private $a3;

    /**
     * @var string
     *
     * @ORM\Column(name="A5", type="string", length=255)
     */
    private $a5;

    /**
     * @var string
     *
     * @ORM\Column(name="A7", type="string", length=255)
     */
    private $a7;

    /**
     * @var string
     *
     * @ORM\Column(name="B2", type="string", length=255)
     */
    private $b2;

    /**
     * @var string
     *
     * @ORM\Column(name="B4", type="string", length=255)
     */
    private $b4;

    /**
     * @var string
     *
     * @ORM\Column(name="B6", type="string", length=255)
     */
    private $b6;

    /**
     * @var string
     *
     * @ORM\Column(name="B8", type="string", length=255)
     */
    private $b8;

    /**
     * @var string
     *
     * @ORM\Column(name="C1", type="string", length=255)
     */
    private $c1;

    /**
     * @var string
     *
     * @ORM\Column(name="C3", type="string", length=255)
     */
    private $c3;

    /**
     * @var string
     *
     * @ORM\Column(name="C5", type="string", length=255)
     */
    private $c5;

    /**
     * @var string
     *
     * @ORM\Column(name="C7", type="string", length=255)
     */
    private $c7;

    /**
     * @var string
     *
     * @ORM\Column(name="D2", type="string", length=255)
     */
    private $d2;

    /**
     * @var string
     *
     * @ORM\Column(name="D4", type="string", length=255)
     */
    private $d4;

    /**
     * @var string
     *
     * @ORM\Column(name="D6", type="string", length=255)
     */
    private $d6;

    /**
     * @var string
     *
     * @ORM\Column(name="D8", type="string", length=255)
     */
    private $d8;

    /**
     * @var string
     *
     * @ORM\Column(name="E1", type="string", length=255)
     */
    private $e1;

    /**
     * @var string
     *
     * @ORM\Column(name="E3", type="string", length=255)
     */
    private $e3;

    /**
     * @var string
     *
     * @ORM\Column(name="E5", type="string", length=255)
     */
    private $e5;

    /**
     * @var string
     *
     * @ORM\Column(name="E7", type="string", length=255)
     */
    private $e7;

    /**
     * @var string
     *
     * @ORM\Column(name="F2", type="string", length=255)
     */
    private $f2;

    /**
     * @var string
     *
     * @ORM\Column(name="F4", type="string", length=255)
     */
    private $f4;

    /**
     * @var string
     *
     * @ORM\Column(name="F6", type="string", length=255)
     */
    private $f6;

    /**
     * @var string
     *
     * @ORM\Column(name="F8", type="string", length=255)
     */
    private $f8;

    /**
     * @var string
     *
     * @ORM\Column(name="G1", type="string", length=255)
     */
    private $g1;

    /**
     * @var string
     *
     * @ORM\Column(name="G3", type="string", length=255)
     */
    private $g3;

    /**
     * @var string
     *
     * @ORM\Column(name="G5", type="string", length=255)
     */
    private $g5;

    /**
     * @var string
     *
     * @ORM\Column(name="G7", type="string", length=255)
     */
    private $g7;

    /**
     * @var string
     *
     * @ORM\Column(name="H2", type="string", length=255)
     */
    private $h2;

    /**
     * @var string
     *
     * @ORM\Column(name="H4", type="string", length=255)
     */
    private $h4;

    /**
     * @var string
     *
     * @ORM\Column(name="H6", type="string", length=255)
     */
    private $h6;

    /**
     * @var string
     *
     * @ORM\Column(name="H8", type="string", length=255)
     */
    private $h8;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set whites
     *
     * @param string $whites
     * @return Checkers
     */
    public function setWhites($whites)
    {
        $this->whites = $whites;

        return $this;
    }

    /**
     * Get whites
     *
     * @return string 
     */
    public function getWhites()
    {
        return $this->whites;
    }

    /**
     * Set blacks
     *
     * @param string $blacks
     * @return Checkers
     */
    public function setBlacks($blacks)
    {
        $this->blacks = $blacks;

        return $this;
    }

    /**
     * Get blacks
     *
     * @return string 
     */
    public function getBlacks()
    {
        return $this->blacks;
    }

    /**
     * Set turn
     *
     * @param string $turn
     * @return Checkers
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Get turn
     *
     * @return string 
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Set a1
     *
     * @param string $a1
     * @return Checkers
     */
    public function setA1($a1)
    {
        $this->a1 = $a1;

        return $this;
    }

    /**
     * Get a1
     *
     * @return string 
     */
    public function getA1()
    {
        return $this->a1;
    }

    /**
     * Set a3
     *
     * @param string $a3
     * @return Checkers
     */
    public function setA3($a3)
    {
        $this->a3 = $a3;

        return $this;
    }

    /**
     * Get a3
     *
     * @return string 
     */
    public function getA3()
    {
        return $this->a3;
    }

    /**
     * Set a5
     *
     * @param string $a5
     * @return Checkers
     */
    public function setA5($a5)
    {
        $this->a5 = $a5;

        return $this;
    }

    /**
     * Get a5
     *
     * @return string 
     */
    public function getA5()
    {
        return $this->a5;
    }

    /**
     * Set a7
     *
     * @param string $a7
     * @return Checkers
     */
    public function setA7($a7)
    {
        $this->a7 = $a7;

        return $this;
    }

    /**
     * Get a7
     *
     * @return string 
     */
    public function getA7()
    {
        return $this->a7;
    }

    /**
     * Set b2
     *
     * @param string $b2
     * @return Checkers
     */
    public function setB2($b2)
    {
        $this->b2 = $b2;

        return $this;
    }

    /**
     * Get b2
     *
     * @return string 
     */
    public function getB2()
    {
        return $this->b2;
    }

    /**
     * Set b4
     *
     * @param string $b4
     * @return Checkers
     */
    public function setB4($b4)
    {
        $this->b4 = $b4;

        return $this;
    }

    /**
     * Get b4
     *
     * @return string 
     */
    public function getB4()
    {
        return $this->b4;
    }

    /**
     * Set b6
     *
     * @param string $b6
     * @return Checkers
     */
    public function setB6($b6)
    {
        $this->b6 = $b6;

        return $this;
    }

    /**
     * Get b6
     *
     * @return string 
     */
    public function getB6()
    {
        return $this->b6;
    }

    /**
     * Set b8
     *
     * @param string $b8
     * @return Checkers
     */
    public function setB8($b8)
    {
        $this->b8 = $b8;

        return $this;
    }

    /**
     * Get b8
     *
     * @return string 
     */
    public function getB8()
    {
        return $this->b8;
    }

    /**
     * Set c1
     *
     * @param string $c1
     * @return Checkers
     */
    public function setC1($c1)
    {
        $this->c1 = $c1;

        return $this;
    }

    /**
     * Get c1
     *
     * @return string 
     */
    public function getC1()
    {
        return $this->c1;
    }

    /**
     * Set c3
     *
     * @param string $c3
     * @return Checkers
     */
    public function setC3($c3)
    {
        $this->c3 = $c3;

        return $this;
    }

    /**
     * Get c3
     *
     * @return string 
     */
    public function getC3()
    {
        return $this->c3;
    }

    /**
     * Set c5
     *
     * @param string $c5
     * @return Checkers
     */
    public function setC5($c5)
    {
        $this->c5 = $c5;

        return $this;
    }

    /**
     * Get c5
     *
     * @return string 
     */
    public function getC5()
    {
        return $this->c5;
    }

    /**
     * Set c7
     *
     * @param string $c7
     * @return Checkers
     */
    public function setC7($c7)
    {
        $this->c7 = $c7;

        return $this;
    }

    /**
     * Get c7
     *
     * @return string 
     */
    public function getC7()
    {
        return $this->c7;
    }

    /**
     * Set d2
     *
     * @param string $d2
     * @return Checkers
     */
    public function setD2($d2)
    {
        $this->d2 = $d2;

        return $this;
    }

    /**
     * Get d2
     *
     * @return string 
     */
    public function getD2()
    {
        return $this->d2;
    }

    /**
     * Set d4
     *
     * @param string $d4
     * @return Checkers
     */
    public function setD4($d4)
    {
        $this->d4 = $d4;

        return $this;
    }

    /**
     * Get d4
     *
     * @return string 
     */
    public function getD4()
    {
        return $this->d4;
    }

    /**
     * Set d6
     *
     * @param string $d6
     * @return Checkers
     */
    public function setD6($d6)
    {
        $this->d6 = $d6;

        return $this;
    }

    /**
     * Get d6
     *
     * @return string 
     */
    public function getD6()
    {
        return $this->d6;
    }

    /**
     * Set d8
     *
     * @param string $d8
     * @return Checkers
     */
    public function setD8($d8)
    {
        $this->d8 = $d8;

        return $this;
    }

    /**
     * Get d8
     *
     * @return string 
     */
    public function getD8()
    {
        return $this->d8;
    }

    /**
     * Set e1
     *
     * @param string $e1
     * @return Checkers
     */
    public function setE1($e1)
    {
        $this->e1 = $e1;

        return $this;
    }

    /**
     * Get e1
     *
     * @return string 
     */
    public function getE1()
    {
        return $this->e1;
    }

    /**
     * Set e3
     *
     * @param string $e3
     * @return Checkers
     */
    public function setE3($e3)
    {
        $this->e3 = $e3;

        return $this;
    }

    /**
     * Get e3
     *
     * @return string 
     */
    public function getE3()
    {
        return $this->e3;
    }

    /**
     * Set e5
     *
     * @param string $e5
     * @return Checkers
     */
    public function setE5($e5)
    {
        $this->e5 = $e5;

        return $this;
    }

    /**
     * Get e5
     *
     * @return string 
     */
    public function getE5()
    {
        return $this->e5;
    }

    /**
     * Set e7
     *
     * @param string $e7
     * @return Checkers
     */
    public function setE7($e7)
    {
        $this->e7 = $e7;

        return $this;
    }

    /**
     * Get e7
     *
     * @return string 
     */
    public function getE7()
    {
        return $this->e7;
    }

    /**
     * Set f2
     *
     * @param string $f2
     * @return Checkers
     */
    public function setF2($f2)
    {
        $this->f2 = $f2;

        return $this;
    }

    /**
     * Get f2
     *
     * @return string 
     */
    public function getF2()
    {
        return $this->f2;
    }

    /**
     * Set f4
     *
     * @param string $f4
     * @return Checkers
     */
    public function setF4($f4)
    {
        $this->f4 = $f4;

        return $this;
    }

    /**
     * Get f4
     *
     * @return string 
     */
    public function getF4()
    {
        return $this->f4;
    }

    /**
     * Set f6
     *
     * @param string $f6
     * @return Checkers
     */
    public function setF6($f6)
    {
        $this->f6 = $f6;

        return $this;
    }

    /**
     * Get f6
     *
     * @return string 
     */
    public function getF6()
    {
        return $this->f6;
    }

    /**
     * Set f8
     *
     * @param string $f8
     * @return Checkers
     */
    public function setF8($f8)
    {
        $this->f8 = $f8;

        return $this;
    }

    /**
     * Get f8
     *
     * @return string 
     */
    public function getF8()
    {
        return $this->f8;
    }

    /**
     * Set g1
     *
     * @param string $g1
     * @return Checkers
     */
    public function setG1($g1)
    {
        $this->g1 = $g1;

        return $this;
    }

    /**
     * Get g1
     *
     * @return string 
     */
    public function getG1()
    {
        return $this->g1;
    }

    /**
     * Set g3
     *
     * @param string $g3
     * @return Checkers
     */
    public function setG3($g3)
    {
        $this->g3 = $g3;

        return $this;
    }

    /**
     * Get g3
     *
     * @return string 
     */
    public function getG3()
    {
        return $this->g3;
    }

    /**
     * Set g5
     *
     * @param string $g5
     * @return Checkers
     */
    public function setG5($g5)
    {
        $this->g5 = $g5;

        return $this;
    }

    /**
     * Get g5
     *
     * @return string 
     */
    public function getG5()
    {
        return $this->g5;
    }

    /**
     * Set g7
     *
     * @param string $g7
     * @return Checkers
     */
    public function setG7($g7)
    {
        $this->g7 = $g7;

        return $this;
    }

    /**
     * Get g7
     *
     * @return string 
     */
    public function getG7()
    {
        return $this->g7;
    }

    /**
     * Set h2
     *
     * @param string $h2
     * @return Checkers
     */
    public function setH2($h2)
    {
        $this->h2 = $h2;

        return $this;
    }

    /**
     * Get h2
     *
     * @return string 
     */
    public function getH2()
    {
        return $this->h2;
    }

    /**
     * Set h4
     *
     * @param string $h4
     * @return Checkers
     */
    public function setH4($h4)
    {
        $this->h4 = $h4;

        return $this;
    }

    /**
     * Get h4
     *
     * @return string 
     */
    public function getH4()
    {
        return $this->h4;
    }

    /**
     * Set h6
     *
     * @param string $h6
     * @return Checkers
     */
    public function setH6($h6)
    {
        $this->h6 = $h6;

        return $this;
    }

    /**
     * Get h6
     *
     * @return string 
     */
    public function getH6()
    {
        return $this->h6;
    }

    /**
     * Set h8
     *
     * @param string $h8
     * @return Checkers
     */
    public function setH8($h8)
    {
        $this->h8 = $h8;

        return $this;
    }

    /**
     * Get h8
     *
     * @return string 
     */
    public function getH8()
    {
        return $this->h8;
    }

}
