<?php

namespace TechPromux\Bundle\ConfigurationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TechPromux\Bundle\BaseBundle\Entity\Resource\BaseResource;
use Translatable\Fixture\Type\Custom;

/**
 * OwnerConfiguration
 *
 * @ORM\Table(name="techpromux_configuration_custom_configuration")
 * @ORM\Entity()
 */
class CustomConfiguration extends BaseResource
{
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * @var any
     *
     */
    private $customValue;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var json
     *
     * @ORM\Column(name="settings", type="json")
     */
    private $settings;

    /**
     * @var string
     *
     * @ORM\Column(name="context", type="string", length=255)
     */
    private $context;

    /**
     * @var \Sonata\MediaBundle\Entity\BaseMedia
     *
     * @ORM\ManyToOne(targetEntity="Sonata\MediaBundle\Entity\BaseMedia",cascade={"all"})
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;

    /**
     * @ORM\OneToMany(targetEntity="TechPromux\Bundle\ConfigurationBundle\Entity\OwnerConfiguration", mappedBy="configuration", cascade={"all"}, orphanRemoval=true)
     */
    private $ownerConfigurations;

    //-------------------------------------------------------------------------------------------------

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ownerConfigurations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ownerConfiguration
     *
     * @param \TechPromux\Bundle\ConfigurationBundle\Entity\OwnerConfiguration $ownerConfiguration
     *
     * @return CustomConfiguration
     */
    public function addOwnerConfiguration(\TechPromux\Bundle\ConfigurationBundle\Entity\OwnerConfiguration $ownerConfiguration)
    {
        $this->ownerConfigurations[] = $ownerConfiguration;

        return $this;
    }

    /**
     * Remove ownerConfiguration
     *
     * @param \TechPromux\Bundle\ConfigurationBundle\Entity\OwnerConfiguration $ownerConfiguration
     */
    public function removeOwnerConfiguration(\TechPromux\Bundle\ConfigurationBundle\Entity\OwnerConfiguration $ownerConfiguration)
    {
        $this->ownerConfigurations->removeElement($ownerConfiguration);
    }

    /**
     * Get ownerConfigurations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOwnerConfigurations()
    {
        return $this->ownerConfigurations;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return CustomConfiguration
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return CustomConfiguration
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set settings
     *
     * @param json $settings
     *
     * @return CustomConfiguration
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get settings
     *
     * @return json
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return CustomConfiguration
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    //-----------------------------------------------------------------------------------------------------------

    public function __toString()
    {
        return $this->getTitle() ? $this->getTitle() : '';
    }

    /**
     * Set media
     *
     * @param \Sonata\MediaBundle\Entity\BaseMedia $media
     *
     * @return CustomConfiguration
     */
    public function setMedia(\Sonata\MediaBundle\Entity\BaseMedia $media = null)
    {
        $this->media = $media;
        return $this;
    }

    /**
     * Get media
     *
     * @return \Sonata\MediaBundle\Entity\BaseMedia
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return any
     */
    public function getCustomValue()
    {
        return $this->customValue;
    }

    /**
     * @param any $customValue
     * @return CustomConfiguration
     */
    public function setCustomValue($customValue)
    {
        $this->customValue = $customValue;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */

    public function getPrintableValue()
    {
        if ($this->getType() == "image") {
            return $this->media;
        }
        if ($this->getType() == "boolean") {
            return $this->value;
        }
        $printable_value = json_decode($this->value,true);

        if (is_array($printable_value))
            return $this->value;
        return $printable_value;
    }

}
