<p align="center"><img width="130" src="https://raw.githubusercontent.com/putyourlightson/craft-htmx/v1/src/icon.svg"></p>

# Htmx Plugin for Craft CMS 3

Provides helpers for using [Htmx](https://htmx.org/) with [Craft CMS 3](https://craftcms.com/).

> This plugin is currently in beta. Please contribute by reporting any bugs or issues.

```twig
{# Increment a temperature value by the provided value. #}

{% set temp = craft.app.request.get('temp', 29) %}
    
<form hx-get="/get-temp">
    {% if hx.isRequest and hx.element.name == 'increment' %}
        {% set temp = temp + hx.element.value %}
    {% endif %}
    
    <h3>It's {{ temp >= 30 ? 'hot' : 'mild' }}</h3>
    <button type="submit" name="increment" value="-1">-</button>
    Temperature: <input type="text" name="temp" value="{{ temp }}" />
    <button type="submit" name="increment" value="1">+</button>
</form>
```

## Controllers

The `route` controller makes it possible to route actions to any controller action in Craft (or a plugin/module), while ensuring that the result is in the format `text/html` (and that no redirect takes place).

When sending a POST request, the `action` field should be set to `htmx/route` and the `route` parameter should be set to the controller action that you want to be called, for example `entries/save-entry`. Be sure to send a CSRF token along with the request unless you have disabled CSRF protection in Craft.

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
