<!DOCTYPE html>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="/_js/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="/_js/main.js"></script>
    <script src="/_js/admin.js"></script>

    <script src="/_js/imagedb.js" type="text/javascript"></script>
    <script src="/_js/swfupload/swfupload.js" type="text/javascript"></script>
    <script src="/_js/swfupload/handlers.js" type="text/javascript"></script>

    <link rel="stylesheet" href="/_css/jquery.fancybox.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="/_css/admin/style.css" type="text/css" media="screen, projection" />

    <title>Aquatron{if isset($title)} :: {$title}{/if}</title>
</head>
<body>

    <script type="text/javascript">
        var selector = "{if isset($selector)}{$selector}{/if}";
        var multiple = "{if isset($multiple)}{$multiple}{/if}";
        var query = "{if isset($query)}{$query}{/if}";
    </script>

    <div id="top">
        
    </div>
    <div id="content">
        <div id="menu">
            <ul>
                <li><a href="/admin/imagedb?selector={$selector}&multiple={$multiple}&query={$query}">Browse images</a></li>
                <li><a href="/admin/imagedb/upload.php?selector={$selector}&multiple={$multiple}&query={$query}">Upload</a></li>
                <li><a href="#">Close window</a></li>
            </ul>
        </div>
        <div id="mainContent">