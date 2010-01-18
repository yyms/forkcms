{include:file="{$BACKEND_CORE_PATH}/layout/templates/header.tpl"}
{include:file="{$BACKEND_CORE_PATH}/layout/templates/sidebar.tpl"}
		<td id="contentHolder">
			<div id="statusBar">
				<p class="breadcrumb">Blog &gt; {$msgHeaderAddCategory|ucfirst}</p>
			</div>

			<div class="inner">
				{form:addCategory}
					<div class="box">
						<div class="heading">
							<h3>{$lblCategory|ucfirst}</h3>
						</div>
						<div class="options">
							{$txtName} {$txtNameError}
						</div>
					</div>

					<div class="fullwidthOptions">
						<div class="buttonHolderRight">
							{$btnSave}
						</div>
					</div>
				{/form:addCategory}
			</div>
		</td>
	</tr>
</table>
{include:file="{$BACKEND_CORE_PATH}/layout/templates/footer.tpl"}