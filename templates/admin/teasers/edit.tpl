{include file="admin/_header.tpl" title="Admin"}

<h1>Edit teaser</h1>

<form method="post">

    <div class="form-element">
        <label for="headline">Headline:</label>
        <input type="input" value="{$teaser->getHeadline()}" name="headline" id="headline" />
    </div>

    <div class="form-element">
        <label for="url">Link:</label>
        <input type="input" value="{$teaser->getUrl()}" name="url" id="url" />
    </div>
    
    <div class="form-element">
        <label for="image">Image:</label>
        {imagedb id=$teaser->getImage() name="image"}
    </div>

    <div class="form-element">
        <label for="text">Content:</label>
        <textarea name="text" id="text">{$teaser->getText()}</textarea>
    </div>
    
    <div class="form-element checkbox">
        <label for="active">Active:</label>
        <input type="checkbox" value="1" name="active" id="active"{if $teaser->getActive() > 0} checked="checked"{/if} />
    </div>
    
    <div class="form-element">
        <input type="submit" value="Save" class="submit" />
    </div>
    
</form>

{include file="admin/_footer.tpl"}