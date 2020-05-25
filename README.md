<p align="center"><img width="130" src="https://raw.githubusercontent.com/putyourlightson/craft-htmx/v1/src/icon.svg"></p>

# Htmx Plugin for Craft CMS 3

Provides helpers for using [Htmx](https://htmx.org/) with [Craft CMS 3](https://craftcms.com/).

> This plugin is currently in beta. Please contribute by reporting any bugs or issues.

## Variables

The `craft.htmx` variable (and the shorthand version `hx`) is available in your twig templates. It provides components as well as values passed in through the [Htmx request headers](https://htmx.org/docs/#request-headers).

### `craft.htmx.get`
Renders a `get` component from the provided values.

```twig
{{ hx.get({
    tag: 'button', 
    url: '/like',
    content: 'Like',
    attributes: {
        class: 'btn',
    }
}) }}
```

Which will be output as:

```twig
<button hx-get="/like" class="btn">Like</button>
```

### `craft.htmx.post`
Renders a `post` component from the provided values.

```twig
{{ hx.post({
    url: '/like',
    content: '<input type="submit" value="Like">',
    data: {
        entryId: entry.id,
    }
}) }}
```

Which will be output as:

```twig
<form hx-post="/like">
  <input type="hidden" name="CRAFT_CSRF_TOKEN" value="UIfhSl2qN0084dgj6NJdHcCTnL5xFPJ...">
  <input type="hidden" name="entryId" value="1">
  <input type="submit" value="Like">
</form>
```

### `craft.htmx.getParam(name, defaultValue = null)`
Returns the request parameter if this is a Htmx request and it exists, otherwise `$defaultValue`.

### `craft.htmx.isRequest`
Evaluates to `true` if this is a Htmx request, otherwise `false`.

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

## Controllers

The `route` controller makes it possible to route actions to any controller action in Craft (or a plugin/module), while ensuring that the result is in the format `text/html` (and that no redirect takes place).

When sending a POST request, the `action` field should be set to `htmx/route` and the `route` parameter should be set to the controller action that you want to be called, for example `entries/save-entry`. Be sure to send a CSRF token along with the request unless you have disabled CSRF protection in Craft.

```twig
{% set content %}
    <input type="text" name="title" value="My Title">
    <input type="submit" value="Save">
{% endset %}

{{ hx.post({
    url: '/entry',
    content: content,
    data: {
        action: 'htmx/route',
        route: 'entries/save-entry',
        sectionId: entry.sectionId,
        entryId: entry.id,
    }
}) }}
```

Which will be output as:

```twig
<form hx-post="/my-form">
  <input type="hidden" name="CRAFT_CSRF_TOKEN" value="UIfhSl2qN0084dgj6NJdHcCTnL5xFPJ...">
  <input type="hidden" name="action" value="htmx/route">
  <input type="hidden" name="route" value="entries/save-entry">
  <input type="hidden" name="sectionId" value="1">
  <input type="hidden" name="entryId" value="1">
  <input type="text" name="title" value="My Title">
  <input type="submit" value="Save">
</form>
```

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
