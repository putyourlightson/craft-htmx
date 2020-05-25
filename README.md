<p align="center"><img width="130" src="https://raw.githubusercontent.com/putyourlightson/craft-htmx/v1/src/icon.svg"></p>

# Htmx Plugin for Craft CMS 3

Provides helpers for integrating [Htmx](https://htmx.org/) with [Craft CMS 3](https://craftcms.com/).

> This plugin is currently in beta. Please contribute by reporting any bugs or issues.

```twig
{% set value = craft.app.request.get('value', 0) %}

{% if craft.htmx.isRequest and craft.htmx.element.name == 'increment' %}
    {% set value = value + craft.htmx.element.value %}
{% endif %}
```

## Controllers

The `route` controller makes it possible to route actions to any controller action if Craft (or a plugin), while ensuring that the result is in the format `text/html`.

The `route` parameter should be set to the controller action that you want to be called, for example `entries/save-entry`.

```twig
<form hx-post="/my-form">
  {{ csrfInput() }}
  <input type="hidden" name="action" value="htmx/route">
  <input type="hidden" name="route" value="entries/save-entry">

  <input type="hidden" name="sectionId" value="{{ entry.sectionId }}">
  <input type="hidden" name="entryId" value="{{ entry.id }}">
  <input type="text" name="title" value="{{ entry.title }}">
  <input type="submit" value="Submit">
</form>
```

## Variables

The `craft.htmx` variable (and the shorthand version `hx`) is available in your twig templates. It makes available the values provided by the [request headers](https://htmx.org/docs/#request-headers) in Htmx.

### `craft.htmx.isRequest`
Evaluates to `true` if this is a Htmx request, otherwise `false`.

### `craft.htmx.trigger.id`
The ID of the element that triggered the request.

### `craft.htmx.trigger.name`
The name of the element that triggered the request.

### `craft.htmx.target.id`
The ID of the target element.

### `craft.htmx.url`
The URL of the browser.

### `craft.htmx.prompt`
The value entered by the user when prompted via `hx-prompt`.

### `craft.htmx.eventTarget.id`
The ID of the original target of the event that triggered the request.

### `craft.htmx.element.id`
The ID of the current active element.

### `craft.htmx.element.name`
The name of the current active element.

### `craft.htmx.element.value`
The value of the current active element.

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
