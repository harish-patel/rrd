<?php
// created: 2013-02-11 13:51:02
$dictionary["ft_fileupload_documents"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'ft_fileupload_documents' => 
    array (
      'lhs_module' => 'ft_FileUpload',
      'lhs_table' => 'ft_fileupload',
      'lhs_key' => 'id',
      'rhs_module' => 'Documents',
      'rhs_table' => 'documents',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'ft_fileupload_documents_c',
      'join_key_lhs' => 'ft_fileupload_documentsft_fileupload_ida',
      'join_key_rhs' => 'ft_fileupload_documentsdocuments_idb',
    ),
  ),
  'table' => 'ft_fileupload_documents_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'ft_fileupload_documentsft_fileupload_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'ft_fileupload_documentsdocuments_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
    5 => 
    array (
      'name' => 'document_revision_id',
      'type' => 'varchar',
      'len' => '36',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'ft_fileupload_documentsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'ft_fileupload_documents_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'ft_fileupload_documentsft_fileupload_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'ft_fileupload_documents_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'ft_fileupload_documentsdocuments_idb',
      ),
    ),
  ),
);