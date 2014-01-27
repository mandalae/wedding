{include file="_header.tpl" title=$headline hideMenu=true}

<h1>{$headline}</h1>

{$text}

<div id="search-criteria" style="float: left; clear: both; width: 1020px; margin-bottom: 30px; background: #FDFDFD; padding: 20px; border-radius: 5px; border: #666 1px solid; ">
    <form method="post">
        <div class="form-element" style="clear: none;">
            <label for="query">Product:</label>
            <input type="text" value="" name="query" id="query" />
        </div>
        <div style="float: left; width: 300px; clear: none; margin-right: 30px;">
            <p>
              <label for="amount">Price range:</label>
              <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
            </p>
            <div id="priceRange"></div>
        </div>
        <div class="form-element" style="float: left; clear: none; margin-right: 30px;">
            <label for="product-brands">Manufacturer:</label>
            <select id="product-brands">
                <option value=""></option>
                {foreach $brands as $brand}
                    <option value="{$brand['id']}">{$brand['name']}</option>
                {/foreach}
            </select>
        </div>
        
        <div class="form-element" style="float: left; clear: none;">
            <label for="product-categories">Category:</label>
            <select id="product-categories">
                <option value=""></option>
                {foreach $categories as $category}
                    <option value="{$category['parent']['id']}">{$category['parent']['name']}</option>
                    {foreach $category['children'] as $child}
                        <option value="{$child['id']}">&nbsp;&nbsp;{$child['name']}</option>
                    {/foreach}
                {/foreach}
            </select>
        </div>

        <div class="form-element" style="float: left; clear: none">
            <input type="button" id="update-products" value="Search" />
        </div>
    </form>
</div>

<div class="product-list" id="product-list" style="float: left; clear: both;">
{if isset($products)}
    {include file="product-list.tpl" products=$products}
{/if}
</div>

{include file="_footer.tpl"}