{include:file="{$BACKEND_CORE_PATH}/layout/templates/header.tpl"}
{include:file="{$BACKEND_CORE_PATH}/layout/templates/sidebar.tpl"}
		<td id="contentHolder">
			<div id="statusBar">
				<p class="breadcrumb">{$msgHeaderIndex}</p>
			</div>
			
			{option:report}
			<div id="report">
				<div class="singleMessage successMessage">
					<p>{$reportMessage}</p>
				</div>
			</div>
			{/option:report}
	
			<div class="inner">
	
				<div class="datagridHolder">
					<div class="tableHeading">
						<div class="buttonHolderRight">
							<a href="{$var|geturl:'add'}" class="button icon iconAdd" title="{$lblAdd|ucfirst}">
								<span><span><span>{$lblAdd|ucfirst}</span></span></span>
							</a>
						</div>
					</div>
					{option:datagrid}{$datagrid}{/option:datagrid}
					{option:!datagrid}{$msgNoItems}{/option:!datagrid}
				</div>
			</div>
		</td>
	</tr>
</table>
{include:file="{$BACKEND_CORE_PATH}/layout/templates/footer.tpl"}