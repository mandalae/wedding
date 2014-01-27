{include file="admin/_header.tpl" title="Admin Brands"}

<h1>Pages index</h1>

<a href="/admin/brands/edit.php" class="button">Create new brand</a>

<table class="data">
    <colgroup>
        <col></col>
        <col></col>
    </colgroup>
    <thead>
        <tr>
            <th>Brand name</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        {foreach $brands as $brand}
        <tr>
            <td>{$brand['name']}</td>
            <td><a href="/admin/brands/edit.php?id={$brand['id']}">Edit</a> | <a href="/admin/brands/?delete={$brand['id']}" class="js-confirm">Delete</a></td>
        </tr>
        {/foreach}
    </tbody>
</table>

{include file="admin/_footer.tpl"}