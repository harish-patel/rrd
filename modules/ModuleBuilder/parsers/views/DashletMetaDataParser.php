<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
/* * *******************************************************************************
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
 * ****************************************************************************** */


require_once ('modules/ModuleBuilder/parsers/views/ListLayoutMetaDataParser.php');
require_once ('modules/ModuleBuilder/parsers/views/SearchViewMetaDataParser.php');
require_once 'modules/ModuleBuilder/parsers/constants.php';

class DashletMetaDataParser extends ListLayoutMetaDataParser
{

    // Columns is used by the view to construct the listview - each column is built by calling the named function
    public $columns = array('LBL_DEFAULT' => 'getDefaultFields', 'LBL_AVAILABLE' => 'getAdditionalFields', 'LBL_HIDDEN' => 'getAvailableFields');

    /*
     * Constructor
     * Must set:
     * $this->columns   Array of 'Column LBL'=>function_to_retrieve_fields_for_this_column() - expected by the view
     *
     * @param string moduleName     The name of the module to which this listview belongs
     * @param string packageName    If not empty, the name of the package to which this listview belongs
     */

    function __construct($view, $moduleName, $packageName = '')
    {

        $this->search = ($view == MB_DASHLETSEARCH) ? true : false;
        $this->_moduleName = $moduleName;
        $this->_packageName = $packageName;
        $this->_view = $view;
        if ($this->search)
        {
            $this->columns = array('LBL_DEFAULT' => 'getAdditionalFields', 'LBL_HIDDEN' => 'getAvailableFields');
            parent::__construct(MB_DASHLETSEARCH, $moduleName, $packageName);
        }
        else
        {
            parent::__construct(MB_DASHLET, $moduleName, $packageName);
        }
        $this->_viewdefs = $this->mergeFieldDefinitions($this->_viewdefs, $this->_fielddefs);
    }

    /**
     * Dashlets contain both a searchview and list view definition, therefore we need to merge only the relevant info
     */
    function mergeFieldDefinitions($viewdefs, $fielddefs)
    {
        if ($this->_view == MB_DASHLETSEARCH && isset($viewdefs['searchfields']))
        {
            //Remove any relate fields from the possible defs as they will break the homepage
            foreach ($fielddefs as $id => $def)
            {
                if (isset($def['type']) && $def['type'] == 'relate')
                {
                    if (isset($fielddefs[$id]['id_name']))
                    {
                        $fielddefs[$fielddefs[$id]['id_name']] = $def;
                        unset($fielddefs[$id]);
                    }
                }
            }
            $viewdefs = array_change_key_case($viewdefs['searchfields']);
            $viewdefs = $this->_viewdefs = $this->ConvertSearchToDashletDefs($viewdefs);
        }
        else if ($this->_view == MB_DASHLET && isset($viewdefs['columns']))
        {
            $viewdefs = $this->_viewdefs = array_change_key_case($viewdefs['columns']);
            $viewdefs = $this->_viewdefs = $this->convertSearchToListDefs($viewdefs);
        }

        return $viewdefs;
    }

    function convertSearchToListDefs($defs)
    {
        $temp = array();
        foreach ($defs as $key => $value)
        {
            $temp[$key] = $value;
            if (!isset($temp[$key]['name']))
            {
                $temp[$key]['name'] = $key;
            }
        }
        return $temp;
    }

    private function ConvertSearchToDashletDefs($defs)
    {
        $temp = array();
        foreach ($defs as $key => $value)
        {
            if ($value['default'])
            {
                //$temp[$key] = $value;
                $temp[$key] = array('default' => '');
            }
            else
            {
                $temp[$key] = $value;
            }
        }
        return $temp;
    }

    function handleSave($populate = true)
    {
        if (empty($this->_packageName))
        {
            foreach (array(MB_CUSTOMMETADATALOCATION, MB_BASEMETADATALOCATION) as $value)
            {
                $file = $this->implementation->getFileName(MB_DASHLET, $this->_moduleName, $value);
                if (file_exists($file))
                {
                    break;
                }
            }
            $writeTodashletName = $dashletName = $this->implementation->getLanguage() . 'Dashlet';
            if (!file_exists($file))
            {
                $file = "modules/{$this->_moduleName}/Dashlets/My{$this->_moduleName}Dashlet/My{$this->_moduleName}Dashlet.data.php";
                $dashletName = 'My' . $this->implementation->getLanguage() . 'Dashlet';
            }
            $writeFile = $this->implementation->getFileName(MB_DASHLET, $this->_moduleName);
            if (!file_exists($writeFile))
            {
                mkdir_recursive(dirname($writeFile));
            }
        }
        else
        {
            $writeFile = $file = $this->implementation->getFileName(MB_DASHLET, $this->_moduleName, $this->_packageName);
            $writeTodashletName = $dashletName = $this->implementation->module->key_name . 'Dashlet';
        }

        $this->implementation->_history->append($file);
        if ($populate)
            $this->_populateFromRequest();
        $out = "<?php\n";

        require($file);
        if (!isset($dashletData[$dashletName]))
        {
            sugar_die("unable to load Module Dashlet Definition");
        }
        if ($fh = sugar_fopen($writeFile, 'w'))
        {
            if ($this->_view == MB_DASHLETSEARCH)
            {
                $dashletData[$dashletName]['searchFields'] = $this->ConvertSearchToDashletDefs($this->_viewdefs);
            }
            else
            {
                $dashletData[$dashletName]['columns'] = $this->_viewdefs;
            }
            $out .= "\$dashletData['$writeTodashletName']['searchFields'] = " . var_export_helper($dashletData[$dashletName]['searchFields']) . ";\n";
            $out .= "\$dashletData['$writeTodashletName']['columns'] = " . var_export_helper($dashletData[$dashletName]['columns']) . ";\n";
            fputs($fh, $out);
            fclose($fh);
        }
    }

}

?>
