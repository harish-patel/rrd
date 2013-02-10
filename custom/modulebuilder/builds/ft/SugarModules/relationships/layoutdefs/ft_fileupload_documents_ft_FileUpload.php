<?php
 // created: 2013-02-10 10:28:30
$layout_defs["ft_FileUpload"]["subpanel_setup"]['ft_fileupload_documents'] = array (
  'order' => 100,
  'module' => 'Documents',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_FT_FILEUPLOAD_DOCUMENTS_FROM_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'ft_fileupload_documents',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
