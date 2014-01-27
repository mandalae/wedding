{include file="admin/_header.tpl" title="Admin Brands"}

<h1>Pages index</h1>

<a href="/admin/categories/edit.php" class="button">Create new category</a>

<table class="data">
    <colgroup>
        <col></col>
        <col></col>
    </colgroup>
    <thead>
        <tr>
            <th>Category name</th>
            <th>Parent category</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        {foreach $categories as $category}
        <tr>
            <td>{$category['name']}</td>
            <td style="white-space: nowrap;">{$category['parent']}</td>
            <td><a href="/admin/categories/edit.php?id={$category['id']}">Edit</a> | <a href="/admin/categories/?delete={$category['id']}" class="js-confirm">Delete</a></td>
        </tr>
        {/foreach}
    </tbody>
</table>

{include file="admin/_footer.tpl"}