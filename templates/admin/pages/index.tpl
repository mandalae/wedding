{include file="admin/_header.tpl" title="Admin Pages"}

<h1>Pages index</h1>

<a href="/admin/pages/edit.php" class="button">Create new page</a>

<table class="data">
    <colgroup>
        <col></col>
        <col></col>
        <col></col>
    </colgroup>
    <thead>
        <tr>
            <th>Page name</th>
            <th>Active</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        {foreach $pages as $page}
        <tr>
            <td>{$page['headline']}</td>
            <td>{if $page['active'] > 0}Yes{else}No{/if}</td>
            <td><a href="/admin/pages/edit.php?id={$page['id']}">Edit</a> | <a href="/admin/pages/?delete={$page['id']}" class="js-confirm">Delete</a></td>
        </tr>
        {/foreach}
    </tbody>
</table>

{include file="admin/_footer.tpl"}