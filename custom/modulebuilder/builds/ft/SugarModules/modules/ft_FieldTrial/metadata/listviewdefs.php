<?php
$module_name = 'ft_FieldTrial';
$listViewDefs [$module_name] = 
array (
  'ADDRESS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ADDRESS',
    'width' => '10%',
    'default' => true,
  ),
  'DOCUMENT' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_DOCUMENT',
    'id' => 'DOCUMENT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'TEXT_FIELD' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_TEXT_FIELD',
    'width' => '10%',
    'default' => true,
  ),
  'ADDRESS_STATE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ADDRESS_STATE',
    'width' => '10%',
    'default' => true,
  ),
  'ADDRESS_CITY' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ADDRESS_CITY',
    'width' => '10%',
    'default' => true,
  ),
  'ADDRESS_POSTALCODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ADDRESS_POSTALCODE',
    'width' => '10%',
    'default' => true,
  ),
  'ADDRESS_COUNTRY' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ADDRESS_COUNTRY',
    'width' => '10%',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
);
?>
