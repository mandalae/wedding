{include file="admin/_header.tpl" title="Admin Pages"}

<h1>Products index</h1>

<a href="/admin/products/edit.php" class="button">Create new product</a>
<a href="/admin/products/upload.php" class="button">Upload products (CSV)</a>

<table class="data">
    <colgroup>
        <col></col>
        <col></col>
        <col></col>
    </colgroup>
    <thead>
        <tr>
            <th>Product name</th>
            <th>Active</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        {foreach $products as $product}
        <tr>
            <td>{$product['name']}</td>
            <td>{if $product['active'] > 0}Yes{else}No{/if}</td>
            <td><a href="/admin/products/edit.php?id={$product['id']}">Edit</a> | <a href="/admin/products/?delete={$product['id']}" class="js-confirm">Delete</a></td>
        </tr>
        {/foreach}
    </tbody>
</table>

{include file="admin/_footer.tpl"}