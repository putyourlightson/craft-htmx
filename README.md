# Htmx Plugin for Craft CMS 3

Provides helpers for integrating Htmx with Craft CMS 3.

> This plugin is currently in beta. Please contribute by reporting any bugs or issues.

## Variables

The following variables are available in your twig templates. These are provided by the [request headers](https://htmx.org/docs/#request-headers) in Htmx.

### `craft.htmx.isRequest`
Evaluates to `true` if thisis a Htmx request, otherwise `false`.

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
