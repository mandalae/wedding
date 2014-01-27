{include file="admin/_header.tpl" title="Admin Brands"}

<h1>Edit brand</h1>

<form method="post">

    <div class="form-element">
        <label for="name">Name:</label>
        <input type="input" value="{$brand->getName()}" name="name" id="name" />
    </div>
    
    <div class="form-element">
        <label for="image">Image:</label>
        {imagedb id=$brand->getImage() name="image"}
    </div>
    
    <div class="form-element checkbox">
        <label for="active">Active:</label>
        <input type="checkbox" value="1" name="active" id="active"{if $brand->getActive() > 0} checked="checked"{/if} />
    </div>
    
    <div class="form-element">
        <input type="submit" value="Save" class="submit" />
    </div>
    
</form>

{include file="admin/_footer.tpl"}