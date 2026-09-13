# Working on naf/sanity

NAF is a small PHP framework with optional Composer plugins. Its core owns boot,
configuration, the service container, routing, events and PSR-7 responses. Prefer existing
NAF helpers, services and extension interfaces; keep application business rules in the host.
This package declares `type: naf-plugin` and is discovered after installation in a NAF host.
The plugin repository itself is not the application's web root.

Before changing code, read the [shared contribution workflow](https://github.com/nafphp/docs/blob/main/AGENT_WORKFLOW.md)
and [release procedure](https://github.com/nafphp/docs/blob/main/RELEASING.md).
In the multi-repository workspace, the same documents are in the sibling `docs/` checkout;
use the linked copies when working from a standalone clone. Preserve other contributors' work.
Review and update user documentation with every behavior change. Source fixes use an RC branch;
verified documentation-only changes can be merged and published by the agent.

## Current scope and limits

`naf/sanity` is an early monitoring/action prototype. Its manifest declares `naf-plugin`, but
the tracked bootstrap does not register a NAF service or helper. The manifest currently has
no runtime requirements and no Composer scripts; do not infer PHP support or a published,
complete monitoring API from the package type. Verify installation availability before
recommending it to users.

## Use and inspect the prototype

After installing its development dependencies, `php run.php` constructs `Naf\Sanity\Runtime`.
The current `run()` discovers classes in `src/Actions`, instantiates those implementing
`ActionInterface`, indexes them by `NAME`, and dumps the registry. It does **not** yet call
`isDue()`/`execute()` as a monitoring loop. Treat its output as a discovery smoke check.

```php
<?php
use Naf\Sanity\Runtime;

// Composer autoload must already be required. Prototype discovery only:
(new Runtime())->run();
```

## Change it here

Start at [Runtime](src/Runtime.php), [ActionInterface](src/Actions/ActionInterface.php),
[DemoAction](src/Actions/DemoAction.php), [bootstrap](bootstrap.php), [run.php](run.php) and
[composer.json](composer.json). Keep actions focused and reuse NAF logging, configuration,
CLI, queue and scheduling interfaces when adding integration. Declare dependencies you
actually use; do not assume the presence of sibling packages or global `app()`.

Inspect Git status before reading experimental helpers as a public API. Untracked files,
uncommitted traits or helpers not wired through autoload/bootstrap are not part of the
shipped contract. Preserve others' in-progress work. Avoid real external actions during tests.

## Verify

There is no `composer test` or `composer analyse` script and no tracked test suite yet.
Run `composer validate --strict`, lint changed PHP files, and exercise discovery only in an
isolated checkout. The PHPUnit development constraint may require a newer PHP runtime than
other NAF plugins; check Composer's platform resolution. Add meaningful tests when implementing
runtime behavior, but do not claim a currently nonexistent suite passed.

This repository's [README](README.md) is currently a short description. Document implemented
behavior and configuration before presenting new monitoring features as available.
