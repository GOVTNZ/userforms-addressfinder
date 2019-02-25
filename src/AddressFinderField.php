<?php

namespace GovtNZ\SilverStripe\UserForms;

use SilverStripe\UserForms\Model\EditableFormField;
use SilverStripe\Forms\ListboxField;
use SilverStripe\Forms\TextField;

class AddressFinderField extends EditableFormField
{

    private static $singular_name = 'AddressFinder Field';

    private static $plural_name = 'AddressFinder Fields';

    private static $db = array(
        "Provider" => "Varchar"
    );

    /**
     * {@inheritDoc}
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            new ListboxField(
                "Provider",
                "Address provider",
                $this->getSubclassesOf(AddressFinderProvider::class)
            )
        );

        return $fields;
    }

    public function getFormField()
    {
        $field = TextField::create(
            $this->Name,
            $this->EscapedTitle,
            $this->Default
        )
            ->setFieldHolderTemplate('UserFormsAddressfinderField_holder')
            ->setTemplate('UserFormsField')
            ->setAttribute('placeholder', 'Start typing an address...');

        $this->doUpdateFormField($field);

        // initialize the encapsulated addressprovider for this field.
        // If there's no provider set, use the first
        if (is_null($this->Provider)) {
            foreach (get_declared_classes() as $class) {
                if (is_subclass_of($class, AddressFinderProvider::class)) {
                    $this->Provider = $class;
                    break;
                }
            }
        }

        $provider = new $this->Provider;
        $provider->init($field);

        return $field;
    }

    protected function getSubclassesOf($parent)
    {
        $result = array();
        foreach (get_declared_classes() as $class) {
            if (is_subclass_of($class, $parent)) {
                $result[$class] = $class::getTitle();
            }
        }
        return $result;
    }
}
