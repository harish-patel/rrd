<?php

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


require_once('include/SugarObjects/templates/basic/Basic.php');

class Person extends Basic
{

    var $picture;

    /**
     * @var bool controls whether or not to invoke the getLocalFormatttedName method with title and salutation
     */
    var $createLocaleFormattedName = true;

    public function Person()
    {
        parent::Basic();
        $this->emailAddress = new SugarEmailAddress();
    }

    /**
     * need to override to have a name field created for this class
     *
     * @see parent::retrieve()
     */
    public function retrieve($id = -1, $encode = true, $deleted = true)
    {
        $ret_val = parent::retrieve($id, $encode, $deleted);
        $this->_create_proper_name_field();
        return $ret_val;
    }

    /**
     * Populate email address fields here instead of retrieve() so that they are properly available for logic hooks
     *
     * @see parent::fill_in_relationship_fields()
     */
    public function fill_in_relationship_fields()
    {
        parent::fill_in_relationship_fields();
        $this->emailAddress->handleLegacyRetrieve($this);
    }

    /**
     * This function helps generate the name and full_name member field variables from the salutation, title, first_name and last_name fields.
     * It takes into account the locale format settings as well as ACL settings if supported.
     */
    public function _create_proper_name_field()
    {
        global $locale, $app_list_strings;

        // Bug# 46125 - make first name, last name, salutation and title of Contacts respect field level ACLs
        $first_name = "";
        $last_name = "";
        $salutation = "";
        $title = "";

        // first name has at least read access
        $first_name = $this->first_name;

        // last name has at least read access
        $last_name = $this->last_name;


        // salutation has at least read access
        if (isset($this->field_defs['salutation']['options'])
                && isset($app_list_strings[$this->field_defs['salutation']['options']])
                && isset($app_list_strings[$this->field_defs['salutation']['options']][$this->salutation]))
        {

            $salutation = $app_list_strings[$this->field_defs['salutation']['options']][$this->salutation];
        } // if
        // last name has at least read access
        $title = $this->title;

        // Corner Case:
        // Both first name and last name cannot be empty, at least one must be shown
        // In that case, we can ignore field level ACL and just display last name...
        // In the ACL field level access settings, last_name cannot be set to "none"
        if (empty($first_name) && empty($last_name))
        {
            $full_name = $locale->getLocaleFormattedName("", $last_name, $salutation, $title);
        }
        else
        {
            if ($this->createLocaleFormattedName)
            {
                $full_name = $locale->getLocaleFormattedName($first_name, $last_name, $salutation, $title);
            }
            else
            {
                $full_name = $locale->getLocaleFormattedName($first_name, $last_name);
            }
        }

        $this->name = $full_name;
        $this->full_name = $full_name; //used by campaigns
    }

    /**
     * @see parent::save()
     */
    public function save($check_notify = false)
    {
        //If we are saving due to relationship changes, don't bother trying to update the emails
        if (!empty($GLOBALS['resavingRelatedBeans']))
        {
            parent::save($check_notify);
            return $this->id;
        }
        $this->add_address_streets('primary_address_street');
        $this->add_address_streets('alt_address_street');
        $ori_in_workflow = empty($this->in_workflow) ? false : true;
        $this->emailAddress->handleLegacySave($this, $this->module_dir);
        // bug #39188 - store emails state before workflow make any changes
        $this->emailAddress->stash($this->id, $this->module_dir);
        parent::save($check_notify);
        // $this->emailAddress->evaluateWorkflowChanges($this->id, $this->module_dir);
        $override_email = array();
        if (!empty($this->email1_set_in_workflow))
        {
            $override_email['emailAddress0'] = $this->email1_set_in_workflow;
        }
        if (!empty($this->email2_set_in_workflow))
        {
            $override_email['emailAddress1'] = $this->email2_set_in_workflow;
        }
        if (!isset($this->in_workflow))
        {
            $this->in_workflow = false;
        }
        if ($ori_in_workflow === false || !empty($override_email))
        {
            $this->emailAddress->save($this->id, $this->module_dir, $override_email, '', '', '', '', $this->in_workflow);
            // $this->emailAddress->applyWorkflowChanges($this->id, $this->module_dir);
        }
        return $this->id;
    }

    /**
     * @see parent::get_summary_text()
     */
    public function get_summary_text()
    {
        $this->_create_proper_name_field();
        return $this->name;
    }

    /**
     * @see parent::get_list_view_data()
     */
    public function get_list_view_data()
    {
        global $system_config;
        global $current_user;
        $this->_create_proper_name_field();
        $temp_array = $this->get_list_view_array();
        $temp_array['NAME'] = $this->name;
        $temp_array['EMAIL1'] = $this->emailAddress->getPrimaryAddress($this);
        $this->email1 = $temp_array['EMAIL1'];
        $temp_array['EMAIL1_LINK'] = $current_user->getEmailLink('email1', $this, '', '', 'ListView');
        return $temp_array;
    }

    /**
     * @see SugarBean::populateRelatedBean()
     */
    public function populateRelatedBean(
    SugarBean $newbean
    )
    {
        parent::populateRelatedBean($newbean);

        if ($newbean instanceOf Company)
        {
            $newbean->phone_fax = $this->phone_fax;
            $newbean->phone_office = $this->phone_work;
            $newbean->phone_alternate = $this->phone_other;
            $newbean->email1 = $this->email1;
            $this->add_address_streets('primary_address_street');
            $newbean->billing_address_street = $this->primary_address_street;
            $newbean->billing_address_city = $this->primary_address_city;
            $newbean->billing_address_state = $this->primary_address_state;
            $newbean->billing_address_postalcode = $this->primary_address_postalcode;
            $newbean->billing_address_country = $this->primary_address_country;
            $this->add_address_streets('alt_address_street');
            $newbean->shipping_address_street = $this->alt_address_street;
            $newbean->shipping_address_city = $this->alt_address_city;
            $newbean->shipping_address_state = $this->alt_address_state;
            $newbean->shipping_address_postalcode = $this->alt_address_postalcode;
            $newbean->shipping_address_country = $this->alt_address_country;
        }
    }

}
