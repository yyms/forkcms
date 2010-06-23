{include:file='{$BACKEND_CORE_PATH}/layout/templates/head.tpl'}
{include:file='{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl'}

{form:add}
	<div class="box">
		<div class="heading">
			<h3>{$lblContentBlocks|ucfirst}: {$lblAdd}</h3>
		</div>
		<div class="content">
			<fieldset>
				<p>
					<label for="title">{$lblTitle|ucfirst}</label>
					{$txtTitle} {$txtTitleError}
				</p>
				<label for="content">{$lblContent|ucfirst}</label>
				<p>{$txtContent} {$txtContentError}</p>
				<p><label for="hidden">{$chkHidden} {$chkHiddenError} {$msgVisibleOnSite}</label></p>
			</fieldset>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{$lblAdd|ucfirst}" />
		</div>
	</div>
{/form:add}

{include:file='{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl'}
{include:file='{$BACKEND_CORE_PATH}/layout/templates/footer.tpl'}