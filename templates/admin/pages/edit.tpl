{include file="admin/_header.tpl" title="Admin"}

<h1>Edit page</h1>

<form method="post">

    <div class="form-element">
        <label for="headline">Headline:</label>
        <input type="input" value="{$text->getHeadline()}" name="headline" id="headline" />
    </div>

    <div class="form-element">
        <label for="contentEditor">Content:</label>
        <textarea name="contentEditor" id="contentEditor" class="editor">{$text->getContent()}</textarea>
    </div>
    
    <div class="form-element checkbox">
        <label for="active">Active:</label>
        <input type="checkbox" value="1" name="active" id="active"{if $text->getActive() > 0} checked="checked"{/if} />
    </div>
    
    <div class="form-element checkbox">
        <label for="visible">Visible:</label>
        <input type="checkbox" value="1" name="visible" id="visible"{if $text->getVisible() > 0} checked="checked"{/if} />
    </div>
    
    <div class="form-element">
        <input type="submit" value="Save" class="submit" />
    </div>
    
</form>

{include file="admin/_footer.tpl"}