<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="{$LANGUAGE}" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="{$LANGUAGE}" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="{$LANGUAGE}" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="{$LANGUAGE}" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="{$LANGUAGE}"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<meta name="robots" content="noindex, nofollow" />

	<title>{$SITE_TITLE} - Fork CMS</title>
	<link rel="shortcut icon" href="/backend/favicon.ico" />

	{iteration:cssFiles}<link rel="stylesheet" href="{$cssFiles.path}" />{$CRLF}{$TAB}{/iteration:cssFiles}
</head>