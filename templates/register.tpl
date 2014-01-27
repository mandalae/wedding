{include file="_header.tpl" title=$headline}

<h1>{$text->getHeadline()}</h1>

<article>
{$text->getContent()}
</article>

<form method="post" id="registrationForm">

    <fieldset form="registrationForm">
        <legend>Login information</legend>
        <div class="form-element">
            <label for="email">E-mail:</label>
            <input type="text" value="" name="email" id="email" />
        </div>
        
        <div class="form-element">
            <label for="password">Password:</label>
            <input type="password" value="" name="password" id="password" />
        </div>
        
        <div class="form-element">
            <label for="password2">Password again:</label>
            <input type="password" value="" name="password2" id="password2" />
        </div>
    </fieldset>
    
    <fieldset form="registrationForm">
        <legend>User information</legend>
        <div class="form-element">
            <label for="name">Full name:</label>
            <input type="input" value="" name="name" id="name" />
        </div>
        
        <div class="form-element">
            <label for="address">Address:</label>
            <input type="text" value="" name="address" id="address" />
        </div>
        
        <div class="form-element">
            <label for="zipcode">Postcode:</label>
            <input type="text" value="" name="zipcode" id="zipcode" />
        </div>
        
        <div class="form-element">
            <label for="city">City:</label>
            <input type="text" value="" name="city" id="city" />
        </div>
        
        <div class="form-element">
            <label for="phone">Phone:</label>
            <input type="text" value="" name="phone" id="phone" />
        </div>
    </fieldset>
    
    <div class="form-element">
        <input type="submit" value="Save" class="submit button" />
    </div>
    
</form>

{include file="_footer.tpl"}