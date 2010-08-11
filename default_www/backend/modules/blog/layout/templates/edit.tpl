{include:file='{$BACKEND_CORE_PATH}/layout/templates/head.tpl'}
{include:file='{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl'}

<div class="pageTitle">
	<h2>{$lblBlog|ucfirst}: {$msgEditArticle|sprintf:{$item['title']}}</h2>
</div>

{form:edit}
	{$txtTitle} {$txtTitleError}

	<div id="pageUrl">
		<div class="oneLiner">
			{option:detailURL}<p><span><a href="{$detailURL}/{$item['url']}">{$detailURL}/<span id="generatedUrl">{$item['url']}</span></a></span></p>{/option:detailURL}
			{option:!detailURL}<p class="infoMessage">{$errNoModuleLinked}</p>{/option:!detailURL}
		</div>
	</div>

	<div class="tabs">
		<ul>
			<li><a href="#tabContent">{$lblContent|ucfirst}</a></li>
			<li><a href="#tabRevisions">{$lblPreviousVersions|ucfirst}</a></li>
			<li><a href="#tabPermissions">{$lblComments|ucfirst}</a></li>
			<li><a href="#tabSEO">{$lblSEO|ucfirst}</a></li>
		</ul>

		<div id="tabContent">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td id="leftColumn">

						{* Main content *}
						<div class="box">
							<div class="heading headingRTE">
								<h3>{$lblMainContent|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></h3>
							</div>
							<div class="optionsRTE">
								{$txtText} {$txtTextError}
							</div>
						</div>

						{* Summary *}
						<div class="box">
							<div class="heading">
								<div class="oneLiner">
									<h3>{$lblSummary|ucfirst}</h3>
									<abbr class="help">(?)</abbr>
									<div class="tooltip" style="display: none;">
										<p>{$msgHelpSummary}</p>
									</div>
								</div>
							</div>
							<div class="optionsRTE">
								{$txtIntroduction} {$txtIntroductionError}
							</div>
						</div>

					</td>

					<td id="sidebar">
						<div id="publishOptions" class="box">
							<div class="heading">
								<h3>{$lblStatus|ucfirst}</h3>
							</div>

							{option:usingDraft}
							<div class="options">
								<div class="buttonHolder">
									<a href="{$detailURL}/{$item['url']}?draft={$draftId}" class="button icon iconZoom" target="_blank"><span>{$lblPreview|ucfirst}</span></a>
								</div>
							</div>
							{/option:usingDraft}

							<div class="options">
								<ul class="inputList">
									{iteration:hidden}
									<li>
										{$hidden.rbtHidden}
										<label for="{$hidden.id}">{$hidden.label}</label>
									</li>
									{/iteration:hidden}
								</ul>
							</div>

							<div class="options">
								<div class="oneLiner">
									<p>
										<label for="publishOnDate">{$lblPublishOn|ucfirst}:</label>
										{$txtPublishOnDate} {$txtPublishOnDateError}
									</p>
									<p>
										<label for="publishOnTime">{$lblAt}</label>
										{$txtPublishOnTime} {$txtPublishOnTimeError}
									</p>
								</div>
							</div>

						</div>

						<div class="box" id="articleMeta">
							<div class="heading">
								<h3>{$lblMetaData|ucfirst}</h3>
							</div>
							<div class="options">
								<label for="newCategoryValue">{$lblCategory|ucfirst}</label>
								{$ddmCategoryId} {$ddmCategoryIdError}
							</div>
							<div class="options">
								<label for="userId">{$lblAuthor|ucfirst}</label>
								{$ddmUserId} {$ddmUserIdError}
							</div>
							<div class="options">
								<label for="addValue-tags">{$lblTags|ucfirst}</label>
								{$txtTags} {$txtTagsError}
							</div>
						</div>

					</td>
				</tr>
			</table>
		</div>

		<div id="tabPermissions">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td>
						{$chkAllowComments} <label for="allowComments">{$lblAllowComments|ucfirst}</label>
					</td>
				</tr>
			</table>
		</div>

		<div id="tabRevisions">
			{option:drafts}
			<div class="datagridHolder">
				<div class="tableHeading">
					<div class="oneLiner">
						<h3 class="floater">{$lblDrafts|ucfirst}</h3>
						<abbr class="help">(?)</abbr>
						<div class="tooltip" style="display: none;">
							<p>{$msgHelpDrafts}</p>
						</div>
					</div>
				</div>

				{$drafts}
			</div>
			{/option:drafts}

			{option:!drafts}
			<div class="datagridHolder">
				<div class="tableHeading">
					<div class="oneLiner">
						<h3 class="floater">{$lblPreviousVersions|ucfirst}</h3>
						<abbr class="help">(?)</abbr>
						<div class="tooltip" style="display: none;">
							<p>{$msgHelpRevisions}</p>
						</div>
					</div>
				</div>

				{option:revisions}{$revisions}{/option:revisions}
				{option:!revisions}{$msgNoRevisions}{/option:!revisions}
			</div>
			{/option:!drafts}
		</div>

		<div id="tabSEO">
			{include:file='{$BACKEND_CORE_PATH}/layout/templates/seo.tpl'}
		</div>
	</div>

	<div class="fullwidthOptions">
		<a href="{$var|geturl:'delete'}&amp;id={$item['id']}" rel="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
			<span>{$lblDelete|ucfirst}</span>
		</a>
		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblSave|ucfirst}" />
		</div>
	</div>

	<div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
		<p>
			{$msgConfirmDelete|sprintf:{$item['title']}}
		</p>
	</div>
{/form:edit}

{include:file='{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl'}
{include:file='{$BACKEND_CORE_PATH}/layout/templates/footer.tpl'}