<?php

class AddressFinderField extends EditableFormField {

    private static $singular_name = 'AddressFinder Field';

    private static $plural_name = 'AddressFinder Fields';

    private static $db = array(
        "Provider" => "Varchar"
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            new ListboxField(
                "Provider",
                "Address provider",
                $this->getSubclassesOf("AddressFinderProvider")));

        return $fields;
    }

    public function getFormField()
    {
        $field = TextField::create(
            $this->Name,
            $this->EscapedTitle,
            $this->Default)
            ->setFieldHolderTemplate('UserFormsField_holder')
            ->setTemplate('UserFormsField')
            ;
        $this->doUpdateFormField($field);

        // initialize the encapsulated addressprovider for this field.
        $provider = new $this->Provider;
        $provider->init($field);

        return $field;
    }

    protected function getSubclassesOf($parent)
    {
        $result = array();
        foreach (get_declared_classes() as $class) {
            if (is_subclass_of($class, $parent))
                $result[$class] = $class::getTitle();
        }
        return $result;
    }
}
