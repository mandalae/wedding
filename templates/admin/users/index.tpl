{include file="admin/_header.tpl" title="Admin Users"}

<h1>Users</h1>

<a href="/admin/users/edit.php" class="button">Create new user</a>

<table class="data">
    <colgroup>
        <col></col>
        <col></col>
        <col></col>
        <col></col>
        <col></col>
        <col></col>
    </colgroup>
    <thead>
        <tr>
            <th>User name</th>
            <th>User group</th>
            <th>Email</th>
            <th>Active</th>
            <th>Deleted</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        {foreach $users as $user}
        <tr>
            <td>{$user['name']}</td>
            <td>{$user['aclName']}</td>
            <td>{$user['email']}</td>
            <td>{if $user['active'] > 0}Yes{else}No{/if}</td>
            <td>{if $user['deleted'] > 0}Yes{else}No{/if}</td>
            <td><a href="/admin/users/edit.php?id={$user['id']}">Edit</a> | <a href="/admin/users/?delete={$user['id']}" class="js-confirm">Delete</a></td>
        </tr>
        {/foreach}
    </tbody>
</table>

{include file="admin/_footer.tpl"}