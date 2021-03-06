<?php

namespace Netgen\TagsBundle\Tests\Core\FieldType;

use eZ\Publish\Core\FieldType\Tests\FieldTypeTest;
use Netgen\TagsBundle\Core\FieldType\Tags\Type as TagsType;
use Netgen\TagsBundle\Core\FieldType\Tags\Value as TagsValue;
use Netgen\TagsBundle\API\Repository\Values\Tags\Tag;
use DateTime;
use stdClass;

/**
 * Test for eztags field type
 *
 * @group fieldType
 * @group eztags
 */
class TagsTest extends FieldTypeTest
{
    /**
     * Returns the field type under test.
     *
     * @return \Netgen\TagsBundle\Core\FieldType\Tags\Type
     */
    protected function createFieldTypeUnderTest()
    {
        return new TagsType();
    }

    /**
     * Returns the validator configuration schema expected from the field type.
     *
     * @return array
     */
    protected function getValidatorConfigurationSchemaExpectation()
    {
        return array();
    }

    /**
     * Returns the settings schema expected from the field type.
     *
     * @return array
     */
    protected function getSettingsSchemaExpectation()
    {
        return array();
    }

    /**
     * Returns the empty value expected from the field type.
     *
     * @return \Netgen\TagsBundle\Core\FieldType\Tags\Value
     */
    protected function getEmptyValueExpectation()
    {
        return new TagsValue();
    }

    /**
     * Data provider for invalid input to acceptValue().
     *
     * @return array
     */
    public function provideInvalidInputForAcceptValue()
    {
        return array(
            array(
                42,
                "eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException"
            ),
            array(
                "invalid",
                "eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException"
            ),
            array(
                array(
                    new stdClass()
                ),
                "eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException"
            ),
            array(
                new stdClass(),
                "eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException"
            )
        );
    }

    /**
     * Data provider for valid input to acceptValue().
     *
     * @return array
     */
    public function provideValidInputForAcceptValue()
    {
        return array(
            array(
                null,
                new TagsValue()
            ),
            array(
                array(),
                new TagsValue()
            ),
            array(
                array( new Tag() ),
                new TagsValue( array( new Tag() ) )
            ),
            array(
                new TagsValue(),
                new TagsValue()
            ),
            array(
                new TagsValue( null ),
                new TagsValue()
            ),
            array(
                new TagsValue( array() ),
                new TagsValue()
            ),
            array(
                new TagsValue( array( new Tag() ) ),
                new TagsValue( array( new Tag() ) )
            )
        );
    }

    /**
     * Provide input for the toHash() method
     *
     * @return array
     */
    public function provideInputForToHash()
    {
        return array(
            array(
                new TagsValue(),
                array()
            ),
            array(
                new TagsValue( null ),
                array()
            ),
            array(
                new TagsValue( array() ),
                array()
            ),
            array(
                new TagsValue(
                    array(
                        $this->getTag()
                    )
                ),
                array(
                    $this->getTagHash()
                )
            )
        );
    }

    /**
     * Provide input to fromHash() method
     *
     * @return array
     */
    public function provideInputForFromHash()
    {
        return array(
            array(
                null,
                new TagsValue()
            ),
            array(
                array(),
                new TagsValue()
            ),
            array(
                array(
                    $this->getTagHash()
                ),
                new TagsValue(
                    array(
                        $this->getTag()
                    )
                )
            )
        );
    }

    /**
     * Returns a tag for tests
     *
     * @return \Netgen\TagsBundle\API\Repository\Values\Tags\Tag
     */
    protected function getTag()
    {
        $modificationDate = new Datetime();
        $modificationDate->setTimestamp( 1308153110 );

        return new Tag(
            array(
                "id" => 40,
                "parentTagId" => 7,
                "mainTagId" => 0,
                "keyword" => "eztags",
                "depth" => 3,
                "pathString" => "/8/7/40/",
                "modificationDate" => $modificationDate,
                "remoteId" => "182be0c5cdcd5072bb1864cdee4d3d6e"
            )
        );
    }

    /**
     * Returns a hash version of tag for tests
     *
     * @return array
     */
    protected function getTagHash()
    {
        return array(
            "id" => 40,
            "parent_id" => 7,
            "main_tag_id" => 0,
            "keyword" => "eztags",
            "depth" => 3,
            "path_string" => "/8/7/40/",
            "modified" => 1308153110,
            "remote_id" => "182be0c5cdcd5072bb1864cdee4d3d6e"
        );
    }
}
