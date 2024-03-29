<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2012 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


// THIS CONTENT IS GENERATED BY MBPackage.php
$manifest = array (
  0 => 
  array (
    'acceptable_sugar_versions' => 
    array (
      0 => '',
    ),
  ),
  1 => 
  array (
    'acceptable_sugar_flavors' => 
    array (
      0 => 'CE',
      1 => 'PRO',
      2 => 'ENT',
    ),
  ),
  'readme' => '',
  'key' => 'ft',
  'author' => 'VTPL',
  'description' => 'Package created for modules to try the different data types available for fields in SugarCRM.',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'ft',
  'published_date' => '2013-02-11 08:21:01',
  'type' => 'module',
  'version' => 1360570861,
  'remove_tables' => 'prompt',
);


$installdefs = array (
  'id' => 'ft',
  'beans' => 
  array (
    0 => 
    array (
      'module' => 'ft_FieldTrial',
      'class' => 'ft_FieldTrial',
      'path' => 'modules/ft_FieldTrial/ft_FieldTrial.php',
      'tab' => true,
    ),
    1 => 
    array (
      'module' => 'ft_FileUpload',
      'class' => 'ft_FileUpload',
      'path' => 'modules/ft_FileUpload/ft_FileUpload.php',
      'tab' => true,
    ),
  ),
  'layoutdefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/layoutdefs/ft_fileupload_documents_ft_FileUpload.php',
      'to_module' => 'ft_FileUpload',
    ),
  ),
  'relationships' => 
  array (
    0 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/ft_fileupload_documentsMetaData.php',
    ),
  ),
  'image_dir' => '<basepath>/icons',
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/modules/ft_FieldTrial',
      'to' => 'modules/ft_FieldTrial',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/modules/ft_FileUpload',
      'to' => 'modules/ft_FileUpload',
    ),
  ),
  'language' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Documents.php',
      'to_module' => 'Documents',
      'language' => 'en_us',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/ft_FileUpload.php',
      'to_module' => 'ft_FileUpload',
      'language' => 'en_us',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),
  ),
  'vardefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/ft_fileupload_documents_Documents.php',
      'to_module' => 'Documents',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/ft_fileupload_documents_ft_FileUpload.php',
      'to_module' => 'ft_FileUpload',
    ),
  ),
  'layoutfields' => 
  array (
    0 => 
    array (
      'additional_fields' => 
      array (
        'Documents' => 'ft_fileupload_documents_name',
      ),
    ),
  ),
);