{include file="_header.tpl" title=$headline}

<h1>{$headline}</h1>

{$text}
<div class="staff-list">
{if isset($userList)}
    {foreach from=$userList item='staff'}
        <section>
            <h3>{$staff['name']}</h3>
            <h5><em>{$staff['aclName']}</em></h5>
            <div class="image">{image id=$staff['image'] height="200" width="250"}</div>
            <div class="description">{$staff['description']|nl2br}</div>
        </section>
    {/foreach}
{/if}
</div>

{include file="_footer.tpl"}