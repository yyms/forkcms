{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}

{form:add}
	<div class="box">
		<div class="heading">
			<h3>{$lblRedirects|ucfirst}: {$lblAdd|ucfirst}</h3>
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

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{$lblSave|ucfirst}" />
		</div>
	</div>
{/form:add}

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}
