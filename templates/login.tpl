{include file="_header.tpl" title="Login"}

{if isset($error) && $error}
<div class="infobox error">Username or password incorrect. Please check your spelling.</div>
{/if}

Use the form below to log in to Aquatron.co.uk.

{if !$user->isLoggedIn()}
<form method="post" action="/login">
    <input type="hidden" value="{$smarty.server.REQUEST_URI}" name="returnUrl">
    <div class="form-element">
        <input type="email" value="" name="email" placeholder="Email" />
    </div>
    <div class="form-element">
        <input type="password" name="password" placeholder="Password" />
    </div>
    <div class="form-element">
        <input type="submit" value="Login" class="button green box-shadow" />
    </div>
</form>
{/if}

{include file="_footer.tpl"}