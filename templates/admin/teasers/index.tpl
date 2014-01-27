{include file="admin/_header.tpl" title="Admin Pages"}

<h1>Teasers index</h1>

<a href="/admin/teasers/edit.php" class="button">Create new teaser</a>

<table class="data">
    <colgroup>
        <col></col>
        <col></col>
        <col></col>
    </colgroup>
    <thead>
        <tr>
            <th>Teaser name</th>
            <th>Active</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        {foreach $teasers as $teaser}
        <tr>
            <td>{$teaser['headline']}</td>
            <td>{if $teaser['active'] > 0}Yes{else}No{/if}</td>
            <td><a href="/admin/teasers/edit.php?id={$teaser['id']}">Edit</a> | <a href="/admin/teasers/?delete={$teaser['id']}" class="js-confirm">Delete</a></td>
        </tr>
        {/foreach}
    </tbody>
</table>

{include file="admin/_footer.tpl"}