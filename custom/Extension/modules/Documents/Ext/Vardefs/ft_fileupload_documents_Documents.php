<?php
// created: 2013-02-10 10:28:30
$dictionary["Document"]["fields"]["ft_fileupload_documents"] = array (
  'name' => 'ft_fileupload_documents',
  'type' => 'link',
  'relationship' => 'ft_fileupload_documents',
  'source' => 'non-db',
  'vname' => 'LBL_FT_FILEUPLOAD_DOCUMENTS_FROM_FT_FILEUPLOAD_TITLE',
  'id_name' => 'ft_fileupload_documentsft_fileupload_ida',
);
$dictionary["Document"]["fields"]["ft_fileupload_documents_name"] = array (
  'name' => 'ft_fileupload_documents_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_FT_FILEUPLOAD_DOCUMENTS_FROM_FT_FILEUPLOAD_TITLE',
  'save' => true,
  'id_name' => 'ft_fileupload_documentsft_fileupload_ida',
  'link' => 'ft_fileupload_documents',
  'table' => 'ft_fileupload',
  'module' => 'ft_FileUpload',
  'rname' => 'document_name',
);
$dictionary["Document"]["fields"]["ft_fileupload_documentsft_fileupload_ida"] = array (
  'name' => 'ft_fileupload_documentsft_fileupload_ida',
  'type' => 'link',
  'relationship' => 'ft_fileupload_documents',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_FT_FILEUPLOAD_DOCUMENTS_FROM_DOCUMENTS_TITLE',
);
