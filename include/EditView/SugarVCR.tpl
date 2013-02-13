{*
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

*}
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td nowrap class="paginationWrapper">
            {if !empty($list_link)}
                <button type="button" id="save_and_continue" class="button" title="{$app_strings.LBL_SAVE_AND_CONTINUE}" onClick="this.form.action.value='Save';if(check_form('EditView')){ldelim}sendAndRedirect('EditView', '{$app_strings.LBL_SAVING} {$module}...', '{$list_link}');{rdelim}">
                    {$app_strings.LBL_SAVE_AND_CONTINUE}
                </button>
                &nbsp;&nbsp;&nbsp;&nbsp;
            {/if}
            <span class="pagination">
                {if !empty($previous_link)}
                    <button type="button" class="button" title="{$app_strings.LNK_LIST_PREVIOUS}" onClick="document.location.href='{$previous_link}';">
                        {sugar_getimage name="previous" attr="border=\"0\" align=\"absmiddle\"" ext=".gif" alt=$app_strings.LNK_LIST_PREVIOUS}
                    </button>
                {else}
                    <button type="button" class="button" title="{$app_strings.LNK_LIST_PREVIOUS}" disabled='true'>
                        {sugar_getimage name="previous_off" attr="border=\"0\" align=\"absmiddle\"" ext=".gif" alt=$app_strings.LNK_LIST_PREVIOUS}
                    </button>
                {/if}
                &nbsp;&nbsp;
                ({$offset}{if !empty($total)} {$app_strings.LBL_LIST_OF} {$total}{$plus}{/if})
                &nbsp;&nbsp;
                {if !empty($next_link)}
                    <button type="button" class="button" title="{$app_strings.LNK_LIST_NEXT}" onClick="document.location.href='{$next_link}';">
                        {sugar_getimage name="next" attr="border=\"0\" align=\"absmiddle\"" ext=".gif" alt=$app_strings.LNK_LIST_NEXT}
                    </button>
                {else}
                    <button type="button" class="button" title="{$app_strings.LNK_LIST_NEXT}" disabled="true">
                        {sugar_getimage name="next_off" attr="border=\"0\" align=\"absmiddle\"" ext=".gif" alt=$app_strings.LNK_LIST_NEXT}
                    </button>
                {/if}
            </span>
            &nbsp;&nbsp;
        </td>
    </tr>
</table>
