{include file="admin/_header.tpl" title="Admin Users"}

<h1>Edit user</h1>

<form method="post">

    <div class="form-element">
        <label for="email">Email/Username:</label>
        <input type="input" value="{if isset($user)}{$user->getEmail()}{/if}" name="email" id="email" />
    </div>

    <div class="form-element">
        <label for="acl">Access:</label>
        <select id="acl" name="acl">
            <option value="0">--- Select ---</option>
            {foreach $acl as $option}
                <option value="{$option['id']}"{if isset($user) && $option['id'] == $user->getAcl()} selected="selected"{/if}>{$option['name']}</option>
            {/foreach}
        </select>
    </div>
    
    <div class="breaker"></div>

    <div class="form-element">
        <label for="name">Name:</label>
        <input type="input" value="{if isset($user)}{$user->getName()}{/if}" name="name" id="name" />
    </div>
    
    <div class="form-element">
        <label for="address">Address:</label>
        <input type="input" value="{if isset($user)}{$user->getAddress()}{/if}" name="address" id="address" />
    </div>
    
    <div class="form-element">
        <label for="zipcode">Zipcode:</label>
        <input type="input" value="{if isset($user)}{$user->getZipcode()}{/if}" name="zipcode" id="zipcode" />
    </div>
    
    <div class="form-element">
        <label for="city">City:</label>
        <input type="input" value="{if isset($user)}{$user->getCity()}{/if}" name="city" id="city" />
    </div>
    
    <div class="form-element">
        <label for="image">Image:</label>
        {imagedb id=$user->getImage() name="image"}
    </div>
    
    <div class="form-element">
        <label for="description">Description:</label>
        <textarea name="description" id="description">{if isset($user)}{$user->getDescription()}{/if}</textarea>
    </div>
    
    <div class="form-element checkbox">
        <label for="active">Active:</label>
        <input type="checkbox" value="1" name="active" id="active"{if isset($user) && $user->getActive() > 0} checked="checked"{/if} />
    </div>
    
    <div class="form-element">
        <input type="submit" value="Save" class="submit" />
    </div>
    
</form>

{include file="admin/_footer.tpl"}