{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}

{form:edit}
	<div class="box">
		<div class="heading">
			<h3>{$lblRewrites|ucfirst}: {$lblEdit|ucfirst}</h3>
		</div>
		<div class="options horizontal">
			<p>
				<label for="source">{$lblSource|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
				{$txtSource} {$txtSourceError}
			</p>
			<p>
				<label for="destination">{$lblDestination|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
				{$txtDestination} {$txtDestinationError}
			</p>
			<p>
				<label for="isRegexp">{$chkIsRegexp} {$lblRegularExpression|ucfirst}</label>
				{$chkIsRegexpError}
			</p>
		</div>
	</div>

	<a href="{$var|geturl:'delete'}&amp;id={$item.id}" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
		<span>{$lblDelete|ucfirst}</span>
	</a>

	<div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
		<p>
			{$msgConfirmDelete|sprintf:{$item.source}}
		</p>
	</div>

	<div class="buttonHolderRight">
		<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblSave|ucfirst}" />
	</div>
{/form:edit}

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}
