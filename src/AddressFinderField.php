<?php

namespace GovtNZ\SilverStripe\UserForms;

use SilverStripe\UserForms\Model\EditableFormField;
use SilverStripe\Forms\ListboxField;
use SilverStripe\Forms\TextField;
use SilverStripe\Core\ClassInfo;

class AddressFinderField extends EditableFormField
{

    private static $singular_name = 'AddressFinder Field';

    private static $plural_name = 'AddressFinder Fields';

    private static $db = array(
        "Provider" => "Varchar(200)"
    );

    private static $table_name = 'AddressFinderField';

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
                ClassInfo::implementorsOf(AddressFinderProvider::class)
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

        if (!$this->Provider || !class_exists($this->Provider)) {
            $providers = ClassInfo::implementorsOf(AddressFinderProvider::class);

            $this->Provider = array_shift($providers);
        }

        $provider = new $this->Provider;
        $provider->init($field);

        return $field;
    }
}
