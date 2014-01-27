{include file="_header.tpl" title=$headline hideMenu=true}

<h1>{$product->getName()}</h1>

<div class="product-view">
    <section>
        <div class="image">{image id=$product->getImage() height="400" width="400"}</div>
        <div class="description">{$product->getDescription()|nl2br}</div>
        
        <fieldset class="product-information">
            <legend>Product information</legend>
            <div class="price">&pound;{$product->getFormattedPrice()}</div>
            <div class="product-information-row">Brand: <a href="/brand/{$brand->getSeo()}">{$brand->getName()}</a></div>
            <div class="product-information-row">Weight: {$product->getFormattedWeight()} lbs</div>
            
            <div class="basket-add">
                <input type="text" value="1" name="quantity" id="quantity" />
                <input type="button" value="Add to basket" class="button orange" />
            </div>
        </fieldset>
    </section>
</div>

{include file="_footer.tpl"}