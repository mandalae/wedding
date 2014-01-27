{include file="admin/_header.tpl" title="Admin Courses"}

<h1>Courses index</h1>

<a href="/admin/courses/edit.php" class="button">Create new course</a>

<table class="data">
    <colgroup>
        <col></col>
        <col></col>
        <col></col>
    </colgroup>
    <thead>
        <tr>
            <th>Course name</th>
            <th>Active</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        {foreach $courses as $course}
        <tr>
            <td>{$course['headline']}</td>
            <td>{if $course['active'] > 0}Yes{else}No{/if}</td>
            <td><a href="/admin/courses/edit.php?id={$course['id']}">Edit</a> | <a href="/admin/courses/?delete={$course['id']}" class="js-confirm">Delete</a></td>
        </tr>
        {/foreach}
    </tbody>
</table>

{include file="admin/_footer.tpl"}