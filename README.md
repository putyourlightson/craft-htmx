<p align="center"><img width="130" src="https://raw.githubusercontent.com/putyourlightson/craft-htmx/v1/src/icon.svg"></p>

# Htmx Plugin for Craft CMS 3

> This plugin is no longer maintained and has been replaced by [Sprig](https://putyourlightson.com/plugins/sprig).

Provides components and helpers for using [Htmx](https://htmx.org/) with [Craft CMS 3](https://craftcms.com/).

The plugin will automatically route any action requests made from Htmx through the `htmx/route` controller to ensure that the result is always in the format `text/html` and that no redirects take place.

## Variables

The `craft.htmx` variable (and the shorthand version `hx`) is available in your twig templates. It provides components as well as values passed in through the [Htmx request headers](https://htmx.org/docs/#request-headers).

### `craft.htmx.component(template, options = {})`
Renders a reactive component using the provided template.

```twig
{{ hx.component('path/to/template', { 
    params: {
        entryId: entry.id,
        title: entry.title,
    },
}) }}
```

The `params` automatically become available as twig variables in the component:

```twig
Entry ID: {{ entryId }}

{# Add `hx-get` to make the input field reactive #}
<input hx-get type="text" name="title" value="{{ title }}">
{{ title|length }} characters of max 255

{# Any `hx-` attributes can be used #}
<button hx-get hx-confirm="Are you sure?">Refresh</button>
```

### `craft.htmx.get(tag, options = {})`
Renders a `get` component using the provided tag and options.

```twig
{# Minimal example #}
{{ hx.get('div', { 
    content: 'Like', 
}) }}

{# Example with all possible options #}
{{ hx.get('button', {
    url: '/like',
    content: 'Like',
    params: {
        entryId: 1,
    },
    hx: {
        trigger: 'click',
    },
    attributes: {
        class: 'btn',
    }
}) }}
```

Which will be output as:

```twig
{# Minimal example #}
<div hx-get="">Like</div>

{# Example with all possible options #}
<button hx-get="/like?entryId=1" hx-trigger="click" class="btn">Like</button>
```

### `craft.htmx.post(tag, options = {})`
Renders a `post` component using the provided tag and options. A CSRF token will automatically be added _if_ CSRF validation is enabled. 

```twig
{# Minimal example #}
{{ hx.post('form', {
    content: '<input type="submit" value="Like">',
}) }}

{# Example with all possible options #}
{{ hx.post('form', {
    url: '/like',
    content: '<input type="submit" value="Like">',
    params: {
        entryId: 1,
    },
    hx: {
        confirm: 'Are you sure?',
    },
    attributes: {
        class: 'form',
    }
}) }}
```

Which will be output as:

```twig
{# Minimal example #}
<form hx-post="">
  <input type="hidden" name="CRAFT_CSRF_TOKEN" value="UIfhSl2qN0084dgj6NJdHcCTnL5xFPJ...">
  <input type="submit" value="Like">
</form>

{# Example with all possible options #}
<form hx-post="/like" hx-confirm="Are you sure?" class="form">
  <input type="hidden" name="CRAFT_CSRF_TOKEN" value="UIfhSl2qN0084dgj6NJdHcCTnL5xFPJ...">
  <input type="hidden" name="entryId" value="1">
  <input type="submit" value="Like">
</form>
```

### `craft.htmx.script(attributes = {})`
Returns a script tag to include the latest version of Htmx from unpkg.com.

```twig
<script src="https://unpkg.com/htmx.org"></script>
```

### `craft.htmx.request`
Returns `true` if this is a Htmx request, otherwise `false`.

### `craft.htmx.trigger.id`
Returns the ID of the element that triggered the request.

### `craft.htmx.trigger.name`
Returns the name of the element that triggered the request.

### `craft.htmx.target.id`
Returns the ID of the target element.

### `craft.htmx.url`
Returns the URL of the browser.

### `craft.htmx.prompt`
Returns the value entered by the user when prompted via `hx-prompt`.

### `craft.htmx.eventTarget.id`
Returns the ID of the original target of the event that triggered the request.

### `craft.htmx.element.id`
Returns the ID of the current active element.

### `craft.htmx.element.name`
Returns the name of the current active element.

### `craft.htmx.element.value`
Returns the value of the current active element.

## Requirements

Craft CMS 3.0.0 or later.

## Installation

Install the plugin using composer.

```
composer require putyourlightson/craft-htmx:^0.1.0
```

## License

This plugin is licensed for free under the MIT License.

<small>Created by [PutYourLightsOn](https://putyourlightson.com/).</small>
