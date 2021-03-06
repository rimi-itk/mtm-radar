<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Question
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Survey", inversedBy="questions")
     * @ORM\JoinColumn(name="survey_id", referencedColumnName="id", nullable=false)
     */
    private $survey;

    /**
     * @ORM\Column(type="integer")
     */
    private $rank;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"survey", "answer"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Groups({"survey", "answer"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
     * @Groups({"survey", "answer"})
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"survey", "answer"})
     */
    private $image;

    public function __toString()
    {
        return $this->getSurvey().' - '.$this->getTitle();
    }

    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set survey.
     *
     * @param \App\Entity\Survey $survey
     *
     * @return Question
     */
    public function setSurvey(Survey $survey = null)
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * Get survey.
     *
     * @return \App\Entity\Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     *
     * @return Question
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return Question
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set category.
     *
     * @param string $category
     *
     * @return Question
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     *
     * @return Question
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setQuestionRank()
    {
        $this->getSurvey()->setQuestionRanks();
    }
}
