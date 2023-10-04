{*
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */
*}
{php}
// start template_total_table code
global $mod_strings;
require_once('modules/Reports/templates/templates_reports.php');
$reporter = $_smarty_tpl->getTemplateVars('reporter');
$total_header_row = $reporter->get_total_header_row(); 
$total_row = $reporter->get_summary_total_row();
if ( isset($total_row['group_pos'])) {
	$args['group_pos'] = $total_row['group_pos'];
} // if
if ( isset($total_row['group_column_is_invisible'])) {
	$args['group_column_is_invisible'] = $total_row['group_column_is_invisible'];
} // if
	$reporter->layout_manager->setAttribute('no_sort',1);
	echo get_form_header( $mod_strings['LBL_GRAND_TOTAL'],"", false); 
	template_header_row($total_header_row, $args, false, $_smarty_tpl);
{/php}
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="list view">
{if ($show_pagination neq "")}
{$pagination_data}
{/if}
<tr height="20">
{if ($isSummaryCombo)}
<td scope="col" align='center'  valign=middle nowrap>&nbsp;</td>
{/if}
{if ($isSummaryComboHeader)}
<td><span id="img_{$divId|escape:'html':'UTF-8'}"><a href="javascript:expandCollapseComboSummaryDiv('{$divId|escape:javascript}')"><img width="8" height="8" border="0" absmiddle="" alt=$mod_strings.LBL_SHOW src="{$image_path}advanced_search.gif"/></a></span></td>
{/if}
{php}
	$count = 0;
	$_smarty_tpl->assign('count', $count);
{/php}
{foreach from=$header_row key=module item=cell}
	{if (($args.group_column_is_invisible != "") && ($args.group_pos eq $count))}
{php}	
	$count = $count + 1;
	$_smarty_tpl->assign('count', $count);
{/php}
	{else}
	{if $cell eq ""}
{php}	
	$cell = "&nbsp;";
	$_smarty_tpl->assign('cell', $cell);
{/php}
	{/if}
	
	<td scope="col" align='center'  valign=middle nowrap>	
	
	{$cell}
	{/if}
{/foreach}
</tr>
{php}
	if (!empty($total_row)) {
	    template_list_row($total_row, false, false, '', $_smarty_tpl);
{/php}
	<tr height=20 class="{$row_class}" onmouseover="setPointer(this, '{$rownum|escape:javascript}', 'over', '{$bg_color|escape:javascript}', '{$hilite_bg|escape:javascript}', '{$click_bg|escape:javascript}');" onmouseout="setPointer(this, '{$rownum|escape:javascript}', 'out', '{$bg_color|escape:javascript}', '{$hilite_bg|escape:javascript}', '{$click_bg|escape:javascript}');" onmousedown="setPointer(this, '{$rownum|escape:javascript}', 'click', '{$bg_color|escape:javascript}', '{$hilite_bg|escape:javascript}', '{$click_bg|escape:javascript}');">
	{if ($isSummaryComboHeader)}
	<td><span id="img_{$divId|escape:'html':'UTF-8'}"><a href="javascript:expandCollapseComboSummaryDiv('{$divId|escape:javascript}')"><img width="8" height="8" border="0" absmiddle="" alt=$mod_strings.LBL_SHOW src="{$image_path}advanced_search.gif"/></a></span></td>
	{/if}
	{php}
		$count = 0;
		$_smarty_tpl->assign('count', $count);
	{/php}
	{foreach from=$column_row.cells key=module item=cell}
		{if (($column_row.group_column_is_invisible != "") && ($count|in_array:$column_row.group_pos)) }
	{php}	
		$count = $count + 1;
		$_smarty_tpl->assign('count', $count);
	{/php}
		{else}
		{if $cell eq ""}
	{php}	
		$cell = "&nbsp;";
		$_smarty_tpl->assign('cell', $cell);
	{/php}
		{/if}		
		<td width="{$width|escape:'html':'UTF-8'}%" valign=TOP class="{$row_class}" bgcolor="{$bg_color|escape:'html':'UTF-8'}" scope="row">
		
		{$cell}
		{/if}
	{/foreach}
	</tr>
	
{php}
	} else {
	echo template_no_results();
	}
echo template_end_table($args);
	// end template_total_table code
//template_total_table($reporter);
template_query_table($reporter);
{/php}
