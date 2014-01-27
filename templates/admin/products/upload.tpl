{include file="admin/_header.tpl" title="Admin Pages"}

<h1>Products upload</h1>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="csv" />
    <input type="submit" value="Upload" />
</form>

{include file="admin/_footer.tpl"}