{include file="admin/_header.tpl" title="Admin Categories"}

<h1>Edit category</h1>

<form method="post">

    <div class="form-element">
        <label for="name">Name:</label>
        <input type="input" value="{$category->getName()}" name="name" id="name" />
    </div>
    
    <div class="form-element">
        <label for="name">Parent Category:</label>
        <select name="parent_category">
            <option>Select one</option>
            {foreach $cats as $cat}
                <option value="{$cat['id']}"{if $cat['id'] == $category->getParent_category()} selected="selected"{/if}>{$cat['name']}</option>
            {/foreach}
        </select>
    </div>
   
    <div class="form-element checkbox">
        <label for="active">Active:</label>
        <input type="checkbox" value="1" name="active" id="active"{if $category->getActive() > 0} checked="checked"{/if} />
    </div>
    
    <div class="form-element">
        <input type="submit" value="Save" class="submit" />
    </div>
    
</form>

{include file="admin/_footer.tpl"}