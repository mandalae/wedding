{include file="_header.tpl" title=$headline}

<h1>{$headline}</h1>

<article>{$text}</article>

<form method="post">
    <div class="form-element">
        <input type="text" value="" placeholder="Name" name="name" />
    </div>
    <div class="form-element">
        <input type="text" value="" placeholder="Email" name="email" />
    </div>
    <div class="form-element">
        <input type="submit" value="Sign up" />
    </div>
</form>

{include file="_footer.tpl"}